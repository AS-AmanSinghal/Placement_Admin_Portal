<?php

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_home_user($input) {
        $this->db->select('id,name,email,c_code,mobile,stream,batch,appeared_in,skills,status');
        $this->db->where('id', $input['user_id']);
        $user = $this->db->get('users')->row_array();
        if ($user) {
            if ($user['status'] != 1)
                return_data(FALSE, "User is deactiveted Please Contact to admin", array());


            $this->db->select('ued.*,edu.title as edu_title');
            $this->db->where('user_id', $input['user_id']);
            $this->db->where('ued.status', 1);
            $this->db->join('educations edu', 'edu.id=ued.education_id AND edu.status=1');
            $education = $this->db->get('user_educational_detail ued')->result_array();

            $query = "SELECT company.id,company.name,company.location,company.package,company.drive_date,company.designation,"
                    . "IFNULL((select count(id) from attendance where user_id=" . $input['user_id'] . " AND company_id=company.id AND invigilator_id=0 and task_for=1),0) as is_enrolled "
                    . "from users "
                    . "LEFT JOIN user_educational_detail ued on users.id=ued.user_id "
                    . "JOIN company_criteria on company_criteria.education_id=ued.education_id "
                    . "JOIN company on company.id=company_criteria.company_id "
                    . "WHERE company.status=1 AND round((ued.marks/ued.max_marks)*100)>company_criteria.criteria AND users.id=" . $input['user_id'] . " and company.drive_date>" . time() . " and company.id not in (IFNULL((select company_id from attendance where user_id=" . $input['user_id'] . " AND company_id=company.id AND invigilator_id=0 and task_for=3),0)) GROUP BY company.id";
            $recommended = $this->db->query($query)->result_array();

            $return = array(
                'user_data' => $user,
                'education' => $education,
                'recommended' => $recommended
            );
            return_data(TRUE, "Information Displayed", $return);
        }
        return_data(FALSE, "Invalid User id", array());
    }

    function attendance_user($input) {
        if ($input['task_for'] != 1 && $input['task_for'] != 3)
            return_data(FALSE, "Invalid Task For Applied", array());

        $this->db->where('user_id', $input['user_id']);
        $this->db->where('company_id', $input['company_id']);
        $this->db->where('invigilator_id', 0);
        $attendance = $this->db->get('attendance')->row_array();
        if ($attendance) {
            if ($attendance['task_for'] == 1) {
                switch ($input['task_for']) {
                    case 1:
                        return_data(FALSE, "Alreay Enrolled", array());
                        break;
                    case 3:
                        return_data(FALSE, "Alreay Enrolled Can Not Be mark as removed", array());
                        break;
                }
            } else if ($attendance['task_for'] == 3) {
                switch ($input['task_for']) {
                    case 1:
                        return_data(FALSE, "Removed Company Can not be Enroll", array());
                        break;
                    case 3:
                        return_data(FALSE, "Alreay Removed", array());
                        break;
                }
            }
        }

        $attendance = array(
            'user_id' => $input['user_id'],
            'company_id' => $input['company_id'],
            'task_for' => $input['task_for'],
            'created' => time()
        );

        $this->db->insert('attendance', $attendance);
        switch ($input['task_for']) {
            case 1:
                return_data(TRUE, "Company Enroilled Successfully", array());
                break;
            case 3:
                return_data(TRUE, "Company Removed Successfully", array());
                break;
        }
    }

    function get_company_list($input) {
        $this->db->select("id,name");
        $this->db->where('status', 1);
        $this->db->where("from_unixtime(drive_date, '%Y-%d-%m')=", date("Y-d-m"));
        return $this->db->get('company')->result_array();
    }

    function get_student_list($input) {
        $query = "select users.id,users.name,attendance.id as attendance_id,(case when attendance.invigilator_id=0 then 0 else 1 end) as is_attendance from attendance join users on users.id=attendance.user_id where users.status=1 AND attendance.company_id=" . $input['company_id'] . " AND attendance.task_for=1";
        $users = $this->db->query($query)->result_array();
        if ($users) {
            foreach ($users as $key => $user) {
                $query = "select educations.title,ued.roll_no from user_educational_detail ued join educations on ued.education_id=educations.id where ued.id=" . $user['id'];
                $frr = $this->db->query($query)->row_array();
                if ($frr) {
                    $users[$key]['roll_no'] = $frr['roll_no'];
                    $users[$key]['graduation'] = $frr['title'];
                } else {
                    $users[$key]['roll_no'] = "";
                    $users[$key]['graduation'] = "";
                }
            }
        }
        return $users;
    }

    function submit_student_attendance($input) {
        $this->db->select('invigilator_id,task_for,user_id');
        $this->db->where('id', $input['attendance_id']);
        $data = $this->db->get('attendance')->row_array();
        if ($data) {
            if ($data['invigilator_id'] > 0) {
                return_data(FALSE, "Already Attendance Submitted", array());
            }
            if ($data['task_for'] != 1) {
                return_data(FALSE, "User is not enrolled", array());
            }

            $this->db->where('id', $data['user_id']);
            $this->db->set('appeared_in', 'appeared_in+1', FALSE);
            $this->db->update('users');

            $this->db->where('id', $input['attendance_id']);
            $this->db->update('attendance', array('invigilator_id' => $input['user_id'], 'task_for' => 2, 'modified' => time()));
            return TRUE;
        }
    }

    function get_qualification($input) {
        $this->db->select('id,name');
        $this->db->where('status', 1);
        return $this->db->get('educations')->result_array();
    }

    function register_student($input) {
        $input["status"] = 1;
        $input["created"] = time();
        $input["user_type"]=3;

        $qualification = $input['qualification'];
        unset($input['user_id'], $input['qualification']);

        $this->db->insert('users', $input);
        $user_id = $this->db->insert_id();

        $qualification = json_decode($qualification, TRUE);

        if ($qualification) {
            foreach ($qualification as $key => $value) {
                $qualification[$key]['user_id'] = $user_id;
                $qualification[$key]['status'] = 1;
                $qualification[$key]['created'] = time();
                unset($qualification[$key]['education']);
            }

            $this->db->insert_batch('user_educational_detail', $qualification);
        }
        if ($user_id)
            return TRUE;
        else
            return FALSE;
    }

}

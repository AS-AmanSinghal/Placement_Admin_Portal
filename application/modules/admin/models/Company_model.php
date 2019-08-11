<?php

class Company_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_company() {
        $this->db->where('status', 1);
        return $this->db->get('company')->result_array();
    }

    function index() {
        $input = $this->input->post();
        if (isset($_GET['id']) && $_GET['id']) {
            $this->db->where('id', $_GET['id']);
            $return['company'] = $this->db->get('company')->row_array();

            $this->db->where('company_id', $_GET['id']);
            $return['criteria'] = $this->db->get('company_criteria')->result_array();
            return $return;
        }
        if ($input) {
            if (isset($input['id'])) {
                $user_info = array(
                    'name' => $input['name'],
                    'stream' => $input['stream'],
                    'batch' => $input['batch'],
                    'designation' => $input['designation'],
                    'skills' => $input['skills'],
                    'drive_date' => strtotime($input['drive_date']),
                    'location' => $input["location"],
                    'package' => $input["package"],
                );
                $this->db->where('id', $input['id']);
                $this->db->update('company', $user_info);
            } else {
                $company_info = array(
                    'name' => $input['name'],
                    'stream' => $input['stream'],
                    'batch' => $input['batch'],
                    'designation' => $input['designation'],
                    'skills' => $input['skills'],
                    'drive_date' => strtotime($input['drive_date']),
                    'location' => $input["location"],
                    'package' => $input["package"],
                    'status' => 1
                );

                $this->db->insert('company', $company_info);
                $id = $this->db->insert_id();

                $criteria = array();
                foreach ($input['education_id'] as $key => $cri) {
                    $insert = array(
                        'company_id' => $id,
                        'education_id' => $input['education_id'][$key],
                        'criteria' => $input['criteria'][$key],
                        'created' => time()
                    );
                    $criteria[] = $insert;
                }
                $this->db->insert_batch('company_criteria', $criteria);
            }
        }
        return [];
    }

    function ajax_company_list($type)
    {
        $request = $_REQUEST;
//        pre($request);die;;
//        $sorting = array(
//            "name"=>'name'
//        );
        $check = "";
        if ($type == 1) {
            $check = " AND drive_date < " . time();
        } else if ($type == 2) {
            $check = " AND drive_date > " . time();
        }

        $count = $this->db->get('company')->num_rows();
        $sql = "select * from company where status=1" . $check . " limit " . $request['start'] . "," . $request['length'];
        $result = $this->db->query($sql)->result_array();

        $draw_data = array();
        $start = (int) $request['start'];
        foreach ($result as $re) {
            $draw = array();
            $draw[] = ++$start;
            $draw[] = $re['name'];
            $draw[] = $re['drive_date'];
            //$draw[]=$re["location"];
            $draw[] = $re["package"];
            $draw[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "company/index?id=" . $re['id'] . "'>Edit</a>";
            $draw_data[] = $draw;
        }
        echo json_encode(array(
            "draw" => $count,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $draw_data
        ));
    }

}

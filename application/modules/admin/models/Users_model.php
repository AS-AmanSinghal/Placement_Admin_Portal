<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_education() {
        $this->db->where('status', 1);
        return $this->db->get('educations')->result_array();
    }

    function get_educational_detail() {
        
    }

    function index($type)
    {
        $input = $this->input->post();
        if (isset($_GET["id"]) && $_GET["id"]) {
            $this->db->where('id', $_GET["id"]);
            $return['users'] = $this->db->get("users")->row_array();

            $this->db->select('ued.*,edu.title as edu_title');
            $this->db->where('user_id', $_GET["id"]);
            $this->db->where('ued.status', 1);
            $this->db->join('educations edu', 'edu.id=ued.education_id AND edu.status=1');
            $return['educational'] = $this->db->get('user_educational_detail ued')->result_array();

            return $return;
        }
        if ($input)
        {
            if (isset($input["id"]))
            {
                if ($type==3)
                {
                    $user_info = array(
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'mobile' => $input['mobile'],
                        'stream' => $input['stream'],
                        'skills' => $input['skills'],
                        'batch' => $input['batch'],
                        'user_type' => $type
                    );
                    if (isset($input["password"]) && $input["password"]) {
                        $user_info["password"] = md5($input["password"]);
                    }
                    $this->db->where("id", $input["id"]);
                    $this->db->update("users", $user_info);
                    pre($input);die;
                    foreach ($input['education_id'] as $key => $value) {
                        $sub = array(
                            'education_id' => $input['education_id'][$key],
                            'marks' => $input['marks'][$key],
                            'max_marks' => $input['max_marks'][$key],
                            'roll_no' => $input['roll_no'][$key]
                        );

                        $this->db->where('id', $input['edu_ids'][$key]);
                        $this->db->update("user_educational_detail", $sub);
                    }
                }
                else
                {
                    $user_info = array(
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'mobile' => $input['mobile'],
                        'stream' => "0",
                        'skills' => "0",
                        'batch'=>"0",
                        'user_type' => $type
                    );
                    if (isset($input["password"]) && $input["password"]) {
                        $user_info["password"] = md5($input["password"]);
                    }
                    $this->db->where("id", $input["id"]);
                    $this->db->update("users", $user_info);
                }
            }
            else
                {
                if ($type==3)
                {
                    $user_info = array(
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'mobile' => $input['mobile'],
                        'password' => md5($input['password']),
                        'stream' => $input['stream'],
                        'skills' => $input['skills'],
                        'batch'=>$input['batch'],
                        'user_type' => $type,
                        'status' => 1
                    );

                    $this->db->insert('users', $user_info);
                    $id = $this->db->insert_id();

                    $education = array();
                    foreach ($input['education_id'] as $key => $value) {
                        $sub = array(
                            'user_id' => $id,
                            'education_id' => $input['education_id'][$key],
                            'marks' => $input['marks'][$key],
                            'max_marks' => $input['max_marks'][$key],
                            'roll_no' => $input['roll_no'][$key],
                            'created' => time(),
                            'status' => 1,
                        );
                        $education[] = $sub;
                    }
                    $this->db->insert_batch('user_educational_detail', $education);
                }
                else
                {
                    $user_info = array(
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'mobile' => $input['mobile'],
                        'password' => md5($input['password']),
                        'stream' => "0",
                        'skills' => "0",
                        'batch'=>"0",
                        'user_type' => $type,
                        'status' => 1
                    );
                    $this->db->insert('users', $user_info);
                    $id = $this->db->insert_id();
                }
            }
        }
        return [];
    }

    function ajax_user_list($type) {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'appeared_in',
            3 => 'stream',
            4 => 'status'
        );
        $query = "SELECT count(id) as total FROM users where status=1";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;

        $where = " AND user_type=" . $type;
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND name LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND appeared_in =" . $requestData['columns'][2]['search']['value'];
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {   //name
            $where .= " AND stream LIKE'" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        
        $sql = "SELECT * FROM users where 1 " . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $r->appeared_in;
            $nestedData[] = $r->stream;
            $nestedData[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "users/index?id=" . $r->id . "'>Edit</a>";
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalData), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   //total data array
        );
        echo json_encode($json_data);  // send data as json format

    }

    function get_invigilator()
    {
        $this->db->where('status', 1);
        return $this->db->get('users')->result_array();
    }

    function ajax_invigilator_list($type) {
        $request = $_REQUEST;
//        pre($request);die;;
//        $sorting = array(
//            "name"=>'name'
//        );
        $count = $this->db->get('users')->num_rows();
        $sql = "select * from users where status=1 and user_type=2 " . " limit " . $request['start'] . "," . $request['length'];
        $result = $this->db->query($sql)->result_array();

        $draw_data = array();
        foreach ($result as $re) {
            $draw = array();
            $draw[] = ++$request['start'];
            $draw[] = "<a href='google.com' target='_blank'>" . $re['name'] . "</a>";
            $draw[] = $re['email'];
            $draw[] = $re['mobile'];
            $draw[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "users/invigilator?id=" . $re['id'] . "'>Edit</a>";
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

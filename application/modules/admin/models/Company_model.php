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
//        $request = $_REQUEST;
////        pre($request);die;;
////        $sorting = array(
////            "name"=>'name'
////        );

//
//        $count = $this->db->get('company')->num_rows();
//        $sql = "select * from company where status=1" . $check . " limit " . $request['start'] . "," . $request['length'];
//        $result = $this->db->query($sql)->result_array();
//
//        $draw_data = array();
//        $start = (int) $request['start'];
//        foreach ($result as $re) {
//            $draw = array();
//            $draw[] = ++$start;
//            $draw[] = $re['name'];
//            $draw[] = $re['drive_date'];
//            //$draw[]=$re["location"];
//            $draw[] = $re["package"];
//            $draw[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "company/index?id=" . $re['id'] . "'>Edit</a>";
//            $draw_data[] = $draw;
//        }
//        echo json_encode(array(
//            "draw" => $count,
//            "recordsTotal" => $count,
//            "recordsFiltered" => $count,
//            "data" => $draw_data
//        ));
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'id',
            1=>'name',
            2 => 'drive_date',
            3 => 'location',
            4 => 'package',
            5 => 'status'
        );
        $query = "SELECT count(id) as total FROM company where status=1";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $where = "";
        if ($type == 1) {
            $where = " AND drive_date < " . time();
        } else if ($type == 2) {
            $where = " AND drive_date > " . time();
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND name LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND drive_date =" . $requestData['columns'][2]['search']['value'];
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {   //name
            $where .= " AND location LIKE'" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][4]['search']['value'])) {   //name
            $where .= " AND package LIKE'" . $requestData['columns'][3]['search']['value'] . "%' ";
        }

        $sql = "SELECT * FROM company where 1 " . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r) {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->name;
            $nestedData[] = $r->drive_date;
            $nestedData[] = $r->location;
            $nestedData[] = $r->package;
            $nestedData[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "company/index?id=" . $r->id . "'>Edit</a>";
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

}

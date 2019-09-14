<?php

class Education_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_education() {
        $this->db->where('status', 1);
        return $this->db->get('educations')->result_array();
    }

    function index()
    {

        $input = $this->input->post();
        if(isset($_GET['id']) && $_GET['id'])
        {
            $this->db->where('id',$_GET["id"]);
            return $this->db->get('educations')->row_array();
        }
        if ($input)
        {
            if (isset($input['id']))
            {
                $education_info = array(
                    'title' => $input['title']
                );
                $this->db->where('id', $input['id']);
                $this->db->update('educations', $education_info);
            }
            else
                {
                    $education_info = array(
                        'title' => $input['title'],
                        'status' => 1
                    );
                    $this->db->insert('educations', $education_info);
                }
            //$id = $this->db->insert_id();
        }
        return [];
    }

    function ajax_education_list() {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'status'
        );
        $query = "SELECT count(id) as total FROM educations where status=1";
        $query = $this->db->query($query)->row_array();
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $where="";
        if (!empty($requestData['columns'][1]['search']['value'])) {   //name
            $where .= " AND title LIKE'" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {   //name
            $where .= " AND status =" . $requestData['columns'][2]['search']['value'];
        }
//        if (!empty($requestData['columns'][3]['search']['value'])) {   //name
//            $where .= " AND stream LIKE'" . $requestData['columns'][3]['search']['value'] . "%' ";
//        }

        $sql = "SELECT * FROM educations where 1 " . $where . " order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " limit " . $requestData['start'] . " , " . $requestData['length'];
        $result = $this->db->query($sql)->result();
        $totalFiltered = (count($result) > 0) ? count($result) : 0;

        $data = array();
        foreach ($result as $r)
        {  // preparing an array
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $r->title;
            $nestedData[] = "<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "education/index?id=" . $r->id . "'>Edit</a>";
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalData), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   //total data array
        );
        echo json_encode($json_data);
    }

}

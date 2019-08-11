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
        $request = $_REQUEST;
//        pre($request);die;;
//        $sorting = array(
//            "name"=>'name'
//        );
        $count = $this->db->get('educations')->num_rows();
        $sql = "select * from educations where status=1 " . " limit " . $request['start'] . "," . $request['length'];
        $result = $this->db->query($sql)->result_array();

        $draw_data = array();
        foreach ($result as $re) {
            $draw = array();
            $draw[] =++$request['start'];
            $draw[] = $re['title'];
            $draw[]="<a class='btn btn-success btn-xs' href='" . ADMIN_URL . "education/index?id=" . $re['id'] . "'>Edit</a>";
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

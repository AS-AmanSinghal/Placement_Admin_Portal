<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
    }

    private function get_data() {
        $return['total_users'] = $this->db->query("select count(id) as total from users where user_type=3")->row()->total;
        $return['total_invigilator'] = $this->db->query("select count(id) as total from users where user_type=2")->row()->total;
        $return['total_company'] = $this->db->query("select count(id) as total from company where status=1")->row()->total;
        $return['total_today_company'] = $this->db->query("select count(id) as total from company where status=1 and from_unixtime(drive_date, '%Y-%d-%m')='". date("Y-d-m")."'")->row()->total;
        return $return;
    }

    public function index() {
        $view_data["tab"] = "dashboard";
        $view_data['result'] = $this->get_data();
        $data['page_data'] = $this->load->view('dashboard/dashboard', $view_data, TRUE);
        $data['page_title']="Dashboard";
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

}

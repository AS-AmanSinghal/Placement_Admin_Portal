<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
        $this->load->model("Users_model");
    }

    public function index() {
        $view_data['result'] = $this->Users_model->index(3);
        $view_data['tab'] = "user management";
        $view_data['page'] = "users";
        $view_data['education'] = $this->Users_model->get_education();
        $data['page_data'] = $this->load->view('users/users', $view_data, TRUE);
        $data['page_title'] = "User Management";
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

    function ajax_student_list() {
        $this->Users_model->ajax_user_list(3);
    }

    public function invigilator() {
        $view_data['result'] = $this->Users_model->index(2);
        $view_data['tab'] = "user management";
        $view_data['page'] = "invigilator";
        $view_data['invigilator'] = $this->Users_model->get_invigilator();
        $data['page_data'] = $this->load->view('users/invigilator', $view_data, TRUE);
        $data['page_title'] = "Invigilator Management";
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

    function ajax_invigilator_list() {
        $this->Users_model->ajax_invigilator_list(2);
    }

}

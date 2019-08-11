<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
        $this->load->model("Company_model");
    }

    public function index() {
        $view_data['result'] = $this->Company_model->index();
        $view_data['tab'] = "company management";
        $view_data['page'] = "company";
        $view_data['company'] = $this->Company_model->get_company();

        $this->load->model("Users_model");
        $view_data['education'] = $this->Users_model->get_education();
        $data['page_data'] = $this->load->view('company/company', $view_data, TRUE);
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

    function ajax_company_list() {
        $this->Company_model->ajax_company_list(0);
    }

    public function previous() {
        $view_data['result'] = $this->Company_model->index();
        $view_data['tab'] = "company management";
        $view_data['page'] = "previous company";
        $view_data['company'] = $this->Company_model->get_company();
        $data['page_data'] = $this->load->view('company/previously_visited_company', $view_data, TRUE);
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

    function ajax_previous_company_list() {
        $this->Company_model->ajax_company_list(1);
    }

    public function upcoming() {
        $view_data['result'] = $this->Company_model->index();
        $view_data['tab'] = "company management";
        $view_data['page'] = "upcoming company";
        $view_data['company'] = $this->Company_model->get_company();
        $data['page_data'] = $this->load->view('company/upcoming_company', $view_data, TRUE);
        echo Modules::run(ADMIN_TEMPLATE, $data);
    }

    function ajax_upcoming_company_list()
    {
        $this->Company_model->ajax_company_list(2);
    }

}

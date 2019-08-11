<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/login_ini");
        $this->load->model("Login_model");
    }

    public function index() {
        
        $input = $this->input->post();
        if ($input) {
            $this->Login_model->index($input);
            
        }
        $this->load->view('login/login');
    }
public function logout()
{
    $this->session->sess_destroy();
    redirect("admin/login/index");
}
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Users_model");
    }

    public function login() {
        $input = $this->validate_login();
        if ($input) {
            $this->Users_model->login($input);
        }
    }

    function validate_login() {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('device_token', 'device_token', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

    public function forget_password() {
        $input = $this->validate_forget_password();
        if ($input) {
            $this->Users_model->forget_password($input);
        }
    }

    function validate_forget_password() {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }
    public function change_password() {
        $input = $this->validate_change_password();
        if ($input) {
            $this->Users_model->change_password($input);
        }
    }

    function validate_change_password() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("Home_model");
    }

    public function get_home_user() {
        $input = $this->validate_get_home_user();
        if ($input) {
            $this->Home_model->get_home_user($input);
        }
    }

    public function get_company_list() {
        $input = $this->validate_get_home_user();
        if ($input) {
            $result = $this->Home_model->get_company_list($input);
            if ($result) {
                return_data(TRUE, "Company List Displayed", $result);
            }
            return_data(FALSE, "No Company Found", array());
        }
    }

    function validate_get_home_user() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

    public function attendance_user() {
        $input = $this->validate_attendance_user();
        if ($input) {
            $this->Home_model->attendance_user($input);
        }
    }

    function validate_attendance_user() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('company_id', 'company_id', 'trim|required');
        $this->form_validation->set_rules('task_for', 'task_for', 'trim|required'); //1-mark as interest(enroll),3-remove(Not Interest)
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

    public function get_student_list() {
        $input = $this->validate_get_student_list();
        if ($input) {
            $result = $this->Home_model->get_student_list($input);
            if ($result) {
                return_data(TRUE, "Student List Displayed", $result);
            }
            return_data(FALSE, "No Student Found", array());
        }
    }

    function validate_get_student_list() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('company_id', 'company_id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

    public function submit_student_attendance() {
        $input = $this->validate_submit_student_attendance();
        if ($input) {
            $result = $this->Home_model->submit_student_attendance($input);
            if ($result) {
                return_data(TRUE, "Successfully Submitted", array());
            }
            return_data(FALSE, "Attendance Submission Failed", array());
        }
    }

    function validate_submit_student_attendance() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('attendance_id', 'attendance_id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

    public function get_qualification() {
        $result = $this->Home_model->get_qualification($input);
        if ($result) {
            return_data(TRUE, "User Registered", array());
        }
        return_data(FALSE, "Registration Failed", array());
    }

    public function register_student() {
        $input = $this->validate_register_student();
        if ($input) {
            $result = $this->Home_model->register_student($input);
            if ($result) {
                return_data(TRUE, "User Registered", array());
            }
            return_data(FALSE, "Registration Failed", array());
        }
    }

    function validate_register_student() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('stream', 'stream', 'trim|required');
        $this->form_validation->set_rules('skills', 'skills', 'trim|required');
        $this->form_validation->set_rules('batch', 'batch', 'trim|required');
        $this->form_validation->set_rules('biometric', 'biometric', 'trim|required');
        $this->form_validation->set_rules('qualification', 'qualification', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return_data(FALSE, array_values($this->form_validation->get_all_errors()), []);
        }
        return $this->input->post();
    }

}

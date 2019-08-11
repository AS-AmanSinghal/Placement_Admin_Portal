<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function index($input) {
        $this->db->where("email", $input["email"]);
        $user = $this->db->get("users")->row_array();
        if ($user) {
            if ($user["user_type"] != 1) {
                page_alert("warning", "Invalid email id");
            } elseif ($user["status"] != 1) {
                page_alert("warning", "Invalid email id");
            } elseif ($user["password"] != md5($input["password"])) {
                page_alert("warning", "password doesn't match");
            } else {
                $session = array("active_admin_id" => $user["id"],
                    "active_admin_data" => $user, "active_admin_name" => $user["name"]);
                $this->session->set_userdata($session);
                redirect("admin/dashboard");
            }
        } else {
            page_alert("error", "email id doesn't exist");
        }
    }

}

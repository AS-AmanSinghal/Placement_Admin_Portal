<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function login($input) {
        $this->db->where('email', $input['username']);
        $this->db->where('user_type !=', 1);
        $user = $this->db->get('users')->row_array();
        if ($user) {
            if (md5($input['password']) != $user['password']) {
                return_data(FALSE, "Please enter correct password", json_decode("{}"));
            }

            $this->db->where('id', $user['id']);
            $this->db->update('users', array('device_token' => $input['device_token']));

            return_data(TRUE, "login successfull", $user);
        }
        return_data(FALSE, "Username does not exist", json_decode("{}"));
    }

    function forget_password($input) {
        $this->db->where('email', $input['username']);
        $this->db->where('user_type !=', 1);
        $user = $this->db->get('users')->row_array();
        if ($user) {
//            if(FILTER_VALIDATE_EMAIL($input['username'])){
//                echo 'email';die;
//            }else{
//                echo 'mobile';die;
//            }
            if (!isset($input['otp']) || !$input['otp']) {
                $otp = rand(1000, 9999);
                return_data(TRUE, "OTP Sent", array('otp' => $otp));
            }
            if (!isset($input['password']) || !$input['password']) {
                return_data(FALSE, "password field required", json_decode("{}"));
            }

            $this->db->where('email', $input['username']);
            $this->db->update('users', array('password' => md5($input['password'])));

            $user['password'] = md5($input['password']);
            return_data(TRUE, "Password Changed", $user);
        }
        return_data(FALSE, "Username does not exist", json_decode("{}"));
    }

    function change_password($input) {
        $this->db->where('id', $input['user_id']);
        $this->db->update('users', array('password' => md5($input['password'])));
        return_data(TRUE, "Password Changed", []);
    }

}

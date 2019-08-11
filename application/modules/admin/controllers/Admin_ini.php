<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ini extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function admin_ini() {
        if (!$this->session->userdata('active_admin_id')) {
            redirect('admin/login');
        }
        $this->login_ini();
    }

    public function login_ini() {
        
        if (!defined('ADMIN_ASSESTS'))
            define('ADMIN_ASSESTS', base_url() . 'admin_assests/');

        if (!defined('ADMIN_IMAGES'))
            define('ADMIN_IMAGES', base_url() . 'uploads/');

        if (!defined('ADMIN_URL'))
            define('ADMIN_URL', base_url() . 'index.php/admin/');

        if (!defined('ADMIN_TEMPLATE'))
            define('ADMIN_TEMPLATE', 'admin/template/index');
    }

}

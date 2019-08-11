<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

    function __construct() {
        parent::__construct();
        Modules::run("admin/admin_ini/admin_ini");
    }

    public function index() {
        $view_data['result']=array();
        $data['page_data'] = $this->load->view('api/api',$view_data,TRUE);
          echo Modules::run(ADMIN_TEMPLATE, $data);
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($data)
    {
        $this->load->view('template/template', $this->clean_html($data));
    }


    public function clean_html($data) {
        return $data;
    }

}

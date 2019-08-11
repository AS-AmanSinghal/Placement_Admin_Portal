<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($data) {
        

        $this->load->view('template/template', $this->clean_html($data));
    }

    private function clean_html($data) {
        $output = array('javascript' => "", 'page_data' => $data['page_data']);
        if (isset($data['page_data']) && $data['page_data']) {
            preg_match_all('#<script(.*?)<\/script>#is', $data['page_data'], $matches);
            $scripts = "";
            foreach ($matches[0] as $value) {
                $scripts .= $value;
            }
            $output['javascript'] = $scripts;
            $output['page_data'] = preg_replace('#<script(.*?)<\/script>#is', '', $data['page_data']);
        }
        $output['page_title'] = (isset($data['page_title'])) ? $data['page_title'] : '';
        return $output;
    }

}

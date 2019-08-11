<?php
/** application/libraries/MY_Form_validation **/ 
class MY_Form_validation extends CI_Form_validation 
{
    function get_all_errors() {
        return $this->_error_array;
        $error_array = array();
        if (count($this->_error_array) > 0) {
            foreach ($this->_error_array as $k => $v) {
                $error_array[$k] = $v;
            }
            return $error_array;
        }
        return false;
    }
}

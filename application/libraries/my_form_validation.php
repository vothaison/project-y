<?php

class MY_Form_validation extends CI_Form_validation{
    public function __construct($config = []){
        parent::__construct($config);
    }

    public function error_array(){
        if(count($this->_error_array)){
            return $this->_error_array;
        }
        return [];
    }
}
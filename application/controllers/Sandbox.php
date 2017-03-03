<?php

class Sandbox extends CI_Controller{

    function __construct(){
        parent::__construct();
        $user_id=$this->session->userdata('user_id');

        if(!$user_id){
            //$this->logout();
        }
    }


    public function index(){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo $actual_link;
    }

}
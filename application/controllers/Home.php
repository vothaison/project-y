<?php

class Home extends CI_Controller{
    function __construct(){
        parent::__construct();
        //$this->load->helper('url');

    }

    public function index(){
        $this->load->helper('url');

        $this->load->view('home/inc/header_view');
        $this->load->view('home/home_view');
        $this->load->view('home/inc/footer_view');
    }

    public function register(){
        $this->load->view('home/inc/header_view');
        $this->load->view('home/register_view');
        $this->load->view('home/inc/footer_view');
    }

    public function welcome(){
        die ("Well...") ;
    }

}
<?php

class Dashboard extends My_Controller{
    protected $_accept_roles = ['backend_people'];

    function __construct(){
        parent::__construct();
    }

    public function index(){

        $data = array(
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'myPlan'
        );
        $this->load->view('dashboard/inc/header_view', $data);
        $this->load->view('dashboard/dashboard_index');
        $this->load->view('dashboard/inc/footer_view');
    }

    public function paper(){
        $data = array(
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'myPlan'
        );
        $this->load->view('dashboard/inc/header_view', $data);
        $this->load->view('dashboard/dashboard_view');
        $this->load->view('dashboard/inc/footer_view');
    }


}
<?php

class My_Controller extends CI_Controller
{
    /*
     * Roles that this  controller accepts
     * */
    protected $_accept_roles = [];
    protected $_user_roles = [];

    protected $_user_actions = [];
    protected $_user_action_method_map = [];

    protected $_require_loggedin = false;

    function __construct()
    {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        $this->_user_roles = $this->session->userdata('user_roles');
        $this->_user_actions = $this->session->userdata('user_actions');

        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (!$user_id) {
            return $this->logout($actual_link);
        }

        $this->check_permission();
    }

    protected function check_permission()
    {
        $passed = false;

        if(count(array_filter($this->_user_roles, function($role){ return $role['role_name'] == 'super_admin'; }))) return;

        if(!count($this->_accept_roles) && !count($this->_user_action_method_map)){
            return;
        }

        // If user has any role that current controller accept, let him/her through
        $role_names_array = array_map(function ($role) {
            return $role['role_name'];
        }, $this->_user_roles);

        if (count(array_intersect($role_names_array, $this->_accept_roles))) {
            $passed = true;
        } else {
            // If user has an action that can access a certain method of current controller, let him/her through
            $method_name = $this->uri->segment(2);
            $method_name = strlen($method_name) ? $method_name : 'index';

            // If current user just wants to logout, let him/her go
            if($method_name == 'logout'){
                return;
            }

            if (array_key_exists($method_name, $this->_user_action_method_map)) {
                if (count(array_intersect($this->_user_action_method_map[$method_name], $this->_user_actions))) {
                    $passed = true;
                }
            }
        }

        if ($passed) {

        } else {
            $this->waiting_room();
        }
    }

    public function logout($returnUrl = null)
    {
        session_destroy();
        if ($returnUrl) {
            redirect("/?returnUrl=" . urlencode($returnUrl));

        } else {
            redirect("/");
        }
    }

    public function waiting_room()
    {
        echo 'Sorry. Please have a cup of coffee and wait for a few days ...';
        echo '<br /><a href="' . $_SERVER['HTTP_REFERER'] . '">Back</a>';
        die;
    }
}
<?php

class _User extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }


    public function get()
    {
        $result = $this->user_model->get(3);
        var_dump($result);
    }

    public function insert()
    {
        $result = $this->user_model->insert([
            'login' => 'TS'
        ]);
        print_r($result);
    }

    public function update()
    {
        $result = $this->user_model->update([
            'login' => 'TS'
        ], 3);
        print_r($result);
    }

    public function delete()
    {
        $result = $this->user_model->delete(1);
        var_dump($result);
    }

    public function hash(){
        echo hash('sha256', 'admin' . SALT);
    }

    public function login(){
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $found = $this->user_model->get([
            'login' => $login,
            'password' =>hash('sha256', $password . SALT)
        ]);

        $this->output->set_content_type('application_json');

        if($found){
            $this->session->set_userdata([
                'user_id' => $found[0]['user_id']
            ]);

            $this->output->set_output(json_encode(['result' => 1]));
        } else {
            $this->output->set_output(json_encode(['result' => 0]));
        }
    }

    public function register(){
        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('login', 'Login', 'required|min_length[4]|max_length[16]|is_unique[user.login]');
        $this->form_validation->set_rules('email', 'Email',  'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|max_length[16]|matches[password]');

        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode(['result' => 0, 'data' => $this->form_validation->error_array()]));
            return;
        }

        $login = $this->input->post('login');
        $email = $this->input->post('email');

        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        $user_id = $this->user_model->insert([
            'login' => $login,
            'email'=>$email,
            'password' => hash('sha256', $password . SALT)
        ]);

        if($user_id) {
            $this->session->set_userdata([
                'user_id' => $user_id
            ]);
            $this->output->set_output(json_encode(['result' => 1]));
            return;
        }

        $this->output->set_output(json_encode(['result' => 0]));
    }
}
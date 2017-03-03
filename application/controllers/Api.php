<?php

class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        defined('SALT') OR define('SALT', 'SALTY');
    }

    private function _require_login()
    {
        $this->output->set_content_type('application_json');
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => 'You are not authorized.'
            ]));
            return false;
        }
    }

    public function login()
    {
        $returnUrl = $this->input->post('returnUrl');
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $this->load->model('user_model');
        $this->load->model('role_model');

        $found = $this->user_model->get([
            'login' => $login,
            'password' => hash('sha256', $password . SALT)
        ]);

        $this->output->set_content_type('application_json');

        if ($found) {
            $roles = $this->user_model->get_roles($found[0]['user_id']);
            if (count($roles)) {
                $actions = $this->user_model->get_actions($roles);

            } else {
                $actions = [];
            }

            $privilege_actions = $this->user_model->get_privilege_actions($found[0]['user_id']);
            $actions = array_merge($actions, $privilege_actions);

            $this->session->set_userdata([
                'user_id' => $found[0]['user_id'],
                'user_login' => $found[0]['login'],
                'user_roles' => $roles,
                'user_actions' => $actions

            ]);

            header("Location: " . site_url('dashboard/index'));
            return true;
            //$this->output->set_output(json_encode([
            //'result' => 1,
            //'returnUrl' => $returnUrl ? $returnUrl : site_url('dashboard')
            //]));
        } else {
            //$this->output->set_output(json_encode(['result' => 0]));
            header("Location: " . site_url('home/index'));
            return false;
        }
    }

    public function register()
    {
        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('login', 'Login', 'required|min_length[4]|max_length[16]|is_unique[user.login]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|max_length[16]|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(['result' => 0, 'data' => $this->form_validation->error_array()]));
            return false;
        }

        $login = $this->input->post('login');
        $email = $this->input->post('email');

        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        $this->load->model('user_model');

        $user_id = $this->user_model->insert([
            'login' => $login,
            'email' => $email,
            'password' => hash('sha256', $password . SALT)
        ]);

        if ($user_id) {
            $roles = $this->user_model->get_roles($user_id);

            if (count($roles)) {
                $actions = $this->user_model->get_actions($roles);

            } else {
                $actions = [];
            }

            $privilege_actions = $this->user_model->get_privilege_actions($user_id);
            $actions = array_merge($actions, $privilege_actions);

            $this->session->set_userdata([
                'user_id' => $user_id,
                'user_login' => $login,
                'user_roles' => $roles,
                'user_actions' => $actions

            ]);


            $this->output->set_output(json_encode(['result' => 1]));
            return true;
        }

        $this->output->set_output(json_encode(['result' => 0]));
    }

    public function get_todo($toto_id = null)
    {
        $this->_require_login();
        $user_id = $this->session->userdata('user_id');

        if ($toto_id != null) {
            $this->db->where([
                'user_id' => $user_id,
                'todo_id' => $toto_id
            ]);
        } else {
            $this->db->where('user_id', $user_id);
        }

        $query = $this->db->get('todo');
        $result = $query->result();
        $this->output->set_output(json_encode($result));
    }

    public function create_todo()
    {
        $this->_require_login();

        $this->form_validation->set_rules('content', 'Content', 'required');
        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode([
                'result' => 0,
                'errors' => $this->form_validation->error_array()
            ]));
            return false;
        }

        $result = $this->db->insert('todo', [
            'content' => $this->input->post('content'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {
            $query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => $query->result()
            ]));
            return false;
        }
        $this->output->set_output(json_encode(['result' => 0]));
    }

    public function delete_todo()
    {
        $this->_require_login();
        $todo_id = $this->input->post('todo_id');

    }

    public function update_todo()
    {
        $this->_require_login();
        $todo_id = $this->input->post('todo_id');
    }

    public function create_note()
    {
        $this->_require_login();

    }

    public function delete_note()
    {
        $this->_require_login();
        $note_id = $this->input->post('note_id');

    }

    public function update_note()
    {
        $this->_require_login();
        $note_id = $this->input->post('note_id');

    }
}

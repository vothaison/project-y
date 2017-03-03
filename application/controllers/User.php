<?php

class User extends My_Controller
{
    protected $_accept_roles = ['super_admin'];

    protected $_user_action_method_map = [
        'manage_account' => ['manage_account']
    ];

    protected $_require_loggedin = true;

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

    }

    public function index()
    {
        $keyword = $this->input->get('keyword');

        // Get limit, if it's invalid, set it to 10
        $limit = $this->input->get('limit');
        $limit = is_numeric($limit) && ($limit > 0) ? $limit : 10;

        // Get page number (1...n), if it's invalid, set it to 1
        $page = $this->input->get('page');
        $page = is_numeric($page) && ($page > 0) ? $page : 1;

        // Calculate the start position of records
        $start = is_numeric($page) && ($page > 0) ? ($page * $limit - $limit) : 0;

        $where = ['login' => $keyword];

        // Count all possible results
        $count = $this->user_model->search_count($where);

        // Calculate number of pages
        $page_count = $count/$limit;

        // For the remainder. If remainder is not zero, add 1 to page count.
        if((int) $page_count != $page_count){
            $page_count = 1 + (int) $page_count;
        }

        // Somehow current page number exceeds page count
        if($page > $page_count){
            $page = $page_count;
            // Redirect to the last available page
            header("Location: ". "?limit=$limit&page=$page");
            exit();
        }

        // Get the list of results, providing start and limit for the query
        $data = $this->user_model->search($where, [
            'limit' => $limit,
            'start' => $start
        ]);

        $this->load->view('user/user_list', [
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'Users',
            'data' => [
                'user_list' => $data,
                'page_count' => $page_count,
                'limit' => $limit,
                'page' => $page,
                'limit_array' => [2, 3, 4, 5, 10],
                'keyword' => $keyword,
                'total' => $count
            ]
        ]);
    }

    public function manage_account(){
        echo 'Manage your account, which is ' . $this->session->userdata('user_login');
        echo '. User id is: '. $this->session->userdata('user_id');
    }

    public function detail()
    {
        $login = $this->input->get('login');
        $back_url = $this->input->get('back_url');

        // VIEW DETAILS
        $user_info = $this->user_model->get(['login' => $login]);

        if (count($user_info)) {
            $user_id = $user_info[0]['user_id'];

            $roles = $this->user_model->get_roles($user_id);
            $privilege_actions = $this->user_model->get_privilege_actions($user_id);

            $this->load->view('user/user_detail', [
                'login' => $this->session->userdata('user_login'),
                'app_name' => 'User Detail',
                'data' => [
                    'user_info' => $user_info[0],
                    'roles' => $roles,
                    'privilege_actions' => $privilege_actions,
                    'back_url' => $back_url
                ]
            ]);
        } else {
            die("Cannot find user with name: " . $login);
        }
    }

    public function create()
    {
        $back_url = $this->input->get('back_url');

        // NEW USER
        $this->load->view('user/user_create', [
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'New User',
            'data' => [
                'back_url' => $back_url
            ]
        ]);
    }

    public function post_create()
    {
      $this->output->set_content_type('application_json');

      $this->form_validation->set_rules('login', 'Login', 'required|min_length[4]|max_length[16]|is_unique[user.login]');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');

      if ($this->form_validation->run() == false) {
          $this->output->set_output(json_encode(['result' => 0, 'data' => $this->form_validation->error_array()]));
          return false;
      }

      $login = $this->input->post('login');
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $this->load->model('user_model');

      $user_id = $this->user_model->insert([
          'login' => $login,
          'email' => $email,
          'password' => hash('sha256', $password . SALT)
      ]);

      if ($user_id) { 
          $this->output->set_output(json_encode(['result' => 1]));
          return true;
      }

      $this->output->set_output(json_encode(['result' => 0]));
    }

    public function revoke_role(){
        $user_id = $this->input->post('user_id');
        $role_id = $this->input->post('role_id');

        $result = $this->user_model->revoke_role($user_id, $role_id);
        $this->output->set_output(json_encode([
            'result' => $result,
            'data'=> ['user_id' => $user_id, 'role_id' => $role_id]
        ]));
    }

    public function add_role(){
        $user_id = $this->input->post('user_id');
        $role_id = $this->input->post('role_id');

        $result = $this->user_model->add_role($user_id, $role_id);
        $this->output->set_output(json_encode([
            'result' => $result,
            'data'=> ['user_id' => $user_id, 'role_id' => $role_id]
        ]));
    }

    public function get_unmapped_roles(){
        $this->output->set_content_type('application_json');

        $user_id = $this->input->get('user_id');

        $result = $this->user_model->get_unmapped_roles($user_id);
        $this->output->set_output(json_encode([
            'result' => $result
        ]));
    }

    public function get_mapped_roles(){
        $this->output->set_content_type('application_json');

        $user_id = $this->input->get('user_id');

        $result = $this->user_model->get_roles($user_id);
        $this->output->set_output(json_encode([
            'result' => $result
        ]));
    }


}

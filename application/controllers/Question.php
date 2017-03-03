<?php
class Question extends My_Controller {
    protected $_accept_roles = ['good_teacher'];

    public function __construct(){
        parent::__construct();
        $this->load->model('question_model');

    }

    public function test() {
        $filter = ['question_text' => 'TRUE'];
        $paging = ['start' => 0, 'limit' => 0];

        $list = $this->question_model->load($filter, $paging);
        $this->output->set_output(json_encode(['result' => $list]));
    }

    /*
     * List questions
     */
    public function index(){
        $keyword = $this->input->get('keyword');

        // Get limit, if it's invalid, set it to 10
        $limit = $this->input->get('limit');
        $limit = is_numeric($limit) && ($limit > 0) ? $limit : 10;

        // Get page number (1...n), if it's invalid, set it to 1
        $page = $this->input->get('page');
        $page = is_numeric($page) && ($page > 0) ? $page : 1;

        // Calculate the start position of records
        $start = is_numeric($page) && ($page > 0) ? ($page * $limit - $limit) : 0;

        $where = ['question_text' => $keyword];

        // Count all possible results
        $count = $this->question_model->search_count($where);

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
        $data = $this->question_model->search($where, [
            'limit' => $limit,
            'start' => $start
        ]);

        $this->load->view('question/question_list', [
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'Question Collections',
            'data' => [
                'list' => $data,
                'page_count' => $page_count,
                'limit' => $limit,
                'page' => $page,
                'limit_array' => [2, 3, 4, 5, 10],
                'keyword' => $keyword,
                'total' => $count
            ]
        ]);
    }

    public function detail()
    {
        $id = $this->input->get('question_id');
        $back_url = $this->input->get('back_url');
        // VIEW DETAILS
        $info = $this->question_model->load($id, ['skip' => 0, 'limit' => 5]);
        //print_r($info[0]); die;
        if (count($info)) {

            $this->load->view('question/question_detail', [
                'login' => $this->session->userdata('user_login'),
                'app_name' => 'Question Details',
                'data' => [
                    'info' => $info[0],
                    'back_url' => $back_url
                ]
            ]);
        } else {
            die("Cannot find question with id: " . $id);
        }
    }

    public function exam_paper()
    {
        $this->load->view('question/exam_paper', [
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'Exam Paper',
            'data' => [

            ]
        ]);
    }

    public function question_type_through()
    {
        $this->load->view('question/question_type_through', [
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'Question Type Through',
            'data' => [

            ]
        ]);
    }

    public function save_a_question()
    {
        $data = $this->input->post('data');
        $questionData = ['question_text' => $data['question_text']];
        // Insert question to [question] table
        $question_id = $this->question_model->insert($questionData);

        $choices_array = $data['choices'];
        foreach($choices_array as &$choice){
            $choice['question_id'] = $question_id;
        }

        // Insert choices to [question_choice] table
        $choices_count = $this->question_model->insert_choices($choices_array);

        $this->output->set_output(json_encode([
            'result' => 0,
            'choices_added' => $choices_array,
            'choices_count' => $choices_count,
            'question_id' => $question_id,
            'data' => $data]));
    }
}
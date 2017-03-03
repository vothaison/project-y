<?php
class Question_model extends CRUD_Model
{
    protected $_table = 'question';
    protected $_primary_key = 'question_id';

    protected $_choice_table = 'question_choice';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_choices($choices){
        $result = $this->db->insert_batch($this->_choice_table, $choices);
        // Return number of added choices
        return $result;
    }

    public function apply_filter($filter) {
        if (is_numeric($filter)) {
            $this->db->where('question.question_id', $filter);
        } elseif (is_array($filter)) {
            foreach ($filter as $_key => $_value) {
                $this->db->like($_key, $_value);
            }
        }
    }

    public function load($filter = null, $paging = ['start' => 0, 'limit' => 100]){
        $this->db->select('question.question_id, question.question_text, question_choice.choice_text');
        $this->db->from('question');
        $this->db->join('question_choice', 'question.question_id = question_choice.question_id', 'inner');

        $this->apply_filter($filter);
        $this->apply_pagination($paging);

        $result_array = $this->db->get()->result_array();

        $final = [];
        $choice_count = 0;
        $question = null;
        $choices = null;

        foreach($result_array as $record) {
            if($choice_count === 0) {
                $question = [
                    'question_id' => $record['question_id'],
                    'question_text' => $record['question_text']
                ];
                $choices = [];
            }

            $choices[] = $record['choice_text'];
            $choice_count += 1;

            if($choice_count === 4){
                $question['choices'] = $choices;
                $final[] = $question;
                $choice_count = 0;
            }
        }
        //print_r($final);
        //echo $str = $this->db->last_query(); die;

        $this->db->flush_cache();
        return $final;
    }
}

<?php

class Single extends My_Controller
{
    function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('id');

        if (!$user_id) {
            $this->logout();
        }
        $this->load->helper('url');

        defined('LOCALHOST') OR define('LOCALHOST', 'localhost');
        if ($this->is_local()) {
            $this->fit_url = 'E:\\Temp\\fit.html';
            //$this->fit_url = "http://fit.sgu.edu.vn";
            //$this->fit_url = "http://vothaison.orgfree.com/sandbox.php";
        } else {
            $this->fit_url = "http://fit.sgu.edu.vn";
        }
    }

    private function is_local()
    {
        $server_name = $_SERVER['SERVER_NAME'];
        $should_start = "192.168";
        if ($_SERVER['SERVER_NAME'] === LOCALHOST || substr($server_name, 0, strlen($should_start)) === $should_start) {
            return true;
        }
        return false;
    }

    private function mark_as_new(&$data)
    {
        $this->load->model('fit_model');
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $item = &$data[$i];

            $db_items = $this->fit_model->get(['string_id' => $item['string_id']]);

            if (count($db_items)) {
                $item['viewed'] = $db_items[0]['viewed'];
            } else {
                $this->fit_model->insert(['string_id' => $item['string_id']]);
            }
        }
    }

    private function mark_as_viewed($string_id)
    {
        $this->load->model('fit_model');
        $db_items = $this->fit_model->get(['string_id' => $string_id]);
        if (count($db_items) && !$db_items[0]['viewed']) {
            $db_items[0]['viewed'] = 1;
            $this->fit_model->update(['viewed' => 1], $db_items[0]['fit_id']);
        }
    }

    private function get_data()
    {
        //$proxy = '10.9.0.49:3128';
        $aContext = array(
            'http' => array(
                //'proxy' => $proxy,
                'request_fulluri' => true,
            ),
        );
        $cxContext = stream_context_create($aContext);
        $html = file_get_contents($this->fit_url, False, $cxContext);
        $dom = pQuery::parseStr($html);

        $cells = $dom->query('.view-content tr');
        $data = [];
        $count = $cells->count();

        for ($i = 1; $i < $count; $i++) {
            $data[] = [
                'date' => trim($cells[$i]->query('.views-field-changed')->html()),
                'title' => $cells[$i]->query('.views-field-title')->text(),
                'url' => $cells[$i]->query('.views-field-title a')->attr('href'),
                'string_id' => trim($cells[$i]->text()),
                'viewed' => 0
            ];
        }

        $this->mark_as_new($data);
        return $data;
    }

    public function fit()
    {
        $this->load->view('single/pquery-master/pQuery.php');
        $url = $this->input->get('url');

        // VIEW LIST
        if (!$url) {
            $data = $this->get_data();
            $this->load->view('single/fit', [
                'login' => $this->session->userdata('user_login'),
                'url' => $this->fit_url,
                'app_name' => 'Enhanced F.I.T',
                'data' => $data
            ]);
            return false;
        }

        // VIEW DETAILS
        $base_fit_url = "http://fit.sgu.edu.vn";
        $fit_url = $base_fit_url . $url;
        $string_id = $this->input->get('string_id');

        if ($this->is_local()) {
            $this->fit_details_url = $url;

        } else {
            $this->fit_details_url = $fit_url;
        }

        $this->load->view('single/fit_detail', [
            'fit_details_url' => $this->fit_details_url,
            'login' => $this->session->userdata('user_login'),
            'fit_url' => $base_fit_url . $url,
            'app_name' => 'Enhanced F.I.T'
        ]);

        $this->mark_as_viewed($string_id);
    }
}
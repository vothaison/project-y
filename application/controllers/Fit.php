<?php

class Fit extends My_Controller
{
    protected $_accept_roles = ['super_admin', 'fit_mod'];
    protected $_user_action_method_map = [
        'index' => ['view_fit']
    ];
    protected $_require_loggedin = true;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        // THIS is for testing purpose
        defined('LOCALHOST') OR define('LOCALHOST', 'localhost');
        if ($this->is_local()) {
            //$this->fit_url = './public/temp/fit.html';
            $this->fit_url = "http://fit.sgu.edu.vn/drupal/";
            //$this->fit_url = "http://vothaison.byethost14.com/sandbox/fit.php";
            //$this->fit_url = "http://vothaison.orgfree.com/sandbox.php";
        } else {
            $this->fit_url = "http://vothaison.byethost14.com/sandbox/fit.php";
            $this->fit_url = "http://fit.sgu.edu.vn/drupal/";
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

    private function get_html($url)
    {
        $result = 'FAILED??';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING , "gzip");

        $headers = array
        (
            'Accept: application/json,text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
            'Accept-Encoding: gzip, deflate, sdch',
            'Cache-Control:no-cache',
            'Connection:keep-alive',
            'Cookie:__test=30d257901984a279c3748b2d2b25628e',
            'Pragma:no-cache',
            'Upgrade-Insecure-Requests:1',
            'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            // We have an error. Show the error message.
            echo curl_error($ch);
        } else {

        }

        curl_close($ch);
        //echo $result; die;
        return $result;
    }

    private function get_data()
    {
        //echo 'this is supposed to be the list'; die;

        $html = $this->get_html($this->fit_url);

        //echo 'lovely  ' . $this->fit_url . '   ' . $html; die;
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

    public function index()
    {
        $this->load->view('single/pquery-master/pQuery.php');
        // VIEW LIST
        $data = $this->get_data();
        $this->load->view('fit/fit', [
            'login' => $this->session->userdata('user_login'),
            'url' => $this->fit_url,
            'app_name' => 'Enhanced F.I.T',
            'data' => $data
        ]);
        return false;

    }

    public function detail()
    {
        $this->load->view('single/pquery-master/pQuery.php');
        $url = $this->input->get('url');

        // VIEW DETAILS
        $base_fit_url = "http://fit.sgu.edu.vn";
        $fit_url = $base_fit_url . $url;
        $string_id = $this->input->get('string_id');

        if ($this->is_local()) {
            $this->fit_details_url = $url;
            $proxy = 'http://localhost:8088/sample/fit_details.php';
        } else {
            $this->fit_details_url = $fit_url;
            $proxy = "http://vothaison.byethost14.com/sandbox/fit-details.php";

            //$proxy = 'http://localhost:8088/sample/fit_details.php';
        }

        $fit_url = $base_fit_url . $url;
        $target_url = $proxy . '?url=' . urlencode($fit_url);
        $html = $this->get_html($fit_url);

        //echo $base_fit_url . $url . '   ' . $html; die;
        $this->load->view('fit/fit_detail', [
            'fit_details_url' => $this->fit_details_url,
            'login' => $this->session->userdata('user_login'),
            'app_name' => 'Enhanced F.I.T',
            'html' => $html,
            'fit_url' => $fit_url
        ]);

        $this->mark_as_viewed($string_id);
    }
}

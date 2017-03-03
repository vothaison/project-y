<?php

class JavascriptBundle extends My_Controller{
    protected $_accept_roles = ['backend_people'];

    protected $folder = "./public/ember-applications/";

    function __construct(){
        parent::__construct();
    }

    protected $ember_app_folder;
    protected $ember_app_name = 'App';

    public function index(){
        header('Content-Type: application/javascript');

        $app_name = $this->input->get('app_name');
        if(!strlen($app_name)){
            die("Unknown application name.");
        }

        $this->ember_app_folder = $this->folder . $app_name . '/';
        if(!is_dir($this->ember_app_folder)){
            die("Folder not found.");
        }

        $this->load->helper('file');

        echo '// This is it ' . $app_name . "\n\n";
        $string = file_get_contents ($this->ember_app_folder . 'application.js');
        echo $string;

        echo "\n\n";

        $string = file_get_contents ($this->ember_app_folder . 'router.js');
        echo $string;

        echo "\n\n";

        $this->bundle_common_folders();

        $this->bundle_folder('routes');
        $this->bundle_folder('helpers');
        $this->bundle_folder('components');
        $this->bundle_folder('controllers');

    }

    public function templates(){
        header('Content-Type: application/javascript');

        $app_name = $this->input->get('app_name');
        if(!strlen($app_name)){
            die("Unknown application name.");
        }

        $this->ember_app_folder = $this->folder . $app_name ;
        $templates_folder = $this->ember_app_folder  .  '/' . 'templates/';
        if(!is_dir($this->ember_app_folder)){
            die("Folder not found. " . $this->ember_app_folder);
        }

        $this->load->helper('file');

        echo '// This is it ' . $app_name . "\n\n";

        $this->bundle_components_folder($templates_folder . 'components');
        $this->bundle_controllers_folder($templates_folder . 'controllers');

    }

    private function bundle_common_folders(){
        $common_folder = $this->folder . '~common/';
        if(!is_dir($common_folder)){
            die("$common_folder not found.");
        }

        $components_folder_js = $common_folder . 'components';
        if(!is_dir($components_folder_js)){
            die("$components_folder_js not found.");
        }

        $helpers_folder_js = $common_folder . 'helpers';
        if(!is_dir($helpers_folder_js)){
            die("$helpers_folder_js not found.");
        }

        $components_folder_templates = $common_folder . 'templates/components';
        if(!is_dir($components_folder_templates)){
            die("$components_folder_templates not found.");
        }

        $files = array_diff(scandir($helpers_folder_js), array('..', '.'));
        foreach($files as $file){
            $auto_name = $this->dashesToCamelCase( pathinfo($file, PATHINFO_FILENAME), true);

            $auto_name = $this->ember_app_name . '.' . $auto_name . ' = ';
            echo $auto_name;

            $string = file_get_contents ($helpers_folder_js . '/' . $file);
            echo $string;
            echo "\n\n";
        }

        $files = array_diff(scandir($components_folder_js), array('..', '.'));
        foreach($files as $file){
          $auto_name = $this->dashesToCamelCase( pathinfo($file, PATHINFO_FILENAME), true);

          $auto_name = $this->ember_app_name . '.' . $auto_name . ' = ';
          echo $auto_name;

          $string = file_get_contents ($components_folder_js . '/' . $file);
          echo $string;
          echo "\n\n";
        }


        $files = array_diff(scandir($components_folder_templates), array('..', '.'));

        foreach($files as $file){

          $file_name = pathinfo($file, PATHINFO_FILENAME);
          $exploded = explode('-', $file_name);
          array_pop($exploded);
          $imploded = implode('-', $exploded);
          $auto_name = "Ember.TEMPLATES['components/$imploded'] = ";
          echo $auto_name;
          $string = file_get_contents ($components_folder_templates . '/' . $file);
          $string = trim( str_replace( PHP_EOL, ' ', $string ) );
          if(strlen($string)){
              echo 'Ember.Handlebars.compile('. json_encode($this->removeWhiteSpace($string)) . ')';

          }else{
              echo 'Ember.Handlebars.compile("")';
          }            echo "\n\n";

        }
    }


    private function bundle_components_folder($folder_name){
        $files = array_diff(scandir($folder_name), array('..', '.'));

        foreach($files as $file){
            $file_name = pathinfo($file, PATHINFO_FILENAME);
            $exploded = explode('-', $file_name);
            array_pop($exploded);
            $imploded = implode('-', $exploded);
            $auto_name = "Ember.TEMPLATES['components/$imploded'] = ";
            echo $auto_name;
            $string = file_get_contents ($folder_name . '/' . $file);
            $string = trim( str_replace( PHP_EOL, ' ', $string ) );
            if(strlen($string)){
                echo 'Ember.Handlebars.compile('. json_encode($this->removeWhiteSpace($string)) . ')';

            }else{
                echo 'Ember.Handlebars.compile("")';
            }            echo "\n\n";

        }
    }

    private function bundle_controllers_folder($folder_name){
        $files = array_diff(scandir($folder_name), array('..', '.'));

        foreach($files as $file){
            $file_name = pathinfo($file, PATHINFO_FILENAME);
            $exploded = explode('-', $file_name);
            array_pop($exploded);
            $imploded = implode('-', $exploded);
            $auto_name = "Ember.TEMPLATES['$imploded'] = ";
            echo $auto_name;
            $string = file_get_contents ($folder_name . '/' . $file);
            $string = trim( str_replace( PHP_EOL, ' ', $string ) );
            if(strlen($string)){
                echo 'Ember.Handlebars.compile('. json_encode($this->removeWhiteSpace($string)) . ')';

            }else{
                echo 'Ember.Handlebars.compile("")';
            }
            echo "\n\n";

        }
    }

    private function bundle_folder($folder_name){
        $routes_folder = $this->ember_app_folder . $folder_name;
        if(!is_dir($routes_folder)){
            die("$folder_name not found.");
        }

        $files = array_diff(scandir($routes_folder), array('..', '.'));

        foreach($files as $file){
            $auto_name = $this->dashesToCamelCase( pathinfo($file, PATHINFO_FILENAME), true);

            $auto_name = $this->ember_app_name . '.' . $auto_name . ' = ';
            echo $auto_name;

            $string = file_get_contents ($routes_folder . '/' . $file);
            echo $string;
            echo "\n\n";

        }
    }

    function removeWhiteSpace($text)
    {
        $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
        $text = preg_replace('/([\s])\1+/', ' ', $text);
        $text = trim($text);
        return $text;
    }

    private function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }


}

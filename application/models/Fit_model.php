<?php

class Fit_model extends CRUD_Model
{
    protected $_table = 'fit';
    protected $_primary_key = 'fit_id';

    public function __construct(){
        parent::__construct();
    }
}
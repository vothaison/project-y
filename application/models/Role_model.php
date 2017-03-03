<?php

class Role_model extends CRUD_Model
{
    protected $_table = 'role';
    protected $_primary_key = 'role_id';

    public function __construct(){
        parent::__construct();
    }


}
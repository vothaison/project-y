<?php

class User_model extends CRUD_Model
{
    protected $_table = 'user';
    protected $_primary_key = 'user_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_roles($id)
    {
        $this->db->select('role.role_name, role.role_id');
        $this->db->from('user');
        $this->db->join('user_role_map', 'user.user_id = user_role_map.user_id', 'inner');
        $this->db->join('role', 'user_role_map.role_id = role.role_id', 'inner');

        if (is_numeric($id)) {
            $this->db->where($this->_table . '.' . $this->_primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }
        $result_array = $this->db->get()->result_array();

        $final = array_map(function ($value) {
            return ['role_id' => $value['role_id'], 'role_name' => $value['role_name']];
        }, $result_array);

        $this->db->flush_cache();
        return $final;
    }

    public function get_unmapped_roles($id)
    {
        if (is_numeric($id)) {
            $query = $this->db->query("SELECT DISTINCT `role`.`role_name`, `role`.`role_id` FROM `role` WHERE`role`.`role_id` not in (select role_id from user_role_map where user_role_map.user_id = $id)");

        } else {
            die ("Id should be a number.");
        }
        $result_array = $query->result_array();

        $final = array_map(function ($value) {
            return ['role_id' => $value['role_id'], 'role_name' => $value['role_name']];
        }, $result_array);

        $this->db->flush_cache();
        return $final;
    }

    public function get_actions($roles)
    {
        $role_names_array = array_map(function ($role) {
            return $role['role_name'];
        }, $roles);

        $this->db->select('action.action_name');
        $this->db->from('role');
        $this->db->join('role_action_map', 'role_action_map.role_id = role.role_id', 'inner');
        $this->db->join('action', 'role_action_map.action_id = action.action_id', 'inner');

        $this->db->where_in('role_name', $role_names_array);


        $result_array = $this->db->get()->result_array();
        $final = array_map(function ($value) {
            return $value['action_name'];
        }, $result_array);

        $this->db->flush_cache();
        return $final;
    }

    public function get_privilege_actions($user_id)
    {
        $this->db->select('action.action_name');
        $this->db->from('user');
        $this->db->join('user_action_map', 'user_action_map.user_id = user.user_id', 'inner');
        $this->db->join('action', 'user_action_map.action_id = action.action_id', 'inner');

        $this->db->where('user.user_id', $user_id);

        $result_array = $this->db->get()->result_array();
        $final = array_map(function ($value) {
            return $value['action_name'];
        }, $result_array);

        $this->db->flush_cache();
        return $final;
    }

    public function revoke_privilege_action($user_id, $action_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('action_id', $action_id);
        $this->db->delete('user_action_map');

        $final = $this->db->affected_rows();
        $this->db->flush_cache();

        return $final;
    }

    public function revoke_role($user_id, $role_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('role_id', $role_id);
        $this->db->delete('user_role_map');

        $final = $this->db->affected_rows();
        $this->db->flush_cache();

        return $final;
    }

    public function add_role($user_id, $role_id)
    {
        $this->db->insert('user_role_map', ['user_id' => $user_id, 'role_id' => $role_id]);
        $final = $this->db->affected_rows();
        $this->db->flush_cache();
        return $final;
    }
}

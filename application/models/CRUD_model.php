<?php

class CRUD_model extends CI_Model
{
    protected $_table = null;
    protected $_primary_key = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($id = null, $pagination = null)
    {
        if (is_numeric($id)) {
            $this->db->get_where($this->_primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }

        if(is_array($pagination)){
            $this->db->limit($pagination['limit'], $pagination['start']);
        }

        $q = $this->db->get($this->_table);
        $result = $q->result_array();
        $this->db->flush_cache();
        return $result;
    }

    public function apply_filter($filter) {
        if (is_numeric($filter)) {
            $this->db->where($this->_primary_key, $filter);
        } elseif (is_array($filter)) {
            foreach ($filter as $_key => $_value) {
                $this->db->like($_key, $_value);
            }
        }
    }

    public function apply_pagination($pagination = ['skip' => 0, 'limit' => 100]) {
        if(is_array($pagination)){
            $this->db->limit($pagination['limit'], $pagination['skip']);
        }
    }

    public function search($id = null, $pagination = ['start' => 0, 'limit' => 100])
    {
        if (is_numeric($id)) {
            $this->db->like($this->_primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->like($_key, $_value);
            }
        }

        if(is_array($pagination)){
            $this->db->limit($pagination['limit'], $pagination['start']);
        }

        $q = $this->db->get($this->_table);
        $result = $q->result_array();
        $this->db->flush_cache();
        return $result;
    }

    public function count($id = null)
    {
        if (is_numeric($id)) {
            $this->db->get_where($this->_primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }

        $this->db->from($this->_table);
        $result = $this->db->count_all_results();
        $this->db->flush_cache();
        return $result;
    }

    public function search_count($id = null)
    {
        if (is_numeric($id)) {
            $this->db->like($this->_primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->like($_key, $_value);
            }
        }

        $this->db->from($this->_table);
        $result = $this->db->count_all_results();
        $this->db->flush_cache();
        return $result;
    }

    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function insert_update($data, $id){
        if(!$id){
            die("Need an id");
        }
        $this->db->select($this->_primary_key);
        $this->db->where($this->_primary_key, $id);
        $q = $this->db->get($this->_table);

        if($q->num_rows() == 0){
            // Insert
            return $this->insert($data);
        }

        // Update
        $this->update($data, $id);
    }

    public function update($new_data, $where)
    {
        if (is_array($where)) {
            foreach ($where as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        } elseif (is_numeric($where)) {
            $this->db->where($this->_primary_key, $where);
        } else {
            die("$where must be present.");
        }

        $this->db->update($this->_table, $new_data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->get_where($_key, $_value);
            }
        } elseif (is_numeric($id)) {
            $this->db->delete($this->_primary_key, $id);
        } else {
            die("$id must be present.");
        }

        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

}
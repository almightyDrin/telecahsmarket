<?php 

/**
 * CodeIgniter
 *
 *
 * @package	CodeIgniter
 * @author	Aldrin B. Dagsaan
 * @copyright	Copyright (c) 2014 - Present, Aldrin B. Dagsaan
 * @since	Version 1.0.0
 * @filesource
 */

class Admin_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // $table, $columns, $limit, $offset, $order_val=NULL, $order_dir=NULL, $search_val=NULL
    public function get_table()
    {   
        $results = Array();
        $params = func_get_args()[0];

        $table = $params['table'];
        $columns = $params['columns'];
        $limit = $params['limit'];
        $offset = $params['offset'];
        $order_val = ($params['order_val']) ?? NULL;
        $order_dir = ($params['order_dir']) ?? NULL;
        $search_val = ($params['search_val']) ?? NULL;
        $filter = ($params['filter']) ?? NULL;
        $join = ($params['join']) ?? NULL;
        $group_by = ($params['group_by']) ?? NULL;

        
        $this->db->select();
        if ( isset( $join ) && !is_null( $join ) && !empty( $join ) ) {
            foreach ($join as $key => $value) {
                $value = explode('|', $value);
                if ( isset($value[1]) && !is_null($value[1]) && !empty($value[1]) ) {
                    $this->db->join($key, $value[0], $value[1]);
                }else{
                    $this->db->join($key, $value[0]);
                }
            }
        }
        if ( isset( $filter ) && !is_null( $filter ) && !empty( $filter ) ) {
            foreach ($filter as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if(!empty($search_val)) {
            $x=0;
            $this->db->group_start();
            foreach($columns as $s_col) {
                if($x==0) {
                    $this->db->like($s_col,$search_val);
                }else {
                    $this->db->or_like($s_col,$search_val);
                }
                $x++;
            }
            $this->db->group_end();               
        }
        if ( isset( $group_by ) && !is_null( $group_by ) && !empty( $group_by ) ) {
            $this->db->group_by($group_by);
        }
        if( is_null($order_val) && empty($order_val) ) {
            $this->db->order_by('id', $order_dir);
        }else{
            $this->db->order_by($order_val, $order_dir);
        }
        $compile_query = $this->db->get_compiled_select($table,false);
        $results['count'] = $this->db->query($compile_query)->num_rows();
        $compile_query = $this->db->limit($limit,$offset)->get_compiled_select();
        $results['data'] = $this->db->query($compile_query)->result_array();
        
        // echo $compile_query;
        return $results;
    }

    // $table, $columns=NULL, $order_col=NULL, $order_dir='asc', $where_col=NULL, $where_val=NULL
    public function get()
    {   
        $params = func_get_args()[0];
        
        $table = $params['table'];
        $columns = ($params['columns']) ?? '*';
        $order_col = ($params['order_col']) ?? NULL;
        $order_dir = ($params['order_dir']) ?? NULL;
        $where_col = ($params['where_col']) ?? NULL;
        $where_val = ($params['where_val']) ?? NULL;
        $where_in = ($params['where_in']) ?? NULL;
        $join = ($params['join']) ?? NULL;
        $group_by = ($params['group_by']) ?? NULL;
        $limit = ($params['limit']) ?? NULL;
        $offset = ($params['offset']) ?? NULL;

        if ( !isset($columns) && is_null($columns) && empty($columns) ) {
            $columns = '*';
        }

        if( isset($order_col) && !is_null($order_col) && !empty($order_col) ) {
            if ( is_array($order_col) ) {
                foreach ($order_col as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }else{
                $this->db->order_by($order_col, $order_dir);
            }
        }

        $this->db->select($columns);
        if ( isset( $join ) && !is_null( $join ) && !empty( $join ) ) {
            foreach ($join as $key => $value) {
                $value = explode('|', $value);
                if ( isset($value[1]) && !is_null($value[1]) && !empty($value[1]) ) {
                    $this->db->join($key, $value[0], $value[1]); //$value[1] is equivalent to 'left','right','outer','inner','full'
                }else{
                    $this->db->join($key, $value[0]);
                }
            }
        }
        if ( isset($where_val) && !is_null($where_val) && !empty($where_val) ) {
            $this->db->where($where_col, $where_val);
        }
        if ( is_array($where_col) ) {
            foreach ($where_col as $key => $value) {
                 $this->db->where($key, $value);
            }
        }
        if ( isset( $group_by ) && !is_null( $group_by ) && !empty( $group_by ) ) {
            $this->db->group_by($group_by);
        }
        if ( isset($where_in) && is_array($where_in) && !empty($where_in) ) {
            $this->db->where_in($where_col, $where_in);
        }
        if ( isset($limit) && !is_null($limit) ) {
            if ( isset($offset) && !is_null($offset) ) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);
            }
        }

        $compile_query = $this->db->get_compiled_select($table);
        $results = $this->db->query($compile_query)->result_array();
        
        // echo $compile_query;
        return $results;
    }

    public function search($table, $key, $field)
    {
        
    }

    public function store($table, $data, $fields = NULL)
    {
        $sql = $this->db->insert($table, $this->security->xss_clean($data));
        return $this->db->affected_rows();
    }

    public function delete($table, $id)
    {
        $sql = $this->db->where('id', $id)
             ->delete($table);
    }
    // $table, $fields, $data
    public function update($table, $data, $where_col, $where_val=NULL)
    {
        if (is_array($where_col) && !empty($where_col)) {
            foreach ($where_col as $key => $value) {
                $this->db->where($key, $value);
            }
        }else {
            if (isset($where_val) && !is_null($where_val)){
                $this->db->where($where_col, $where_val);
            }
        }
        $this->db->update($table, $data);
        
        return $this->db->affected_rows();
    }

    public function store_batch($table, $fields, $data)
    {
        # code...
    }

    public function delete_batch()
    {
        # code...
    }
}


?>
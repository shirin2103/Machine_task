<?php

class Model extends CI_Model {  

    function __construct() {
        parent::__construct();

    }

    function selectWhereData($tableName,$whereData,$fields='*',$row = true,$order_by='',$group_by=''){
        if (isset($tableName)&&isset($whereData)) {
            $this->db->trans_start();   
            $this->db->select($fields);
            $this->db->where($whereData);
            if (!empty($order_by)) {
                $this->db->order_by(@$order_by[0],@$order_by[1]);
            }
            if (!empty($group_by)) {
                $this->db->group_by(@$group_by);
            }
           // $this->db->limit(2);
            $query = $this->db->get($tableName);
            $this->db->trans_complete();
            
            if ($query->num_rows() > 0){
                if($row)
                $rows = $query->row_array();
                else                
                $rows = $query->result_array();
                return $rows;
            }else{
                return false;
            }             
        }else{
            return false;
        }
    }


    function insertData($tableName, $array_data) {
        try {
            if (isset($tableName) && isset($array_data)) {
                $this->db->trans_start();
                $this->db->insert($tableName,$array_data);
                $globals_id = $this->db->insert_id();
                $this->db->trans_complete();
                return $globals_id;
            } else {
                return false;
            }
        }
        catch(Exception $e) {
            return false;
        }
    }

    function updateData($tableName, $updateData, $where) {
        //echo $tableName;print_r($updateData);print_r($where);exit;
        $this->db->trans_start();
        $query = $this->db->update($tableName, $updateData, $where);
        $this->db->trans_complete();
        $result = $query ? 1 : 0;
        return $result;
    }

    function CountWhereRecord($tableName, $where_data=array(), $where_in = array(),$fields='*')
    {
        $this->db->trans_start();
        $this->db->select($fields);
        if(!empty($where_data)){
        $this->db->where($where_data);
        }
        if(!empty($where_in)){
            $this->db->where_in($where_in['field'],$where_in['in_array']);
        }
        $query = $this->db->get($tableName);
        $count = $query->num_rows();
        $this->db->trans_complete();
        return $count;
    }
} //class ends here

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function get_product_edit_info($product_id='') {
        $this->db->select('tbl_product.*');
        $this->db->from('tbl_product');
        $this->db->where('tbl_product.id',$product_id);       
        $query = $this->db->get();
        $result = $query->row_array();       
        return $result;
    }
}
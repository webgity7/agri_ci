<?php
class Sub_category_model extends CI_Model
{
    public function get_sub_categories($query = null)
    {
        $this->db->select('sub_category.id, sub_category.name, sub_category.order, sub_category.status, category.category_name');
        $this->db->from('sub_category');
        $this->db->join('category', 'sub_category.category_id = category.id');
        if ($query) {
            $this->db->like('sub_category.name', $query, 'after');
        }
        return $this->db->get()->result_array();
    }
}

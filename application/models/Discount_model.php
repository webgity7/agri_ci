<?php
class Discount_model extends CI_Model
{
    public function get_discounts($query = null)
    {
        $this->db->select('id, name, DATE_FORMAT(valid_form, "%d-%m-%Y") AS valid_form, DATE_FORMAT(valid_till, "%d-%m-%Y") AS valid_till, amount, type, status');
        $this->db->from('discount');
        $this->db->where('deleted !=', 'Yes');
        if ($query) {
            $this->db->like('name', $query, 'after');
        }
        return $this->db->get()->result_array();
    }
    public function insert_discount($data)
    {
        $this->db->insert('discount', $data);
    }
}

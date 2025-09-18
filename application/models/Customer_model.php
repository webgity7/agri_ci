<?php
class Customer_model extends CI_Model
{
    public function get_customers($query = null)
    {
        $this->db->select('c.id, c.firstname AS name, c.email, c.telephone, c.status');
        $this->db->from('customer c');
        $this->db->where('c.deleted !=', 'Yes');
        if ($query) {
            $this->db->like('c.firstname', $query, 'both');
        }
        $customers = $this->db->get()->result_array();

        foreach ($customers as &$customer) {
            $this->db->where('customer_id', $customer['id']);
            $this->db->where('deleted !=', 'Yes');
            $customer['total_orders'] = $this->db->count_all_results('order');
        }

        return $customers;
    }
}

<?php
class Order_model extends CI_Model
{
    public function get_orders($query = null)
    {
        $this->db->select('o.id, a.addresslineone AS delivery_add, DATE_FORMAT(o.orderdate, "%d-%b-%y") AS formatted_date, o.total, o.status, c.firstname');
        $this->db->from('order o');
        $this->db->join('address a', 'o.shippingaddress_id = a.id', 'left');
        $this->db->join('customer c', 'o.customer_id = c.id', 'left');
        $this->db->where('o.deleted !=', 'Yes');
        if ($query) {
            $this->db->like('o.id', $query, 'after');
        }
        $this->db->order_by('o.id', 'DESC');
        return $this->db->get()->result_array();
    }
}

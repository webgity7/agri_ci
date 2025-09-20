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


    public function get_order_info($order_id)
    {
        if (!is_numeric($order_id)) return [];

        $this->db->select("
            o.id AS order_id,
            DATE_FORMAT(o.orderdate, '%d-%m-%Y') AS orderdate,
            o.subtotal,
            o.ecotax,
            o.discount,
            o.vat,
            o.total,
            o.status,
            o.paymentmood,
            CONCAT_WS(', ', billing.addresslineone, billing.city, billing.states, billing.country, billing.postcode) AS billing_address,
            CONCAT_WS(', ', shipping.addresslineone, shipping.city, shipping.states, shipping.country, shipping.postcode) AS shipping_address
        ", false);

        $this->db->from('order o');
        $this->db->join('address billing', 'o.billingaddress_id = billing.id');
        $this->db->join('address shipping', 'o.shippingaddress_id = shipping.id');
        $this->db->join('order_details od', 'o.id = od.order_id');
        $this->db->join('product p', 'od.product_id = p.id');
        $this->db->where('o.id', $order_id);
        $this->db->group_by('o.id');

        $query = $this->db->get();
        return $query->row_array();
    }

    // Get list of products in the order
    public function get_order_products($order_id)
    {
        if (!is_numeric($order_id)) return [];

        $this->db->select('product.name AS product_name, order_details.quantity');
        $this->db->from('order_details');
        $this->db->join('product', 'order_details.product_id = product.id', 'left');
        $this->db->where('order_details.order_id', $order_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    // Update order status
    public function update_order_status($order_id, $status)
    {
        if (!is_numeric($order_id)) return false;

        $this->db->where('id', $order_id);
        return $this->db->update('order', ['status' => $status]);
    }
    public function cancel_order($order_id)
    {
        if (!is_numeric($order_id)) return false;

        $this->db->where('id', $order_id);
        return $this->db->update('order', [
            'status' => 'Cancel',
            // 'deleted' => 'Yes'
        ]);
    }
    public function soft_delete_order($order_id)
    {
        if (!is_numeric($order_id) || $order_id <= 0) {
            log_message('error', "Invalid order ID passed to soft_delete_order: {$order_id}");
            return false;
        }

        $this->db->where('id', $order_id);
        $result = $this->db->update('order', ['deleted' => 'Yes']);

        if ($result) {
            log_message('debug', "Order ID {$order_id} marked as deleted.");
        } else {
            log_message('error', "Failed to soft delete order ID {$order_id}. DB Error: " . $this->db->_error_message());
        }

        return $result;
    }
}

<?php 
class Dashboard_model extends CI_Model {
    public function get_dashboard_counts() {
        return [
            'category' => $this->db->count_all('category'),
            'sub_category' => $this->db->count_all('sub_category'),
            'product' => $this->db->where('deleted !=', 'Yes')->count_all_results('product'),
            'order' => $this->db->where('deleted !=', 'Yes')->count_all_results('order'),
            'customer' => $this->db->where('deleted !=', 'Yes')->count_all_results('customer'),
            'discount' => $this->db->where('deleted !=', 'Yes')->count_all_results('discount'),
        ];
    }
}


?>
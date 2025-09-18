<?php
class Admin_model extends CI_Model
{
    public function get_admin_by_username($username)
    {
        return $this->db->where('user_name', $username)->get('admin')->row_array();
    }
}

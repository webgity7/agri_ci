<?php
class Category_model extends CI_Model
{

    public function get_categories_with_subcategories()
    {
        $categories = $this->db->get('category')->result_array();
        foreach ($categories as &$cat) {
            $cat['subcategories'] = $this->db
                ->where('category_id', $cat['id'])
                ->get('sub_category')
                ->result_array();
        }
        return $categories;
    }

    public function get_categories_with_sub_count($query = null)
    {
        $this->db->select('c.id, c.category_name, c.order, c.status, COUNT(sc.id) AS sub_category_count');
        $this->db->from('category c');
        $this->db->join('sub_category sc', 'sc.category_id = c.id', 'left');
        if ($query) {
            $this->db->like('c.category_name', $query, 'after');
        }
        $this->db->group_by(['c.id', 'c.category_name', 'c.order', 'c.status']);
        return $this->db->get()->result_array();
    }


    public function get_name($id)
    {
        $this->db->select('category_name');
        $this->db->from('category');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->category_name;
        } else {
            return null;
        }
    }
    public function get_all_with_subcategories()
    {

        $categories = $this->db->get('category')->result_array();


        foreach ($categories as &$category) {
            $this->db->where('category_id', $category['id']);
            $subcategories = $this->db->get('sub_category')->result_array();
            $category['subcategories'] = $subcategories;
        }

        return $categories;
    }

    public function get_sub_name($id)
    {
        $this->db->select('name');
        $this->db->from('sub_category');
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->name;
        } else {
            return null;
        }
    }
}

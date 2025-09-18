<?php
class Product_model extends CI_Model
{
    public function get_special_products()
    {
        $special_products = $this->db->get('product')->result_array();
        return $special_products;
    }
    public function get_featured_products()
    {
        $featured_products = $this->db->get('product')->result_array();
        return $featured_products;
    }
    public function search_products($name = '')
    {
        if ($name) {
            $this->db->like('name', $name);
        }
        $this->db->where('deleted !=', 'Yes');
        return $this->db->get('product')->result_array();
    }

    public function get_products($query = null)
    {
        $this->db->select('p.id, p.name AS product_name, p.price, c.category_name, sc.name AS sub_category_name, p.availability');
        $this->db->from('product p');
        $this->db->join('category c', 'p.category_id = c.id');
        $this->db->join('sub_category sc', 'p.sub_category_id = sc.id', 'left');
        $this->db->where('p.deleted !=', 'Yes');
        if ($query) {
            $this->db->like('p.name', $query, 'after');
        }
        return $this->db->get()->result_array();
    }

    public function get_filtered_products($cid = null, $sid = null, $sort = '', $limit = 100)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('deleted !=', 'Yes');

        // Filter by category
        if (!empty($cid)) {
            $this->db->where('category_id', $cid);
        }

        // Filter by subcategory
        if (!empty($sid)) {
            $this->db->where('sub_category_id', $sid);
        }

        // Sorting
        switch ($sort) {
            case 'A-Z':
                $this->db->order_by('name', 'ASC');
                break;
            case 'Z-A':
                $this->db->order_by('name', 'DESC');
                break;
            case 'low':
                $this->db->order_by('price', 'ASC');
                break;
            case 'high':
                $this->db->order_by('price', 'DESC');
                break;
            default:
                // No sorting
                break;
        }

        // Limit
        $this->db->limit($limit);

        $query = $this->db->get();
        $products = $query->result_array();

        // Shuffle if no sort applied
        if (empty($sort)) {
            shuffle($products);
        }

        return $products;
    }

    // For Product.php
    

    public function get_product_images($pid)
    {
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where('product_id', $pid);
        $this->db->group_by('image_src');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_related_products()
    {
        $product_id=$this->input->get('pid');
        $this->db->select('`id`, `name`, `price`, `description`, `category_id`, `sub_category_id`, `availability`, `featured_image`');
        $this->db->from('product');
        $this->db->where('deleted !=', 'Yes');
        $query = $this->db->get();

        if ($query->num_rows() === 0) {
            return [];
        }

        $category_id = $query->row()->category_id;


        $this->db->select('id, name, price, featured_image');
        $this->db->from('product');
        $this->db->where('category_id', $category_id);
        $this->db->where('id !=', $product_id);
        $this->db->where('deleted !=', 'Yes');
        $this->db->limit($limit=10);
        $query = $this->db->get();
        return $query->result_array();
    }

 public function get_product_by_id($id) {
    $this->db->select('p.id, p.name AS product_name, p.price, p.description, p.availability, p.featured_image, 
                       p.featured_product, p.special_product, p.created_at, p.updated_at, 
                       c.category_name, sc.name AS sub_category_name');
    $this->db->from('product p');
    $this->db->join('category c', 'p.category_id = c.id', 'inner');
    $this->db->join('sub_category sc', 'p.sub_category_id = sc.id', 'left');
    $this->db->where('p.id', $id);
    $this->db->where('p.deleted !=', 'Yes');
    $query = $this->db->get();
    return $query->row_array(); // returns null if not found
}

}

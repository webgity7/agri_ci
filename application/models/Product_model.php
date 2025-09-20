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
        $product_id = $this->input->get('pid');
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
        $this->db->limit($limit = 10);
        $query = $this->db->get();
        return $query->result_array();
    }



    public function insert_product($data)
    {
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }

    public function insert_image($filename, $product_id)
    {
        $this->db->insert('images', [
            'image_src' => $filename,
            'product_id' => $product_id
        ]);
    }

    public function get_product_details($id)
    {
        $this->db->select('p.id, p.name AS product_name, p.price, p.description, c.category_name, sc.name AS sub_category_name, p.availability, p.featured_image, p.featured_product, p.special_product, c.id as category_id');
        $this->db->from('product p');
        $this->db->join('category c', 'p.category_id = c.id', 'inner');
        $this->db->join('sub_category sc', 'p.sub_category_id = sc.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row_array();
    }


    public function get_product_by_id($id)
    {
        $this->db->select('p.id, p.name AS product_name, p.price, p.description, c.category_name, sc.name AS sub_category_name, p.availability, p.featured_image, p.featured_product, p.special_product, c.id as category_id');
        $this->db->from('product p');
        $this->db->join('category c', 'p.category_id = c.id', 'inner');
        $this->db->join('sub_category sc', 'p.sub_category_id = sc.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_all_categories()
    {
        return $this->db->select('id, category_name')->get('category')->result_array();
    }

    public function get_subcategories_by_category($category_id)
    {
        return $this->db->get_where('sub_category', ['category_id' => $category_id])->result_array();
    }

    public function get_gallery_images($product_id)
    {
        $this->db->select('id, image_src AS images');
        $this->db->from('images');
        $this->db->where('product_id', $product_id);
        return $this->db->get()->result_array();
    }

    public function update_product($id, $data)
    {
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            log_message('error', "Invalid product ID: {$id}");
            return false;
        }

        // Update the product record
        $this->db->where('id', $id);
        $result = $this->db->update('product', $data);

        // Log result
        if ($result) {
            log_message('debug', "Product ID {$id} updated successfully.");
        } else {
            log_message('error', "Failed to update product ID {$id}. DB Error: " . $this->db->_error_message());
        }

        return $result;
    }
    public function get_gallery_images_by_ids($ids = [])
    {
        if (empty($ids) || !is_array($ids)) {
            log_message('error', 'Invalid or empty image ID array passed to get_gallery_images_by_ids.');
            return [];
        }

        $this->db->select('id, image_src');
        $this->db->from('images');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            log_message('debug', 'Fetched gallery images for IDs: ' . implode(',', $ids));
            return $query->result_array();
        } else {
            log_message('debug', 'No gallery images found for IDs: ' . implode(',', $ids));
            return [];
        }
    }
    public function delete_gallery_images($ids = [])
    {
        if (empty($ids) || !is_array($ids)) {
            log_message('error', 'Invalid or empty image ID array passed to delete_gallery_images.');
            return false;
        }

        $this->db->where_in('id', $ids);
        $result = $this->db->delete('images');

        if ($result) {
            log_message('debug', 'Deleted gallery images for IDs: ' . implode(',', $ids));
        } else {
            log_message('error', 'Failed to delete gallery images. DB Error: ' . $this->db->_error_message());
        }

        return $result;
    }

    public function soft_delete_product($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            log_message('error', "Invalid product ID passed to soft_delete_product: {$id}");
            return false;
        }

        $this->db->where('id', $id);
        $result = $this->db->update('product', ['deleted' => 'Yes']);

        if ($result) {
            log_message('debug', "Product ID {$id} marked as deleted.");
        } else {
            log_message('error', "Failed to soft delete product ID {$id}. DB Error: " . $this->db->_error_message());
        }

        return $result;
    }
}

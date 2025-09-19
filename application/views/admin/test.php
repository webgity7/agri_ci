<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
    }

    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Collect form data
            $category_id      = $this->input->post('category');
            $sub_category_id  = $this->input->post('subcategory') ?: NULL;
            $product_name     = $this->input->post('product_name');
            $product_price    = $this->input->post('product_price');
            $product_desc     = $this->input->post('product_desc');
            $availability     = $this->input->post('availability') ? 'In Stock' : 'Out of Stock';
            $special_product  = $this->input->post('special_product') ? 'yes' : 'no';
            $featured_product = $this->input->post('featured_product') ? 'yes' : 'no';

            if (empty($category_id) || empty($product_name) || empty($product_price)) {
                $this->session->set_flashdata('error', 'There is something wrong.');
                redirect('admin/product');
            }

            // Upload featured image
            $featured_image_name = $this->_upload_featured_image();

            if (!$featured_image_name) {
                $this->session->set_flashdata('error', 'Failed to upload featured image.');
                redirect('admin/product');
            }

            // Save product in DB
            $product_id = $this->Product_model->insert_product([
                'name'             => $product_name,
                'price'            => $product_price,
                'description'      => $product_desc,
                'category_id'      => $category_id,
                'sub_category_id'  => $sub_category_id,
                'availability'     => $availability,
                'featured_image'   => $featured_image_name,
                'special_product'  => $special_product,
                'featured_product' => $featured_product,
                'created_at'       => date("Y-m-d H:i:s")
            ]);

            // Upload gallery images
            $this->_upload_gallery_images($product_id);

            $this->session->set_flashdata('success', 'Product added successfully!');
            redirect('admin/product');
        } else {
            $this->load->view('admin/product');
        }
    }

    private function _upload_featured_image()
    {
        $config['upload_path']   = FCPATH . 'uploads/product_original/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('featured_image')) {
            $data = $this->upload->data();
            $filename = $data['file_name'];

            // Resize images
            $this->_resize_image($data['full_path'], FCPATH . 'uploads/images/product_large/' . $filename, 1000);
            $this->_resize_image($data['full_path'], FCPATH . 'uploads/product_medium/' . $filename, 538);
            $this->_resize_image($data['full_path'], FCPATH . 'uploads//product_small/' . $filename, 255);
            $this->_resize_image($data['full_path'], FCPATH . 'uploads//product_thumb/' . $filename, 113);

            return $filename;
        }
        return false;
    }

    private function _upload_gallery_images($product_id)
    {
        if (!empty($_FILES['gallery_image']['name'][0])) {
            $files = $_FILES;
            $count = count($files['gallery_image']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['gallery']['name']     = $files['gallery_image']['name'][$i];
                $_FILES['gallery']['type']     = $files['gallery_image']['type'][$i];
                $_FILES['gallery']['tmp_name'] = $files['gallery_image']['tmp_name'][$i];
                $_FILES['gallery']['error']    = $files['gallery_image']['error'][$i];
                $_FILES['gallery']['size']     = $files['gallery_image']['size'][$i];

                $config['upload_path']   = FCPATH . 'uploads/product_original/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gallery')) {
                    $data = $this->upload->data();
                    $filename = $data['file_name'];

                    // Resize gallery
                    $this->_resize_image($data['full_path'], FCPATH . 'uploads/product_large/' . $filename, 1000);
                    $this->_resize_image($data['full_path'], FCPATH . 'uploads/product_medium/' . $filename, 538);
                    $this->_resize_image($data['full_path'], FCPATH . 'uploads/product_thumb/' . $filename, 113);

                    $this->Product_model->insert_image($filename, $product_id);
                }
            }
        }
    }

    private function _resize_image($source_path, $dest_path, $new_width)
    {
        $this->load->library('image_lib');
        list($width, $height) = getimagesize($source_path);
        $ratio = $height / $width;
        $new_height = round($new_width * $ratio);

        $config['image_library']  = 'gd2';
        $config['source_image']   = $source_path;
        $config['new_image']      = $dest_path;
        $config['maintain_ratio'] = TRUE;
        $config['width']          = $new_width;
        $config['height']         = $new_height;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
}

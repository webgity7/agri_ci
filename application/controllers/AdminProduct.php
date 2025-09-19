<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminProduct extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Product_model');

        $query = $this->input->get('query');
        $products = $this->Product_model->get_products($query);

        $data['pageTitle'] = 'Product';
        $data['flash'] = $this->session->flashdata('flash');
        $data['products'] = $products;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product', $data);
        $this->load->view('admin/footer');
    }

    public function add_product()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['pageTitle'] = 'Add Product';
        $data['category_table'] = $this->db->select('category.id,category.category_name')->from('category')->get()->result_array();
        $data['sub_category_table'] = $this->db->select('`id`, `name`')->from('`sub_category`')->get()->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_product', $data);
        $this->load->view('admin/footer');
    }


    public function edit_product($id = '')
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }

        $this->load->model('Product_model');
        $data['id'] = $id;
        $data['pageTitle'] = 'Edit Product';
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $data['category'] = $this->Product_model->get_all_categories();
        $data['subcategory'] = $this->Product_model->get_subcategories_by_category($data['product']['category_id']);
        $data['gallery_images'] = $this->Product_model->get_gallery_images($id);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_product', $data);
        $this->load->view('admin/footer');
    }




    public function submit_product()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            // Collect form data
            $category_id = $this->input->post('category');
            $sub_category_id = $this->input->post('subcategory') ?: NULL;
            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_desc = $this->input->post('product_desc');
            $availability = $this->input->post('availability') ? 'In Stock' : 'Out of Stock';
            $special_product = $this->input->post('special_product') ? 'yes' : 'no';
            $featured_product = $this->input->post('featured_product') ? 'yes' : 'no';

            // Debug: Check required fields
            // echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

            if (empty($category_id) || empty($product_name) || empty($product_price)) {
                // Debug: Missing required fields
                echo "Missing required fields: category_id=$category_id, product_name=$product_name, product_price=$product_price";
                exit;

                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Missing required fields.'
                ]);
                redirect('admin/product');
            }

            // Upload featured image
            $featured_image_name = $this->_upload_featured_image();

            if (!$featured_image_name) {
                // Debug: Failed image upload
                echo "Featured image upload failed.";
                exit;

                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Failed to upload featured image.'
                ]);
                // redirect('admin/product');
            }

            // Save product in DB
            $product_data = [
                'name' => $product_name,
                'price' => $product_price,
                'description' => $product_desc,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'availability' => $availability,
                'featured_image' => $featured_image_name,
                'special_product' => $special_product,
                'featured_product' => $featured_product,
                'created_at' => date("Y-m-d H:i:s")
            ];

            // Debug: Inspect product data before insert
            echo "<pre>";
            print_r($product_data);
            echo "</pre>";
            exit;

            $product_id = $this->Product_model->insert_product($product_data);

            // Upload gallery images
            $this->_upload_gallery_images($product_id);

            // Debug: Confirm product ID and gallery upload
            echo "Product inserted with ID: $product_id";
            exit;

            $this->session->set_flashdata('flash', [
                'type' => 'success',
                'message' => 'Product added successfully!'
            ]);
            // redirect('admin/product');

        } else {
            // Debug: Invalid request method
            echo "Invalid request method: " . $_SERVER['REQUEST_METHOD'];
            exit;

            $this->session->set_flashdata('flash', [
                'type' => 'error',
                'message' => 'There is something error.'
            ]);
            // redirect('admin/product');
        }
    }

    public function delete_product()
    {
        echo "delete vai ...";
    }


// Handling Featured image
private function _upload_featured_image()
{
    $basePath = FCPATH . 'uploads/';
    $folders = ['product_original', 'product_large', 'product_medium', 'product_small', 'product_thumb'];

    foreach ($folders as $folder) {
        $path = $basePath . $folder;
        if (!is_dir($path)) {
            if (mkdir($path, 0777, true)) {
                // Debug: Folder created
                log_message('debug', "Created folder: {$path}");
                // echo "Created folder: {$path}<br>";
            } else {
                // Debug: Folder creation failed
                log_message('error', "Failed to create folder: {$path}");
                // echo "Failed to create folder: {$path}<br>";
            }
        } else {
            // Debug: Folder already exists
            log_message('debug', "Folder already exists: {$path}");
            // echo "Folder already exists: {$path}<br>";
        }
    }

    $config['upload_path'] = $basePath . 'product_original/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('featured_image')) {
        $data = $this->upload->data();
        $filename = $data['file_name'];

        // Debug: Upload success
        log_message('debug', "Featured image uploaded: {$filename}");
        echo "<pre>"; print_r($data); echo "</pre>";
        var_dump($data['full_path']);

        // Resize images into respective folders
        $this->_resize_image($data['full_path'], $basePath . 'product_large/' . $filename, 1000);
        $this->_resize_image($data['full_path'], $basePath . 'product_medium/' . $filename, 538);
        $this->_resize_image($data['full_path'], $basePath . 'product_small/' . $filename, 255);
        $this->_resize_image($data['full_path'], $basePath . 'product_thumb/' . $filename, 113);

        return $filename;
    } else {
        // Debug: Upload failegit 
        $error = $this->upload->display_errors();
        log_message('error', "Featured image upload failed: {$error}");
        echo "Upload error: {$error}";
    }

    return false;
}



    // Handiling Gallery image
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

                $config['upload_path']   = './images/product_original/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gallery')) {
                    $data = $this->upload->data();
                    $filename = $data['file_name'];

                    // Resize gallery
                    $this->_resize_image($data['full_path'], './images/product_large/' . $filename, 1000);
                    $this->_resize_image($data['full_path'], './images/product_medium/' . $filename, 538);
                    $this->_resize_image($data['full_path'], './images/product_thumb/' . $filename, 113);

                    $this->Product_model->insert_image($filename, $product_id);
                }
            }
        }
    }

    public function subcategory_for_product($id)
    {
        header('Content-Type: application/json');
        $this->load->model('Sub_category_model');
        $data = $this->Sub_category_model->get_category_under_subcategory($id);
        echo json_encode($data);
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

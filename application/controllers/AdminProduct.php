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
        $data['products'] = $products;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/product', $data);
        $this->load->view('admin/footer');
    }
    # =>Product/Add
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

    # =>Product/Edit
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



    # =>Product/Submit
    public function submit_product()
    {
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
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
                // echo "Missing required fields: category_id=$category_id, product_name=$product_name, product_price=$product_price";
                // exit;

                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Missing required fields.'
                ]);
                    
                redirect(base_url('admin/product'));
            }

            // Upload featured image
            $featured_image_name = $this->_upload_featured_image();

            if (!$featured_image_name) {
                // Debug: Failed image upload
                echo "Featured image upload failed.";


                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Failed to upload featured image.'
                ]);
                redirect(base_url('admin/product'));
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
            // echo "<pre>";
            // print_r($product_data);
            // echo "</pre>";
            // exit;


            $product_id = $this->Product_model->insert_product($product_data);

            // Upload gallery images
            $this->_upload_gallery_images($product_id);

            // Debug: Confirm product ID and gallery upload
            echo "Product inserted with ID: $product_id";


            $this->session->set_flashdata('flash', [
                'type' => 'success',
                'message' => 'Product added successfully!'
            ]);
            redirect(base_url('admin/product'));
        } else {
            // Debug: Invalid request method
            // echo "Invalid request method: " . $_SERVER['REQUEST_METHOD'];
            // exit;


            redirect(base_url('admin/product'));
         
        }
    }

    # =>Product/Delete
    public function delete_product($pid = '')
    {
        $this->load->library('session');
        if (!empty($pid)) {
            $deleted = $this->Product_model->soft_delete_product($pid);

            if ($deleted) {
                $this->session->set_flashdata('flash', [
                    'type' => 'success',
                    'message' => 'Product deleted successfully!'
                ]);
            } else {
                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'There was something wrong!'
                ]);
            }

         redirect(base_url('admin/product'));
        }
    }

    # =>Product/Update
    public function update_product()
    {
        $this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            log_message('debug', 'Received POST request for product update.');
            var_dump($this->input->post());

            $id = (int) $this->input->post('product_id');
            $category = (int) $this->input->post('category');
            $sub_category = $this->input->post('subcategory') ? (int) $this->input->post('subcategory') : null;
            $product_name = trim($this->input->post('product_name'));
            $product_price = (float) $this->input->post('product_price');
            $product_desc = trim($this->input->post('product_desc'));
            $availability = trim($this->input->post('availability')) ?: 'Out of Stock';
            $special_product = $this->input->post('special_product') ? 'yes' : 'no';
            $featured_product = $this->input->post('featured_product') ? 'yes' : 'no';
            $removed_images = trim($this->input->post('removed_images'));

            log_message('debug', "Updating product ID: {$id}");

            $file_locations = ['product_large', 'product_medium', 'product_original', 'product_small', 'product_thumb'];
            $basePath = FCPATH . 'uploads/';

            $product_data = $this->Product_model->get_product_by_id($id);
            if (!$product_data) {
                log_message('error', "Product ID {$id} not found.");
                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Product not found!'
                ]);
               redirect(base_url('admin/product'));
            }

            $featured_image = $product_data['featured_image'];

            // === Handle Featured Image Upload ===
            if (!empty($_FILES['featured_image']['name'])) {
                log_message('debug', 'Featured image upload detected.');

                foreach ($file_locations as $folder) {
                    $filePath = $basePath . $folder . '/' . $featured_image;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                        log_message('debug', "Deleted old featured image: {$filePath}");
                    }
                }

                $config['upload_path'] = $basePath . 'product_original/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('featured_image')) {
                    $data = $this->upload->data();
                    $featured_image = $data['file_name'];
                    log_message('debug', "New featured image uploaded: {$featured_image}");

                    $sizes = [
                        'product_large' => 1000,
                        'product_medium' => 538,
                        'product_small' => 255,
                        'product_thumb' => 113
                    ];

                    foreach ($sizes as $folder => $width) {
                        $dest_path = $basePath . $folder . '/' . $featured_image;
                        $this->_resize_image($data['full_path'], $dest_path, $width);
                        log_message('debug', "Resized featured image to {$width}px in {$folder}");
                    }
                } else {
                    log_message('error', 'Featured image upload failed: ' . $this->upload->display_errors());
                }
            }

            // === Remove Gallery Images ===
            if (!empty($removed_images)) {
                log_message('debug', "Removing gallery images: {$removed_images}");

                $ids = array_map('intval', explode(' ', $removed_images));
                $images = $this->Product_model->get_gallery_images_by_ids($ids);

                foreach ($images as $image) {
                    foreach ($file_locations as $folder) {
                        $filePath = $basePath . $folder . '/' . $image['image_src'];
                        if (file_exists($filePath)) {
                            unlink($filePath);
                            log_message('debug', "Deleted gallery image: {$filePath}");
                        }
                    }
                }

                $this->Product_model->delete_gallery_images($ids);
                log_message('debug', 'Gallery images deleted from database.');
            }

            // === Upload New Gallery Images ===
            if (!empty($_FILES['gallery_image']['name'][0])) {
                log_message('debug', 'Uploading new gallery images.');

                $files = $_FILES;
                $count = count($files['gallery_image']['name']);
                for ($i = 0; $i < $count; $i++) {
                    $_FILES['gallery']['name'] = $files['gallery_image']['name'][$i];
                    $_FILES['gallery']['type'] = $files['gallery_image']['type'][$i];
                    $_FILES['gallery']['tmp_name'] = $files['gallery_image']['tmp_name'][$i];
                    $_FILES['gallery']['error'] = $files['gallery_image']['error'][$i];
                    $_FILES['gallery']['size'] = $files['gallery_image']['size'][$i];

                    $config['upload_path'] = $basePath . 'product_original/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('gallery')) {
                        $data = $this->upload->data();
                        $filename = $data['file_name'];
                        log_message('debug', "Gallery image uploaded: {$filename}");

                        $sizes = [
                            'product_large' => 1000,
                            'product_medium' => 538,
                            'product_thumb' => 113
                        ];

                        foreach ($sizes as $folder => $width) {
                            $dest_path = $basePath . $folder . '/' . $filename;
                            $this->_resize_image($data['full_path'], $dest_path, $width);
                            log_message('debug', "Resized gallery image to {$width}px in {$folder}");
                        }

                        $this->Product_model->insert_image($filename, $id);
                        log_message('debug', "Inserted gallery image into DB: {$filename}");
                    } else {
                        log_message('error', 'Gallery image upload failed: ' . $this->upload->display_errors());
                    }
                }
            }

            // === Update Product ===
            $update_data = [
                'name' => $product_name,
                'price' => $product_price,
                'description' => $product_desc,
                'category_id' => $category,
                'sub_category_id' => $sub_category,
                'availability' => $availability,
                'featured_image' => $featured_image,
                'special_product' => $special_product,
                'featured_product' => $featured_product,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            log_message('debug', 'Updating product with data: ' . json_encode($update_data));

            $updated = $this->Product_model->update_product($id, $update_data);

            if ($updated) {
                log_message('debug', "Product ID {$id} updated successfully.");
                $this->session->set_flashdata('flash', [
                    'type' => 'success',
                    'message' => 'Product updated successfully!'
                ]);
            } else {
                log_message('error', "Failed to update product ID {$id}.");
                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Failed to update product.'
                ]);
            }

            redirect(base_url('admin/product'));
        }
    }

    /*
      ====================================================================
      ======================= Product Helper Function=====================

    */
    // Handling Featured image
    private function _upload_featured_image()
    {
        $basePath = FCPATH . 'uploads/';
        $folders = ['product_original', 'product_large', 'product_medium', 'product_small', 'product_thumb'];

        foreach ($folders as $folder) {
            $path = $basePath . $folder;
            if (!is_dir($path)) {
                if (mkdir($path, 0777, true)) {
                    log_message('debug', "Created folder: {$path}");
                    // echo "Created folder: {$path}<br>";
                } else {
                    log_message('error', "Failed to create folder: {$path}");
                    // echo "Failed to create folder: {$path}<br>";
                }
            } else {
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
            echo "<pre>";
            print_r($data);
            echo "</pre>";
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
    // Handiling Gallery image ...
    private function _upload_gallery_images($product_id)
    {
        $basePath = FCPATH . 'uploads/';
        if (!empty($_FILES['gallery_image']['name'][0])) {
            $files = $_FILES;
            $count = count($files['gallery_image']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['gallery']['name']     = $files['gallery_image']['name'][$i];
                $_FILES['gallery']['type']     = $files['gallery_image']['type'][$i];
                $_FILES['gallery']['tmp_name'] = $files['gallery_image']['tmp_name'][$i];
                $_FILES['gallery']['error']    = $files['gallery_image']['error'][$i];
                $_FILES['gallery']['size']     = $files['gallery_image']['size'][$i];

                $config['upload_path']   = $basePath . 'product_original/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gallery')) {
                    $data = $this->upload->data();
                    $filename = $data['file_name'];
                    var_dump($data['full_path']);

                    // Resize gallery
                    $this->_resize_image($data['full_path'], $basePath . 'product_large/' . $filename, 1000);
                    $this->_resize_image($data['full_path'], $basePath . 'product_medium/' . $filename, 538);
                    $this->_resize_image($data['full_path'], $basePath . 'product_thumb/' . $filename, 113);

                    $this->Product_model->insert_image($filename, $product_id);
                }
            }
        }
    }
    // Async Js Function ...
    public function subcategory_for_product($id)
    {
        header('Content-Type: application/json');
        $this->load->model('Sub_category_model');
        $data = $this->Sub_category_model->get_category_under_subcategory($id);
        echo json_encode($data);
    }
    // image resize function ...
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminCategory extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Category_model');
        $query = $this->input->get('query');
        $categories = $this->Category_model->get_categories_with_sub_count($query);
        $data['pageTitle'] = 'Category';
        $data['flash'] = $this->session->flashdata('flash');
        $data['categories'] = $categories;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/category', $data);
        $this->load->view('admin/footer');
    }
    public function add_category()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['category'] = ['category_name' => '', 'order' => '', 'image' => '', 'status' => ''];
        $data['pageTitle'] = 'Add Category';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_category', $data);
        $this->load->view('admin/footer');
    }
    public function edit_category($id = '')
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['category_id'] = $id;
        $data['pageTitle'] = 'Edit Category';
        $data['category'] = $this->db->get_where('category', ['id' => $id])->row_array();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_category', $data);
        $this->load->view('admin/footer');
    }

    public function submit_category()
    {
        date_default_timezone_set('Asia/Kolkata');
        // Upload configuration
        $config['upload_path']   = FCPATH . 'uploads/category_images/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 1024; // 1MB
        $config['encrypt_name']  = TRUE; // Generates a unique filename

        // Load upload library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            // Upload failed
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flash', ['type' => 'error', 'message' => $error]);
            redirect('admin/add_category');
        } else {
            // Upload success
            $uploadData = $this->upload->data();
            $uploadData = $uploadData['file_name'];
            $data = [
                'category_name' => $this->input->post('category_name'),
                'image'         => $uploadData,
                'order'         => $this->input->post('order') ?? '0',
                'status'        => $this->input->post('status'),
                'created_at'    => date('Y-m-d H:i:s')

            ];
            $this->Category_model->insert_category($data);
            $this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Category added successfully!']);
            redirect('admin/category');
        }
    }


    public function update_category()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }

        $id = $this->input->post('category_id');
        $category_name = $this->input->post('category_name');
        $order = $this->input->post('order_number');
        $status = $this->input->post('status');
        var_dump($id, $category_name, $order, $status);

        if (empty($id) || empty($category_name)) {
            $this->session->set_flashdata('flash', [
                'type' => 'danger',
                'message' => 'There is something wrong.'
            ]);
            redirect(base_url('admin/category'));
            return;
        }

        // Load existing category
        $category = $this->db->get_where('category', ['id' => $id])->row_array();
        if (!$category) {
            $this->session->set_flashdata('flash', [
                'type' => 'danger',
                'message' => 'There is something wrong.'
            ]);
            redirect(base_url('admin/category'));
            return;
        }

        // Handle image upload
        $category_image = $category['image']; // Default to existing image

        var_dump($category_image);
        var_dump($_FILES['image']['name']);

        if (!empty($_FILES['image']['name'])) {
            $upload_path = FCPATH . 'uploads/category_images/';

            // Configuration for upload
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 1024; // Max size in KB (1MB)
            $config['encrypt_name']  = TRUE; // Rename file to avoid conflicts
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            // Delete old image if it exists
            $old_image_path = $upload_path . $category['image'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
                // Debug: Uncomment to confirm deletion
                echo "Deleted old image: " . $old_image_path . "<br>";
            }

            // Attempt to upload new image
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $category_image = $upload_data['file_name'];

                echo "<pre>";
                print_r($upload_data);
                echo "</pre>";
            } else {
                // Upload failed — flash error and redirect
                $this->session->set_flashdata('flash', [
                    'type' => 'danger',
                    'message' => 'Image upload failed: ' . $this->upload->display_errors()
                ]);


                echo "Upload error: " . $this->upload->display_errors();
                exit;

                redirect(base_url('admin/category/edit/' . $id));
                return;
            }
        }

        // Prepare update data
        $update_data = [
            'category_name' => $category_name,
            'image' => $category_image,
            'order' => $order,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update database
        $this->db->where('id', $id);
        $result = $this->db->update('category', $update_data);

        if ($result) {
            $this->session->set_flashdata('flash', [
                'type' => 'success',
                'message' => 'Category updated successfully!'
            ]);
        } else {
            $this->session->set_flashdata('flash', [
                'type' => 'danger',
                'message' => 'Error: Cannot update category.'
            ]);
        }

        redirect(base_url('admin/category'));
    }


    public function delete_category($cid)
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }


        if (!empty($cid)) {
            // Checking category is safe to delete
            $checkSql = "
            SELECT id FROM category
            WHERE id = ?
            AND NOT EXISTS (
                SELECT 1 FROM product WHERE product.category_id = category.id
            )
            AND NOT EXISTS (
                SELECT 1 FROM sub_category WHERE sub_category.category_id = category.id
            )
        ";

            $checkResult = $this->db->query($checkSql, [$cid]);

            if ($checkResult->num_rows() > 0) {
                // Safe to delete
                $this->db->where('id', $cid);
                $result = $this->db->delete('category');

                if ($result) {
                    $this->session->set_flashdata('flash', [
                        'type' => 'success',
                        'message' => 'Category deleted successfully!'
                    ]);
                } else {
                    $this->session->set_flashdata('flash', [
                        'type' => 'error',
                        'message' => 'Deletion failed due to a database error.'
                    ]);
                }
            } else {
                $this->session->set_flashdata('flash', [
                    'type' => 'error',
                    'message' => 'Cannot delete: Category has products or subcategories.'
                ]);
            }
        }

        redirect(base_url('admin/category'));
    }
}








































// if ($this->upload->do_upload('category_image')) {
//     $upload_data = $this->upload->data();
//     $category_image = $upload_data['file_name'];

//     // Check image dimensions
//     $image_path = $upload_data['full_path'];
//     list($width, $height) = getimagesize($image_path);

//     // Set your desired limits
//     $max_width = 70;
//     $max_height = 70;

//     if ($width != $max_width || $height != $max_height) {
//         // Delete the uploaded image
//         unlink($image_path);

//         $this->session->set_flashdata('flash', [
//             'type' => 'danger',
//             'message' => "Image must be exactly {$max_width}x{$max_height} pixels."
//         ]);
//         redirect(base_url('admin/category/edit/' . $id));
//         return;
//     }
// } else {
//     // Handle upload failure
//     $this->session->set_flashdata('flash', [
//         'type' => 'danger',
//         'message' => 'Image upload failed: ' . $this->upload->display_errors()
//     ]);
//     redirect(base_url('admin/category/edit/' . $id));
//     return;
// }

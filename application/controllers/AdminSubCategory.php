<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminSubCategory extends CI_Controller
{
    // admin/subcategory
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Sub_category_model');

        $query = $this->input->get('query');
        $sub_categories = $this->Sub_category_model->get_sub_categories($query);

        $data['pageTitle'] = 'Sub Category';
        $data['flash'] = $this->session->flashdata('flash');
        $data['sub_categories'] = $sub_categories;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sub_category', $data);
        $this->load->view('admin/footer');
    }

    public function add_subcategory()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['subcategory_id'] = '';
        $data['category_name'] =  $this->db->select('id, category_name')->from('category')->get()->result_array();
        $data['subcategory'] = ['name' => '', 'category_id' => '', 'order' => '', 'status' => ''];
        $data['pageTitle'] = ' Add Sub Category';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_sub_category', $data);
        $this->load->view('admin/footer');
    }

    public function submit_subcategory()
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('Sub_category_model');
        $data = [
            'name' => $this->input->post('sub_category_name'),
            'category_id' => $this->input->post('category'),
            'order' => $this->input->post('order') ?? '0',
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->Sub_category_model->insert_subcategory($data);
        $this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Sub Category added successfully!']);
        redirect('admin/subcategory');
    }

    public function edit_subcategory($id = '')
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['subcategory_id'] = $id;
        $data['pageTitle'] = 'Edit Sub Category';
        $data['category_name'] =  $this->db->select('id, category_name')->from('category')->get()->result_array();
        $data['subcategory'] =   $this->db->get_where('sub_category', ['id' => $id])->row_array();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_sub_category', $data);
        $this->load->view('admin/footer');
    }
    public function update_subcategory()
    {
        date_default_timezone_set('Asia/Kolkata');
        $id = $this->input->post('subcategory_id', TRUE);
        $category_id = $this->input->post('category', TRUE);
        $name = $this->input->post('sub_category_name', TRUE);
        $order = $this->input->post('order', TRUE);
        $status = $this->input->post('status', TRUE);
        $this->db->where('id', $id);
        $this->db->update('sub_category', [
            'name' => $name,
            'category_id' => $category_id,
            'order' => $order,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Sub Category updated successfully!']);
        redirect('admin/subcategory');
    }
    public function delete_subcategory($id)
    {
        var_dump($id);
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }


        if (!empty($id)) {
            // Checking category is safe to delete
            $checkSql =  "SELECT id FROM sub_category
                            WHERE id = '$id'
                            AND NOT EXISTS (
                            SELECT 1 FROM product WHERE product.sub_category_id = sub_category.id
                            )
                        ";

            $checkResult = $this->db->query($checkSql, [$id]);

            if ($checkResult->num_rows() > 0) {
                // Safe to delete
                $this->db->where('id', $id);
                $result = $this->db->delete('sub_category');

                if ($result) {
                    $this->session->set_flashdata('flash', [
                        'type' => 'success',
                        'message' => 'Sub Category deleted successfully!'
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
                    'message' => 'Cannot delete: Sub Category has products.'
                ]);
            }
        }

        redirect(base_url('admin/subcategory'));
    }
}

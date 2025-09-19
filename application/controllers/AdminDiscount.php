<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminDiscount extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Discount_model');

        $query = $this->input->get('query');
        $discounts = $this->Discount_model->get_discounts($query);

        $data['pageTitle'] = 'Discount';
        $data['flash'] = $this->session->flashdata('flash');
        $data['discounts'] = $discounts;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/discount', $data);
        $this->load->view('admin/footer');
    }

    public function edit_discount($id = '')
    {
        if (empty($id)) redirect(base_url('admin/discount'));
        $data['pageTitle'] = 'Edit Discount';
        $data['discount_id'] = $id;
        $data['discount'] = $this->db->select()->from('discount')->where('id', $id)->get()->result_array();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_discount', $data);
        $this->load->view('admin/footer');
    }

    public function add_discount()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $data['discount'] = ['name' => '', 'valid_form' => '', 'valid_till' => '', 'amount' => '', 'type' => '', 'status' => ''];
        $data['pageTitle'] = 'Add Discount';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/add_discount', $data);
        $this->load->view('admin/footer');
    }
    
    public function submit_discount()
    {
        $data = [
            'name' => $this->input->post('discount-name', TRUE) ?? '',
            'valid_form' => $this->input->post('valid-form', TRUE) ?? '',
            'valid_till' => $this->input->post('valid-to', TRUE) ?? '',
            'type' => $this->input->post('type', TRUE) ?? '',
            'amount' => $this->input->post('amount', TRUE) ?? '',
            'status' => $this->input->post('status', TRUE) ?? '',
            'deleted' => 'No',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->load->model('Discount_model');
        $this->Discount_model->insert_discount($data);
        $this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Discount added successfully!']);
        redirect('admin/discount');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminCustomer extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Customer_model');

        $query = $this->input->get('query');
        $customers = $this->Customer_model->get_customers($query);

        $data['pageTitle'] = 'Customer';
        $data['flash'] = $this->session->flashdata('flash');
        $data['customers'] = $customers;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/customer', $data);
        $this->load->view('admin/footer');
    }
}

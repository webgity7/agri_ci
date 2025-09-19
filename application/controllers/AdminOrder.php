<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminOrder extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('auth_user')) {
            redirect(base_url('admin/index'));
        }
        $this->load->model('Order_model');

        $query = $this->input->get('query');
        $orders = $this->Order_model->get_orders($query);

        $data['pageTitle'] = 'Order';
        $data['flash'] = $this->session->flashdata('flash');
        $data['orders'] = $orders;

        $this->load->view('admin/header', $data);
        $this->load->view('admin/order', $data);
        $this->load->view('admin/footer');
    }
}

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

    public function edit_order($id)
    {
        $this->load->model('Order_model');
        $id = (int) $id;
        $data['order_info'] = $this->Order_model->get_order_info($id);
        $data['product'] = $this->Order_model->get_order_products($id);
        $data['order'] = $this->Order_model->get_order_products($id);
        $data['order_id'] = $id;
        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_order', $data);
        $this->load->view('admin/footer');
    }

    public function cancel_order($id)
    {
        $this->load->model('Order_model');

        if (!is_numeric($id) || $id <= 0) {
            $this->session->set_flashdata('flash', [
                'type' => 'error',
                'message' => 'Invalid order ID.'
            ]);
            redirect(base_url('admin/order'));
        }

        $updated = $this->Order_model->cancel_order($id);

        if ($updated) {
            $this->session->set_flashdata('flash', [
                'type' => 'success',
                'message' => 'Order cancelled successfully.'
            ]);
        } else {
            $this->session->set_flashdata('flash', [
                'type' => 'error',
                'message' => 'Failed to cancel the order.'
            ]);
        }

        redirect(base_url('admin/order'));
    }


    public function delete_order($id)
    {
        $this->load->model('Order_model');

        $deleted = $this->Order_model->soft_delete_order($id);

        if ($deleted) {
            $this->session->set_flashdata('flash', [
                'type' => 'success',
                'message' => 'Order deleted successfully (soft delete).'
            ]);
        } else {
            $this->session->set_flashdata('flash', [
                'type' => 'error',
                'message' => 'Failed to delete order.'
            ]);
        }

        redirect(base_url('admin/order'));
    }
}

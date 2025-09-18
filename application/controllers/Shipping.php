<?php
class Shipping extends CI_Controller{
    public function index(){
        $data['title']='Billing';
        $data['categories'] = $this->Category_model->get_categories_with_subcategories();
        $this->load->view('header',$data);
        $this->load->view('billing');
        $this->load->view('footer',$data);
        
    }
}
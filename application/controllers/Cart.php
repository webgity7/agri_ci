<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Controller{
    public function index(){
        $data['title']='Cart';
        $data['categories'] = $this->Category_model->get_categories_with_subcategories();
        $this->load->view('header',$data);
        $this->load->view('cart');
        $this->load->view('footer');

    }

}


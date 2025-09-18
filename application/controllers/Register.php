<?php
class Register extends CI_Controller{
    public function index(){
        $data['title']='Register';
        $data['categories'] = $this->Category_model->get_categories_with_subcategories();
        $this->load->view('header',$data);
        $this->load->view('register');
        $this->load->view('footer',$data);
    }
}

<?php
class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'User Login ';
        $data['categories'] = $this->Category_model->get_categories_with_subcategories();
        $this->load->view('header',$data);
        $this->load->view('login');
        $this->load->view('footer',$data);
        
    }
}

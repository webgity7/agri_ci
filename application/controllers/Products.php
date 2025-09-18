<?php
class Products extends CI_Controller{
    public function index(){
        // Variables ....
        $search=$this->input->post('name', TRUE);
        var_dump($search);
        $data['categories'] = $this->Category_model->get_categories_with_subcategories();
        
        $this->load->view('header',$data);
        $this->load->view('products',$data);
        $this->load->view('footer',$data);

        
    }
}

?>
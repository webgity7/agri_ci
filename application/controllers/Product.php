<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller{
    public function index() {
    $id = $this->input->get('pid');
    $product = $this->Product_model->get_product_by_id($id);
    $images = $this->Product_model->get_product_images($id);
    $related_products = $this->Product_model->get_related_products();
    
    if (!$product) {
        redirect('index');
    }
    $data['categories'] = $this->Category_model->get_categories_with_subcategories();
    $data['title'] = 'AgriExpress | Product';
    $data['product'] = $product;
    $data['images'] = $images;
    $data['related_products'] = $related_products;
    $data['flash'] = $this->session->flashdata('flash');

    $this->load->view('header', $data);
    $this->load->view('product', $data);
    $this->load->view('footer');
}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->model(['Category_model', 'Product_model']);
		$data['title'] = 'AgriExpress';
		$data['search'] = $this->input->get('search');
		$data['cart'] = $this->session->userdata('cart') ?? [];
		$data['categories'] = $this->Category_model->get_categories_with_subcategories();
		$data['flash'] = $this->session->flashdata('flash');
		$data['special_products'] = $this->Product_model->get_special_products();
		$data['featured_products'] = $this->Product_model->get_featured_products();
		

		$this->load->view('header', $data);
		$this->load->view('index', $data);
		$this->load->view('footer');
	}
}

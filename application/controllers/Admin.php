<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	// admin/index
	public function index()
	{
		$this->load->view('admin/index');
	}

	// admin/dashboard
	public function dashboard()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Dashboard_model');
		$data['title'] = 'Dashboard';
		$data['flash'] = $this->session->flashdata('flash');
		$data['counts'] = $this->Dashboard_model->get_dashboard_counts();

		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}


	// admin/category
	public function category()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Category_model');
		$query = $this->input->get('query');
		$categories = $this->Category_model->get_categories_with_sub_count($query);
		$data['pageTitle'] = 'Category';
		$data['flash'] = $this->session->flashdata('flash');
		$data['categories'] = $categories;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/category', $data);
		$this->load->view('admin/footer');
	}
	// admin/sub-category
	public function sub_category()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Sub_category_model');

		$query = $this->input->get('query');
		$sub_categories = $this->Sub_category_model->get_sub_categories($query);

		$data['pageTitle'] = 'Sub Category';
		$data['flash'] = $this->session->flashdata('flash');
		$data['sub_categories'] = $sub_categories;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/sub_category', $data);
		$this->load->view('admin/footer');
	}
	// admin/product
	public function product()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Product_model');

		$query = $this->input->get('query');
		$products = $this->Product_model->get_products($query);

		$data['pageTitle'] = 'Product';
		$data['flash'] = $this->session->flashdata('flash');
		$data['products'] = $products;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/product', $data);
		$this->load->view('admin/footer');
	}
	// admin/order
	public function order()
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
	// admin/discount
	public function discount()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Discount_model');

		$query = $this->input->get('query');
		$discounts = $this->Discount_model->get_discounts($query);

		$data['pageTitle'] = 'Discount';
		$data['flash'] = $this->session->flashdata('flash');
		$data['discounts'] = $discounts;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/discount', $data);
		$this->load->view('admin/footer');
	}

	// admin/customer
	public function customer()
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

	//admin/settings
	public function settings()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->load->model('Admin_model');
		// $username = $this->session->userdata('auth_user')['user_name'];
		//$admin = $this->Admin_model->get_admin_by_username($username);

		$data['pageTitle'] = 'Settings';
		// $data['admin'] = $admin;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/settings', $data);
		$this->load->view('admin/footer');
	}

	// Admin All Add Pages...
	public function add_category()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['category'] = ['category_name' => '', 'order' => '', 'image' => '', 'status' => ''];
		$data['pageTitle'] = 'Add Category';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_category', $data);
		$this->load->view('admin/footer');
	}

	public function add_discount()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['pageTitle'] = 'Add Discount';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_discount', $data);
		$this->load->view('admin/footer');
	}

	public function add_sub_category()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['category_name'] =  $this->db->select('id, category_name')->from('category')->get()->result_array();
		$data['pageTitle'] = ' Add Sub Category';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_sub_category', $data);
		$this->load->view('admin/footer');
	}
	public function add_product()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['category_table'] = $this->db->select('category.id,category.category_name')->from('category')->get()->result_array();
		$data['sub_category_table'] = $this->db->select('`id`, `name`')->from('`sub_category`')->get()->result_array();

		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_product', $data);
		$this->load->view('admin/footer');
	}

	// Admin All Edit Pages...
	public function edit_category($id = '')
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['pageTitle'] = 'Edit Category';
		$data['category'] = $this->db->select()->from('category')->get()->row_array();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_category', $data);
		$this->load->view('admin/footer');
	}

	public function edit_sub_category($id = '')
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$data['pageTitle'] = 'Edit Sub Category';
		$data['category'] = $this->db->select()->form('category');
		$data['subcategory'] = $this->db->select()->form('sub_category');
	}

	public function edit_product($id)
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		
	}

	// All submit Pages...



	// Password Verification 
	public function verify()
	{

		// Get JSON input
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);

		$username = $data['username'] ?? '';
		$password = $data['password'] ?? '';
		// user name empty or not checking...
		if (empty($username)) {
			echo json_encode(['message' => 'Enter the username']);
			http_response_code(401);
			exit;
		}
		// password empty or not checking...
		if (empty($password)) {
			echo json_encode(['message' => 'Enter The password']);
			http_response_code(401);
			exit;
		}

		// user name existence
		$this->load->model('User_model');
		$result = $this->User_model->user_exist($username);
		if ($result) {
			//password verifying
			$id = $result['id'];
			$name = $result['user_name'];
			$old_password = $result['password'];
			$valid_password = password_verify($password, $old_password);

			if ($valid_password) {
				$this->session->set_userdata('auth_user', ['id' => $id, 'name' => $name, 'password' => $old_password]);
				http_response_code(200);
				$this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Welcome back, you have successfully logged in!']);
				echo json_encode(['message' => 'Login successful', 'redirect' => base_url('admin/dashboard')]);
				exit;
			} else {
				echo json_encode(['message' => 'Password invalid']);
				http_response_code(401);
				exit;
			}
		} else {
			echo json_encode(['message' => 'User not valid ']);
			http_response_code(401);
			exit;
		}
	}

	// Logout
	public function logout()
	{
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
		$this->session->unset_userdata('auth_user');
		redirect(base_url('admin'));
		exit;
	}
}


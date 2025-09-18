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
		$data['discount'] = ['name' => '', 'valid_form' => '', 'valid_till' => '', 'amount' => '','type'=>'','status'=>''];
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
		$data['pageTitle'] = 'Add Product';
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
		$data['pageTitle'] = 'Edit Product';
		if (!$this->session->userdata('auth_user')) {
			redirect(base_url('admin/index'));
		}
	}
	public function edit_discount($id=''){
		if(empty($id))redirect(base_url('admin/discount'));
		$data['pageTitle'] = 'Edit Discount';
		$data['discount_id']=$id;
		$data['discount'] = $this->db->select()->from('discount')->where('id',$id)->get()->result_array();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_discount', $data);
		$this->load->view('admin/footer');


		
	}

	// All submit Pages...
	public function submit_category()
	{
		date_default_timezone_set('Asia/Kolkata');
		// Upload configuration
		$config['upload_path']   = FCPATH . 'uploads/category_images/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024; // 2MB
		$config['encrypt_name']  = TRUE; // Generates a unique filename

		// Load upload library
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			// Upload failed
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('flash', ['type' => 'error', 'message' => $error]);
			redirect('admin/add_category');
		} else {
			// Upload success
			$uploadData = $this->upload->data();
			$uploadData = $uploadData['file_name'];
			$data = [
				'category_name' => $this->input->post('category_name'),
				'image'         => $uploadData,
				'order'         => $this->input->post('order') ?? '0',
				'status'        => $this->input->post('status'),
				'created_at'    => date('Y-m-d H:i:s')

			];
			$this->Category_model->insert_category($data);
			$this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Category added successfully!']);
			redirect('admin/category');
		}
	}

	public function submit_sub_category()
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Sub_category_model');
		$data = [
			'name' => $this->input->post('sub_category_name'),
			'category_id' => $this->input->post('category'),
			'order' => $this->input->post('order') ?? '0',
			'status' => $this->input->post('status'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->Sub_category_model->insert_subcategory($data);
		$this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Sub Category added successfully!']);
		redirect('admin/sub_category');
	}

	public function submit_product()
	{
		$data = $this->input->post();
		var_dump($data);
	}

	public function submit_discount()
	{
		$data=[
			'name'=>$this->input->post('discount-name',TRUE) ?? '',
			'valid_form'=> $this->input->post('valid-form',TRUE) ?? '',
			'valid_till'=>$this->input->post('valid-to',TRUE) ?? '',
			'type'=>$this->input->post('type',TRUE) ?? '',
			'amount'=>$this->input->post('amount',TRUE) ?? '',			
			'status'=>$this->input->post('status',TRUE) ?? '',
			'deleted'=>'No',
			'created_at'=> date('Y-m-d H:i:s'),
		];
		$this->load->model('Discount_model');
		$this->Discount_model->insert_discount($data);
		$this->session->set_flashdata('flash', ['type' => 'success', 'message' => 'Discount added successfully!']);
		redirect('admin/discount');
		
	}




	public function subcategory_for_product($id)
	{
		header('Content-Type: application/json');
		$this->load->model('Sub_category_model');
		$data = $this->Sub_category_model->get_category_under_subcategory($id);
		echo json_encode($data);
	}





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

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

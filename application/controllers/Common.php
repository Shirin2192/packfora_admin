<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *"); // or use a specific domain instead of '*'
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

class Common extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		 // Prevent browser caching for all admin pages
		 $this->output
		 ->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0")
		 ->set_header("Cache-Control: post-check=0, pre-check=0", false)
		 ->set_header("Pragma: no-cache");
	}

	public function index()
	{
		$this->load->view('admin/login');
	}
	public function registration(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
			
		// Form Validation Rules
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('common/index', [
				'error_name' => form_error('name'),
				'error_email' => form_error('email'),
				'error_password' => form_error('password')
			]);
		} else {
			$data = [
				'name' => $name,
				'email' => $email,
				'password' => decy_ency('encrypt',$password), 
			];
	
			$response = $this->model->insertData('tbl_user', $data);
	
			if ($response) {
				echo json_encode(["status" => "success", "message" => "Registration successful!"]);
			} else {
				echo json_encode(["status" => "error", "message" => "Registration failed. Try again."]);
			}
		}
	}

	public function login_process() {
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			// Return validation errors as JSON
			$response = [
				'status' => 'error',
				'email_error' => form_error('email'),
				'password_error' => form_error('password')
			];
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');	
			// Fetch user data
			$user = $this->model->selectWhereData("tbl_user", array("email" => $email));
			if ($user) {
				// Decrypt stored password for verification
				$stored_password = $user['password'];
				if ($stored_password == decy_ency('encrypt', $password)) { 					
					// Assign session variable name based on role
					$session_name = '';
					switch ($user['email']) {
						case 1:
							$session_name = 'admin_session';
							$redirect_url = base_url('admin');
							break;						
						default:
							$session_name = 'admin_session';
							$redirect_url = base_url('admin');
							break;
					}	
					// Set session data with role-based session name
					$session_data = [
						'user_id'   => $user['id'],
						'name'      => $user['name'],
						'email'     => $user['email'],
						'session_type' => $session_name // Store session type
					];					
					$this->session->set_userdata($session_name, $session_data);	
					$response = ['status' => 'success', 'redirect' => $redirect_url];
				} else {
					$response = ['status' => 'error', 'password_error' => 'Invalid Password'];
				}
			} else {
				$response = ['status' => 'error', 'email_error' => 'Invalid Email'];
			}
		}
	
		echo json_encode($response);
	}
	
	
	public function logout() {
		// Destroy session data
		$this->session->sess_destroy(); // Completely destroy session
	
		// Redirect to login page
		redirect(base_url('common/index'));
	}
}
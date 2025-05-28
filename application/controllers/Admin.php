<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('admin/dashboard');
	}
	public function slider()
	{
		$this->load->view('admin/slider');
	}
	public function save_slider() {
		// Set validation rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('link', 'Link', 'required');

		// Run validation
		if (!$this->form_validation->run()) {
			$errors = [
				'title' => form_error('title', '<span>', '</span>'),
				'description' => form_error('description', '<span>', '</span>'),
				'link' => form_error('link', '<span>', '</span>')
			];
			echo json_encode(['status' => false, 'errors' => $errors]);
			return;
		}
		// Image validation
		if (empty($_FILES['img']['name'])) {
			echo json_encode(['status' => false, 'errors' => ['img' => 'Image file is required.']]);
			return;
		}

		// File upload config
		$config['upload_path'] = './uploads/sliders/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['file_name'] = time() . '_' . $_FILES['img']['name'];

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('img')) {
			echo json_encode(['status' => false, 'errors' => ['img' => strip_tags($this->upload->display_errors())]]);
			return;
		}

		// Prepare data
		$uploadData = $this->upload->data();
		$data = [
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'link' => $this->input->post('link'),
			'image' => 'uploads/sliders/' . $uploadData['file_name'],
			'status' => 'active'
		];

		// Insert into database
		$this->model->insertData('slider', $data);
		echo json_encode(['status' => true, 'message' => 'Slider added successfully']);
	}

	public function contact_us()
	{
		$this->load->view('admin/contact_us');
	}
	public function save_contactus_form() {
		$response = ['status' => false, 'errors' => []];
		// Load form validation library
		$this->load->library('form_validation');

		// Set validation rules
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('contact_no', 'Contact Number', 'required');
		$this->form_validation->set_rules('designation', 'Designation', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Collect validation errors
			$response['errors'] = [
				'name' => form_error('name'),
				'email' => form_error('email'),
				'contact_no' => form_error('contact_no'),
				'designation' => form_error('designation')
			];
		} else {
			// Handle file upload if exists
			$img_path = '';
			if (!empty($_FILES['img']['name'])) {
				$config['upload_path'] = './uploads/contact_files/';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
				$config['max_size'] = 2048; // 2MB
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('img')) {
					$response['errors']['img'] = $this->upload->display_errors('', '');
					echo json_encode($response);
					return;
				} else {
					$upload_data = $this->upload->data();
					$img_path = base_url().'uploads/contact_files/' . $upload_data['file_name'];
				}
			}

			// Prepare data for insertion
			$data = [
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true),
				'contact_no' => $this->input->post('contact_no', true),
				'designation' => $this->input->post('designation', true),
				'attachment' => $img_path,

			];

			// Save data to database
			$this->model->insertData('tbl_contact_us', $data);

			$response['status'] = true;
			$response['message'] = 'Your message has been submitted successfully!';
		}

		echo json_encode($response);
	}
	public function get_contact_us(){
		$response['data'] = $this->model->selectWhereData('tbl_contact_us',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_contact_us_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_contact_us',array('is_delete'=>'1', 'id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_contactus_form() {
		$response = ['status' => false, 'errors' => []];
		// Load form validation library
		$this->load->library('form_validation');

		// Set validation rules
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('edit_contact_no', 'Contact Number', 'required');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Collect validation errors
			$response['errors'] = [
				'edit_name' => form_error('edit_name'),
				'edit_email' => form_error('edit_email'),
				'edit_contact_no' => form_error('edit_contact_no'),
				'edit_designation' => form_error('edit_designation')
			];
		} else {
			$id = $this->input->post('id');
			$data = [
				'name' => $this->input->post('edit_name', true),
				'email' => $this->input->post('edit_email', true),
				'contact_no' => $this->input->post('edit_contact_no', true),
				'designation' => $this->input->post('edit_designation', true),
			];
			// Save data to database
			$this->model->updateData('tbl_contact_us', $data,array('id' => $id, 'is_delete' => '1'));
			$response['status'] = true;
			$response['message'] = 'Details Updated successfully!';
		}

		echo json_encode($response);
	}
	public function enquiry_data()
	{
		$this->load->view('admin/enquiry_data');
	}
	public function our_clients()
	{
		$this->load->view('admin/our_clients');
	}
	public function carrer_form_data()
	{
		$this->load->view('admin/carrer_form_data');
	}
	public function current_opening()
	{
		$this->load->view('admin/current_opening');
	}
	public function save_current_opening(){
		// Set validation rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');

		// Run validation
		if (!$this->form_validation->run()) {
			$errors = [
				'title' => form_error('title', '<span>', '</span>'),
				'description' => form_error('description', '<span>', '</span>'),
				'location' => form_error('location', '<span>', '</span>')
			];
			echo json_encode(['status' => false, 'errors' => $errors]);
			return;
		}
		
		$data = [
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'location' => $this->input->post('location'),
		];
		// Insert into database
		$this->model->insertData('current_opening', $data);
		echo json_encode(['status' => true, 'message' => 'Current Opening added successfully']);
	}
	public function get_current_openings(){
		$response['data'] = $this->model->selectWhereData('current_opening',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_current_opening_detail(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('current_opening',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_current_opening()
	{
		$this->load->library('form_validation');
		// Set validation rules
		$this->form_validation->set_rules('id', 'ID', 'required|integer');
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');
		$this->form_validation->set_rules('location', 'Location', 'required|max_length[255]');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			// Send validation errors as JSON
			$errors = [
				'title' => form_error('title'),
				'location' => form_error('location'),
				'description' => form_error('description'),
			];
			echo json_encode(['status' => false, 'errors' => $errors]);
			return;
		}
		$id = $this->input->post('id');
		$data = [
			'title' => $this->input->post('title'),
			'location' => $this->input->post('location'),
			'description' => $this->input->post('description'),
		];
		// Update the record in DB (adjust table name as needed)
		$updated = $this->model->updateData('current_opening', $data, array('id' => $id, 'is_delete' => '1'));
		if ($updated) {
			echo json_encode(['status' => true, 'message' => 'Current opening updated successfully.']);
		} else {
			echo json_encode(['status' => false, 'message' => 'Failed to update.']);
		}
	}
	public function delete_current_opening()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('current_opening', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Current opening deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the current opening.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}


	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/dashboard');
		}
	}
	public function slider()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/slider');
		}
	}
	public function save_slider() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('button_link', 'Button Link', 'required');
		$this->form_validation->set_rules('slide_order', 'Slide Order', 'required|integer');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => $this->form_validation->error_array()
			]);
			return;
		}

		$data = [
			'title'        => $this->input->post('title'),
			'subtitle'     => $this->input->post('subtitle'),
			'button_text'  => $this->input->post('button_text'),
			'button_link'  => $this->input->post('button_link'),
			'slide_order'  => $this->input->post('slide_order'),
		];

		// Upload image
		if (!empty($_FILES['image']['name'])) {
		$this->load->library('upload');

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|webp';
			$config['max_size'] = 2048;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
				return;
			}

			$upload_data = $this->upload->data();
			$data['image'] = './uploads/'.$upload_data['file_name'];
		}

		$this->model->insertData('tbl_slider', $data);

		echo json_encode(['status' => 'success', 'message' => 'Slider added successfully.']);
	}
	public function get_slider_data(){
		$response['data'] = $this->model->selectWhereData('tbl_slider',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_slider_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_slider',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_slider()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_slide_order', 'Slide Order', 'required|trim');
	

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'edit_title' => form_error('edit_title'),
					'edit_order' => form_error('edit_order'),
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$title = $this->input->post('edit_title');
		$subtitle = $this->input->post('edit_subtitle');
		$button_text = $this->input->post('edit_button_text');
		$button_link = $this->input->post('edit_button_link');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'title' => $title,
			'subtitle' => $subtitle,
			'button_text' => $button_text,
			'button_link' => $button_link,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_slider', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Slider updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed tupdate Slider data.']);
		}
	}
	public function delete_slider()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_slider', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Slider Details deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Slider Details.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function contact_us()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/contact_us');
		}
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
	public function update_contactus() {
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
	public function delete_contactus()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_contact_us', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Contact Us Details deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Contact Us Details.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function enquiry_data()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/enquiry_data');
		}
	}
	public function get_enquiry_contact_data(){
		$response['data'] = $this->model->selectWhereData('contact_inquiries',array(), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_enquiry_contact_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('contact_inquiries',array('id'=> $id), '*');
		echo json_encode($response);
	}
	public function our_clients()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/our_clients');
		}
	}	
	public function upload_client_image()
	{
		// Set upload configuration
		$config['upload_path']   = './uploads/clients/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size']      = 2048; // in KB
		$config['encrypt_name']  = TRUE;

		// Create directory if not exists
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('img')) {
			// Remove <p> tags or any HTML from the error message
			$error = strip_tags($this->upload->display_errors());
			echo json_encode([
				'status' => false,
				'message' => $error
			]);
			return;
		}
		$uploadData = $this->upload->data();
		$filename = $uploadData['file_name'];

		// Save file path to DB (optional: add validation/sanitization)
		$save = $this->model->insertData('our_clients', [
			'image' => 'uploads/clients/' . $filename
		]);

		if ($save) {
			echo json_encode([
				'status' => true,
				'message' => 'Image uploaded successfully',
				'filename' => $filename
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Image uploaded but failed to save in database.'
			]);
		}
	}
	public function get_clients_data()
	{
		$response['data'] = $this->model->selectWhereData('our_clients',array('is_delete' => '1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_clients_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('our_clients',array('id'=> $id), '*');
		echo json_encode($response);
	}

	public function delete_clients_image()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('our_clients', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Clients deleted successfully.';
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

	public function carrer_form_data()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/carrer_form_data');
		}
	}
	public function get_career_enquiry_data()
	{
		$response['data'] = $this->model->selectWhereData('career_applications',array(), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_career_enquiry_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('career_applications',array('id'=> $id), '*');
		echo json_encode($response);
	}
	public function current_opening()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/current_opening');
		}
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
	
// Carrer Explore Opportunity
	public function shine_with_us(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/shine_with_us');
		}
	}
	public function save_shine_with_us()
	{
		$this->load->library('form_validation');

		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_shine_with_us', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Shine with us data saved successfully.']);
			}
		}
	}
	public function get_shine_with_us_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_shine_with_us',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_shine_with_us_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_shine_with_us',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_shine_with_us()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}

		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_shine_with_us', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Shine with us updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update shine with us data.']);
		}
	}
	public function delete_shine_with_us()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_shine_with_us', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Shine with us deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the shine with us.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Why Join Packfora

	public function why_people_choose_packfora(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/why_people_choose_packfora');
		}
	}
	public function save_why_people_choose_packfora()
	{
		$this->load->library('form_validation');

		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_why_people_choose_packfora', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Why People Choose Packfora saved successfully.']);
			}
		}
	}
	public function get_why_people_choose_packfora_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_why_people_choose_packfora',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_why_people_choose_packfora_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_why_people_choose_packfora',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_why_people_choose_packfora()
	{
		$this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('description', 'Description', 'required|trim');

    if ($this->form_validation->run() === FALSE) {
        echo json_encode([
            'status' => 'error',
            'errors' => [
                'title' => form_error('title'),
                'description' => form_error('description'),
            ]
        ]);
        return;
    }

    $id = $this->input->post('id');
    $title = $this->input->post('title');
    $description = $this->input->post('description');
    $previous_image = $this->input->post('edit_previous_image');

    $image = $previous_image;
    if (!empty($_FILES['edit_image']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('edit_image')) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['edit_image' => $this->upload->display_errors('', '')]
            ]);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image = 'uploads/' . $upload_data['file_name'];

            // Optional: delete old image
            if ($previous_image && file_exists($previous_image)) {
                @unlink($previous_image);
            }
        }
    }

    // Update DB
    $data = [
        'title' => $title,
        'description' => $description,
        'image' => $image,
    ];

		if ($this->model->updateData('tbl_why_people_choose_packfora', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Why People Choose Packfora updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Why People Choose Packforas data.']);
		}
	}
	public function delete_why_people_choose_packfora()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_why_people_choose_packfora', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Why People Choose Packfora deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Why People Choose Packfora.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// student_talent_economy
	public function student_talent_economy(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			// Load the view for student talent economy
			$response['data'] = $this->model->selectWhereData('tbl_student_talent_economy',array(), '*' );
			$this->load->view('admin/student_talent_economy',$response);
		}
	}
	public function save_update_student_talent_economy()
    {
        $this->load->library('form_validation');

        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'description' => form_error('description')
                ]
            ]);
            return;
        }

        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ];

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['file_name'] = time().'_'.$_FILES['image']['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => [
                        'image' => $this->upload->display_errors('', '')
                    ]
                ]);
                return;
            } else {
                $upload_data = $this->upload->data();
                $data['image'] = 'uploads/' . $upload_data['file_name'];
            }
        }

        if ($id) {
            // Update
           $this->model->updateData('tbl_student_talent_economy', $data, array('id' => $id));
			$message = 'Updated successfully.';
        } else {
            // Insert
           $this->model->insertData('tbl_student_talent_economy', $data);
            $message = 'Inserted successfully.';
        }

        echo json_encode(['status' => 'success', 'message' => $message]);
    }
	// global_culture
	public function global_culture(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session	) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			
			$this->load->view('admin/global_culture');
		}
	}
	public function save_global_culture()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_global_culture', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Global Culture data saved successfully.']);
			}
		}
	}
	public function get_global_culture_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_global_culture',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_global_culture_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_global_culture',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_global_culture()
	{
		$this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('description', 'Description', 'required|trim');

    if ($this->form_validation->run() === FALSE) {
        echo json_encode([
            'status' => 'error',
            'errors' => [
                'title' => form_error('title'),
                'description' => form_error('description'),
            ]
        ]);
        return;
    }

    $id = $this->input->post('id');
    $title = $this->input->post('title');
    $description = $this->input->post('description');
    $previous_image = $this->input->post('edit_previous_image');

    $image = $previous_image;
    if (!empty($_FILES['edit_image']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('edit_image')) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['edit_image' => $this->upload->display_errors('', '')]
            ]);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image = 'uploads/' . $upload_data['file_name'];

            // Optional: delete old image
            if ($previous_image && file_exists($previous_image)) {
                @unlink($previous_image);
            }
        }
    }

    // Update DB
    $data = [
        'title' => $title,
        'description' => $description,
        'image' => $image,
    ];

		if ($this->model->updateData('tbl_global_culture', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Global Culture updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Global Culture data.']);
		}
	}
	public function delete_global_culture()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_global_culture', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'global culture deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the global culture.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// work_with_technocarts
	public function work_with_technocarts(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/work_with_technocarts');
		}
	}
	public function save_work_with_technocarts()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
		} else {			
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
				];
				// Insert into database
				$this->model->insertData('tbl_work_with_technocarts', $data);
				echo json_encode(['status' => 'success', 'message' => 'Work With Technocarts data saved successfully.']);
		}
	}
	public function get_work_with_technocarts_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_work_with_technocarts',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_work_with_technocarts_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_work_with_technocarts',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_work_with_technocarts()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$data = [
			'title' => $title,
			'description' => $description,
		];
		if ($this->model->updateData('tbl_work_with_technocarts', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Work With Technocarts updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Work With Technocarts data.']);
		}
	}
	public function delete_work_with_technocarts()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_work_with_technocarts', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Work With Technocarts deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Work With Technocarts.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// life_at_packfora
	public function life_at_packfora(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/life_at_packfora');
		}
	}
	public function save_life_at_packfora() {
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
	    $this->form_validation->set_rules('image', 'Image', 'callback_image_check');

	    if ($this->form_validation->run() == FALSE) {
	        echo json_encode([
	            'status' => 'error',
	            'errors' => [
	                'video' => form_error('video'),
	                'image' => form_error('image')
	            ]
	        ]);
	    } else {
	        $video_name = '';
	        $image_name = '';

	        // ------------------ Video Upload ------------------
	        if (!empty($_FILES['video']['name'])) {
	            $config['upload_path']   = './uploads/';
	            $config['allowed_types'] = 'mp4|mov|avi|wmv';
	            $config['max_size']      = 51200; // 50MB
	            $this->load->library('upload', $config);

	            if (!$this->upload->do_upload('video')) {
	                echo json_encode([
	                    'status' => 'error',
	                    'errors' => [
	                        'video' => $this->upload->display_errors()
	                    ]
	                ]);
	                return;
	            } else {
	                $upload_data = $this->upload->data();
	                $video_name = 'uploads/' . $upload_data['file_name'];
	            }
	        }

	        // ------------------ Image Upload ------------------
	        if (!empty($_FILES['image']['name'])) {
	            $config['upload_path']   = './uploads/';
	            $config['allowed_types'] = 'jpg|jpeg|png|webp';
	            $config['max_size']      = 5120; // 5MB
	            $config['file_name']     = time() . '_' . $_FILES['image']['name'];
	            $this->upload->initialize($config); // Reinitialize for new settings

	            if (!$this->upload->do_upload('image')) {
	                echo json_encode([
	                    'status' => 'error',
	                    'errors' => [
	                        'image' => $this->upload->display_errors()
	                    ]
	                ]);
	                return;
	            } else {
	                $image_data = $this->upload->data();
	                $image_name = 'uploads/' . $image_data['file_name'];
	            }
	        }

	        // ------------------ DB Insert ------------------
	        $insert_data = [
	            'video' => $video_name,
	            'image' => $image_name
	        ];

	        $this->model->insertData('tbl_life_at_packfora', $insert_data);

	        echo json_encode(['status' => 'success', 'message' => 'Video and image uploaded successfully']);
	    }
	}
	public function image_check() {
	    if (empty($_FILES['image']['name'])) {
	        $this->form_validation->set_message('image_check', 'Please upload an image.');
	        return false;
	    }
	    return true;
	}


    public function video_check($str) {
        if (empty($_FILES['video']['name'])) {
            $this->form_validation->set_message('video_check', 'The Video field is required.');
            return FALSE;
        }
        return TRUE;
    }
	public function get_life_at_packfora_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_life_at_packfora',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_life_at_packfora_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_life_at_packfora',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_life_at_packfora()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'ID', 'required');

		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$previous_image = $this->input->post('edit_previous_image');
		$video_name = $previous_video;
		$image_name = $previous_image;

		// ------------------- Video Upload -------------------
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv';
			$config['max_size']      = 51200; // 50MB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old video
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} elseif (empty($previous_video)) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'edit_video' => 'The Video field is required.'
				]
			]);
			return;
		}

		// ------------------- Image Upload -------------------
		if (!empty($_FILES['edit_image']['name'])) {
			$this->load->library('upload');
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|webp';
			$config['max_size']      = 5120; // 5MB
			$config['file_name']     = time() . '_' . $_FILES['edit_image']['name'];

			$this->upload->initialize($config); // Reinitialize for new settings

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_image' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$img_data = $this->upload->data();
				$image_name = 'uploads/
				+' . $img_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image) && $previous_image != $image_name) {
					@unlink($previous_image);
				}
			}
		}

		// ------------------- Update DB -------------------
		$data = [
			'video' => $video_name,
			'image' => $image_name
		];

		if ($this->model->updateData('tbl_life_at_packfora', $data, ['id' => $id, 'is_delete' => '1'])) {
			echo json_encode(['status' => 'success', 'message' => 'Life at Packfora updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Life at Packfora data.']);
		}
	}

	public function delete_life_at_packfora()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_life_at_packfora', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Life at Packfora deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Life at Packfora.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function video_banner(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/video_banner');
		}
	}
	public function save_video_banner() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
            $insert_data = [
                'video' => $video_name
            ];
            $this->model->insertData('tbl_video_banner',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
    }
	public function get_video_banner_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_video_banner',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_video_banner_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_video_banner',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_video_banner()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
		];
		if ($this->model->updateData('tbl_video_banner', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_video_banner()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_video_banner', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// event_slider
	public function event_slider(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/event_slider');
		}
	}
	public function save_event_slider()
	{
		$this->load->library('form_validation');
		
		// Check manually if the file is uploaded
			if (empty($_FILES['image']['name'])) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => 'The Image field is required.']
				]);
				return;
			}
			
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors()]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_event_slider', $data);
				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Event Slider saved successfully.']);
			}
	}

	public function get_event_slider_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_event_slider',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_event_slider_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_event_slider',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_event_slider()
	{
		$this->load->library('form_validation');

	$this->form_validation->set_rules('id', 'ID', 'required');

	if ($this->form_validation->run() === FALSE) {
		echo json_encode([
			'status' => 'error',
			'errors' => [
				'id' => form_error('id'),
			]
		]);
		return;
	}

	$id = $this->input->post('id');
	$previous_image = $this->input->post('edit_previous_image');

	$image = $previous_image;
	if (!empty($_FILES['edit_image']['name'])) {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('edit_image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['edit_image' => $this->upload->display_errors('', '')]
			]);
			return;
		} else {
			$upload_data = $this->upload->data();
			$image = 'uploads/' . $upload_data['file_name'];

			// Optional: delete old image
			if ($previous_image && file_exists($previous_image)) {
				@unlink($previous_image);
			}
		}
	} else {
		// If no new file, ensure previous image exists
		if (empty($previous_image)) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'edit_image' => 'The Image field is required.'
				]
			]);
			return;
		}
	}	
	// Update DB
	$data = [
		'image' => $image,
	];
	if ($this->model->updateData('tbl_event_slider', $data, array('id' => $id, 'is_delete' => '1'))) {
		echo json_encode(['status' => 'success', 'message' => 'Event Slider updated successfully.']);
	} else {
		echo json_encode(['status' => 'error', 'message' => 'Failed to update Event Slider data.']);
	}
	}
	public function delete_event_slider()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_event_slider', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Event Slider deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Event Slider.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function global_dialogue(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/global_dialogue');
		}
	}
	public function save_global_dialouge()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}
		$data = [
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
		];
		$this->model->insertData('tbl_global_dialogue', $data);
		echo json_encode(['status' => 'success', 'message' => 'Global Dialogue saved successfully.']);
	}
	public function get_global_dialogue_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_global_dialogue',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_global_dialogue_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_global_dialogue',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_global_dialogue_details()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		$data = [
			'title' => $title,
			'description' => $description,
		];

		if ($this->model->updateData('tbl_global_dialogue', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Global Dialogue updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Global Dialogue data.']);
		}
	}
	public function delete_global_dialogue()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_global_dialogue', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Global Dialogue deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Global Dialogue.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// From Smart Packaging to Circular Systems
	public function future_force(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/future_force');
		}
	}
	public function save_smart_to_circular()
	{
		// Check for required inputs
		if (empty($this->input->post('title'))) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['title' => 'The Title field is required.']
			]);
			return;
		}
		if (empty($this->input->post('image_name'))) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image_name' => 'The Image Name field is required.']
			]);
			return;
		}
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// Upload Config
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors('', '')]
			]);
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			// Prepare Data
			$data = [
				'title' => $this->input->post('title'),
				'image_name' => $this->input->post('image_name'),
				'image' => $imagePath
			];
			// Insert
			$this->model->insertData('tbl_smart_to_circular', $data);
			echo json_encode([
				'status' => 'success',
				'message' => 'Data saved successfully.'
			]);
		}
	}
	public function get_smart_to_circular_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_smart_to_circular', array('is_delete' => '1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_smart_to_circular_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_smart_to_circular', array('is_delete' => '1', 'id' => $id), '*');
		echo json_encode($response);
	}
	public function update_smart_to_circular()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_image_name', 'Image Name', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_image_name' => form_error('edit_image_name'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('edit_title');
		$image_name = $this->input->post('edit_image_name');
		$previous_image = $this->input->post('edit_previous_image');

		$data = [
			'title' => $title,
			'image_name' => $image_name,
		];

		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$data['image'] = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		} else {
			// If no new file, ensure previous image exists
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$data['image'] = $previous_image; // Use previous image if no new upload
			}
		}

		// Update the database
		
		$updated = $this->model->updateData('tbl_smart_to_circular', $data,array('id'=>$id)); // Replace 'your_table_name' with actual table name

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Record updated successfully.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to update the record.'
			]);
		}
	}
	public function delete_smart_to_circular()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_smart_to_circular', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Smart to Circular data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Smart to Circular data.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// featured_speakers
	public function featured_speakers(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/featured_speakers');
		}
	}
	public function save_featured_speakers()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('designation', 'Designation', 'required');
		$this->form_validation->set_rules('quote_text', 'Quote Text', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'name' => form_error('name'),
					'designation' => form_error('designation'),
					'quote_text' => form_error('quote_text'),
				]
			]);
			return;
		}
		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}

		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			// Prepare data for insertion
			$data = [
				'name' => $this->input->post('name'),
				'designation' => $this->input->post('designation'),
				'quote_text' => $this->input->post('quote_text'),
				'image_path' => $imagePath,
			];
			// Insert into database
			$this->model->insertData('tbl_featured_speakers', $data);
			echo json_encode(['status' => 'success', 'message' => 'Featured Speaker saved successfully.']);
		}
	} 
	public function get_featured_speakers_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_featured_speakers',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_featured_speakers_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_featured_speakers',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_featured_speaker()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required|trim');
		$this->form_validation->set_rules('edit_quote_text', 'Quote Text', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'edit_name' => form_error('edit_name'),
					'edit_designation' => form_error('edit_designation'),
					'edit_quote_text' => form_error('edit_quote_text'),
					'id' => form_error('id')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$name = $this->input->post('edit_name');
		$designation = $this->input->post('edit_designation');
		$quote_text = $this->input->post('edit_quote_text');
		$previous_image = $this->input->post('edit_previous_image');

		$data = [
			'name' => $name,
			'designation' => $designation,
			'quote_text' => $quote_text
		];

		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$data['image_path'] = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$data['image_path'] = $previous_image;
			}
		}
		$updated = $this->model->updateData('tbl_featured_speakers', $data,array('id'=>$id)); // Replace with your actual table

		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Speaker updated successfully.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to update the speaker.'
			]);
		}
	}
	public function delete_featured_speaker()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_featured_speakers', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Featured Speaker deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Featured Speaker.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Services /Talent Flex
	public function talent_flex_banner_video(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/talent_flex_banner_video');
		}
	}
	public function save_talent_flex_banner_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 1, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
    }
	public function get_talent_flex_banner_video_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 1), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_talent_flex_banner_video_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_talent_flex_banner_video()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_talent_flex_banner_video()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// talent_flex_our_offerings
	public function talent_flex_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/talent_flex_our_offerings');
		}
	}
	public function save_talent_flex_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 1, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Talent Flex Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 1,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Talent Flex Our Offerings.']);
				}
			}
		}
	}
	public function get_talent_flex_our_offerings_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 1, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_talent_flex_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 1, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_talent_flex_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 1, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Talent Flex Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'fk_service_id' => 1, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Talent Flex Our Offering data.']);
			}
		}	
	}
	public function delete_talent_flex_our_offering()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_offering', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 1]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Talent Flex Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Talent Flex Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function talent_flex_resourcing_model(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/talent_flex_resourcing_model');
		}
	}
	public function save_talent_flex_resourcing_model() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_resourcing_model', ['title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Talent Flex Our Offerings already exists.'
				]);
			}else {
				$data = [
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_resourcing_model',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Talent Flex Our Offerings.']);
				}
			}
		}
	}
	public function get_talent_flex_resourcing_model_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_resourcing_model',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_talent_flex_resourcing_model_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_resourcing_model',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_talent_flex_resourcing_model()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_resourcing_model', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Talent Flex Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_resourcing_model', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Talent Flex Our Offering data.']);
			}
		}	
	}
	public function delete_talent_flex_resourcing_model()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_resourcing_model', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Talent Flex Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Talent Flex Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// benefits_of_talent_flex
	public function benefits_of_talent_flex(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/benefits_of_talent_flex');
		}
	}
	public function save_benefits_of_talent_flex()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
					'fk_service_id' => 1, // Assuming 1 is the service ID for Talent Flex
				];
				// Insert into database
				$this->model->insertData('tbl_discover_benefits', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Talent Flex data saved successfully.']);
			}
		}
	}
	public function get_benefits_of_talent_flex_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','fk_service_id' => 1), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_benefits_of_talent_flex_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_benefits_of_talent_flex()
	{
		$this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('description', 'Description', 'required|trim');

    if ($this->form_validation->run() === FALSE) {
        echo json_encode([
            'status' => 'error',
            'errors' => [
                'title' => form_error('title'),
                'description' => form_error('description'),
            ]
        ]);
        return;
    }

    $id = $this->input->post('id');
    $title = $this->input->post('title');
    $description = $this->input->post('description');
    $previous_image = $this->input->post('edit_previous_image');

    $image = $previous_image;
    if (!empty($_FILES['edit_image']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('edit_image')) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['edit_image' => $this->upload->display_errors('', '')]
            ]);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image = 'uploads/' . $upload_data['file_name'];

            // Optional: delete old image
            if ($previous_image && file_exists($previous_image)) {
                @unlink($previous_image);
            }
        }
    }

    // Update DB
    $data = [
        'title' => $title,
        'description' => $description,
        'image' => $image,
    ];

		if ($this->model->updateData('tbl_discover_benefits', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Talent Flex updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Discover the Benefits of Talent Flex data.']);
		}
	}
	public function delete_benefits_of_talent_flex()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_discover_benefits', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Discover the Benefits of Talent Flex deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Discover the Benefits of Talent Flex.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// talent_flex_success_stories
	public function talent_flex_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/talent_flex_success_stories');
		}
	}
	public function save_talent_flex_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 1, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Talent Flex Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 1,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Talent Flex Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Talent Flex Success Stories.']);
				}
			}
		}
	}
	public function get_talent_flex_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 1, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_talent_flex_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 1, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_talent_flex_success_stories()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 1, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Talent Flex Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id, 'fk_service_id' => 1, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Talent Flex Our Offering data.']);
			}
		}	
	}

	public function delete_talent_flex_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 1]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Talent Flex Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Talent Flex Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// talent_flex_our_leaders
	public function talent_flex_our_leaders(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/talent_flex_our_leaders');
		}
	}
	public function save_talent_flex_our_leaders() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'name' => form_error('name'),
					'designation' => form_error('designation')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$name = $this->input->post('name');
			$designation = $this->input->post('designation');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 1, 'name'=> $name,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Talent Flex Our Leaders already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 1,
					'name' => $name,
					'designation' => $designation,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_leaders',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Leaders saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Talent Flex Our Leaders.']);
				}
			}
		}
	}
	public function get_talent_flex_our_leaders_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 1, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_talent_flex_our_leaders_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 1, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_talent_flex_our_leaders()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_name' => form_error('edit_name'),
					'edit_designation' => form_error('edit_designation')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$name = $this->input->post('edit_name');
		$designation = $this->input->post('edit_designation');

		$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 1, 'name'=> $name, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Talent Flex Our Leaders with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'name' => $name,
				'designation' => $designation,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_leaders', $data, array('id' => $id, 'fk_service_id' => 1, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Talent Flex Our Leaders updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Talent Flex Our Leaders data.']);
			}
		}	
	}
	public function delete_talent_flex_our_leaders()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_leaders', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 1]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Talent Flex Our Leaders deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Talent Flex Our Leaders.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// sustainability
	public function sustainability_banner_video(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/sustainability_banner_video');
		}
	}
	public function save_sustainability_banner_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 2, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
    }
	public function get_sustainability_banner_video_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 2), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_sustainability_banner_video_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_sustainability_banner_video()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_sustainability_banner_video()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function sustainability_market_trends(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/sustainability_market_trends');
		}
	}
	public function save_sustainability_market_trends()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$data = [
			'title' => $title,
			'description' => $description,
			'fk_service_id'=>2,
		];
		$this->model->insertData('tbl_market_trends', $data);
		echo json_encode(['status' => 'success', 'message' => 'Market Trends saved successfully.']);
	}
	public function get_sustainability_market_trends_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_market_trends',array('is_delete'=>'1','fk_service_id'=>2), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_sustainability_market_trends_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_market_trends',array('id'=>$id), '*',true);
		echo json_encode($response);
	}
	public function update_sustainability_market_trends_details()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		$data = [
			'title' => $title,
			'description' => $description,
		];

		if ($this->model->updateData('tbl_market_trends', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Market Trends updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Market Trends data.']);
		}
	}
	public function delete_sustainability_market_trends()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_market_trends', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Market Trends deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Market Trends.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// sustainability_our_offerings
	public function sustainability_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/sustainability_our_offerings');
		}
	}
	public function save_sustainability_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 1, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Talent Flex Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 2,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Sustianability Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Sustianability Our Offerings.']);
				}
			}
		}
	}
	public function get_sustainability_our_offering_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 2, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_sustainability_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' =>2, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_sustainability_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 2, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Sustianability Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'fk_service_id' => 2, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Sustianability Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Sustianability Our Offering data.']);
			}
		}	
	}
	public function delete_sustainability_our_offering()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_offering', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 2]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Sustianability Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Sustianability Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function sustainability_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/sustainability_success_stories');
		}
	}
	public function save_sustainability_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		// $this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					// 'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			// $description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 2, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Sustainability Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 2,
					'title' => $title,
					// 'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Sustainability Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Sustainability Success Stories.']);
				}
			}
		}
	}
	public function get_sustainability_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 2, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_sustainability_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 2, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_sustainability_success_stories()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		// $this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					// 'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];
				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 2, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Sustainability Success Stories with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				// 'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id, 'fk_service_id' => 1, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Sustainability Success Stories updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Sustainability Success Stories data.']);
			}
		}	
	}
	public function delete_sustainability_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 2]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Sustainability Success Stories deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Sustainability Success Stories.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Supply Chain
	public function supply_chain_banner_video(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/supply_chain_banner_video');
		}
	}
	public function save_supply_chain_banner_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 3, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
    }
	public function get_supply_chain_banner_video_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 3), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_supply_chain_banner_video_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_supply_chain_banner_video()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_supply_chain_banner_video()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Supply Chain Market Trends
	public function supply_chain_market_trends(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/supply_chain_market_trends');
		}
	}
	public function save_supply_chain_market_trends()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$data = [
			'title' => $title,
			'description' => $description,
			'fk_service_id'=>3,
		];
		$this->model->insertData('tbl_market_trends', $data);
		echo json_encode(['status' => 'success', 'message' => 'Market Trends saved successfully.']);
	}
	public function get_supply_chain_market_trends_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_market_trends',array('is_delete'=>'1','fk_service_id'=>3), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_supply_chain_market_trends_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_market_trends',array('id'=>$id), '*',true);
		echo json_encode($response);
	}
	public function update_supply_chain_market_trends_details()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		$data = [
			'title' => $title,
			'description' => $description,
		];

		if ($this->model->updateData('tbl_market_trends', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Market Trends updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Market Trends data.']);
		}
	}
	public function delete_supply_chain_market_trends()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_market_trends', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Market Trends deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Market Trends.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function supply_chain_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/supply_chain_our_offerings');
		}
	}

	public function save_supply_chain_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 3, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Supply Chain Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 3,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Supply Chain Our Offerings saved successfully.']);	
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Supply Chain Our Offerings.']);
				}	
			}
		}

	}
	public function get_supply_chain_our_offering_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 3, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_supply_chain_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' =>3, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}

	public function update_supply_chain_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 3, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');	
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Supply Chain Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'fk_service_id' => 3, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Supply Chain Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Supply Chain Our Offering data.']);
			}
		}	
	}
	public function delete_supply_chain_our_offering()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_offering', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 3]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Supply Chain Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Supply Chain Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function benefits_of_supply_chain_automation(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/benefits_of_supply_chain_automation');
		}
	}
	public function save_benefits_of_supply_chain_automation() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_discover_benefits', ['fk_service_id' => 3, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Benefits of Supply Chain Automation already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 3,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				if($this->model->insertData('tbl_discover_benefits',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Benefits of Supply Chain Automation saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Benefits of Supply Chain Automation.']);
				}
			}
		}
	}
	public function get_benefits_of_supply_chain_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','fk_service_id' => 3), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_benefits_of_supply_chain_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_benefits_of_supply_chain()
	{
		$this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('description', 'Description', 'required|trim');

    if ($this->form_validation->run() === FALSE) {
        echo json_encode([
            'status' => 'error',
            'errors' => [
                'title' => form_error('title'),
                'description' => form_error('description'),
            ]
        ]);
        return;
    }

    $id = $this->input->post('id');
    $title = $this->input->post('title');
    $description = $this->input->post('description');
    $previous_image = $this->input->post('edit_previous_image');

    $image = $previous_image;
    if (!empty($_FILES['edit_image']['name'])) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('edit_image')) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['edit_image' => $this->upload->display_errors('', '')]
            ]);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image = 'uploads/' . $upload_data['file_name'];

            // Optional: delete old image
            if ($previous_image && file_exists($previous_image)) {
                @unlink($previous_image);
            }
        }
    }

    // Update DB
    $data = [
        'title' => $title,
        'description' => $description,
        'image' => $image,
    ];

		if ($this->model->updateData('tbl_discover_benefits', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Supply Chain updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Discover the Benefits of Supply Chain data.']);
		}
	}
	public function delete_benefits_of_supply_chain()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_discover_benefits', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Discover the Benefits of Supply Chain deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Discover the Benefits of Supply Chain.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	public function supply_chain_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/supply_chain_success_stories');
		}
	}
	public function save_supply_chain_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 1, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Supply Chain Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 3,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Supply Chain Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Supply Chain Success Stories.']);
				}
			}
		}
	}
	public function get_supply_chain_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 3, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_supply_chain_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 3, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_supply_chain_success_stories()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		$existingData = $this->model->selectWhereData('tbl_success_stories', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Supply Chain Success Stories with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Supply Chain Success Stories updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Supply Chain Success Stories data.']);
			}
		}	
	}
	public function delete_supply_chain_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 3]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Supply Chain Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Supply Chain Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	public function design_to_value_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/design_to_value_our_offerings');
		}
	}

	public function save_design_to_value_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 4, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Design to Value Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 4,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];

				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Design to Value Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Design to Value Our Offerings.']);
				}
			}
		}
	}
	public function get_design_to_value_our_offering_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 4, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_design_to_value_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' =>4, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_design_to_value_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		
		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 4, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');	
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Design to Value Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Design to Value Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Design to Value Our Offering data.']);
			}
		}
	}


	public function benefits_of_design_to_value(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/benefits_of_design_to_value');
		}
	}
	public function save_benefits_of_design_value() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_discover_benefits', ['fk_service_id' => 5, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Benefits of Design to Value already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 5,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				if($this->model->insertData('tbl_discover_benefits',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Benefits of Design to Value saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Benefits of Design to Value.']);
				}
			}
		}
	}
	public function get_benefits_of_design_value_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','fk_service_id' => 5), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}

	public function get_benefits_of_design_value_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}

	public function update_benefits_of_design_value()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}

		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
		];

			if ($this->model->updateData('tbl_discover_benefits', $data, array('id' => $id, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Benefits of Design to Value updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Benefits of Design to Value data.']);
			}
	}
	public function delete_benefits_of_design_value()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_discover_benefits', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Benefits of Design to Value deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Benefits of Design to Value.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	public function design_to_value_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/design_value_success_stories');
		}
	}

	public function save_design_value_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 5, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Design to Value Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 5,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Design to Value Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Design to Value Success Stories.']);
				}
			}
		}
	}
	public function get_design_to_value_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 5, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_design_to_value_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 5, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_design_value_success_stories(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_success_stories', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Success Stories with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Success Stories updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Success Stories data.']);
			}
		}		
	}
	public function delete_design_value_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Success Stories Design to Value deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Innovation Banner Video
	public function packaging_innovation_video_banner(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_innovation_video_banner');
		}
	}
	public function save_packaging_innovation_video_banner(){
		 $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 7, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
	}

	public function get_packaging_innovation_video_banner_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 7), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_innovation_video_banner_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_innovation_video_banner()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_packaging_innovation_video_banner()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Packaging Innovation Our Offering
	public function packaging_innovation_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_innovation_our_offerings');
		}
	}

	public function save_packaging_innovation_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 7, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 7,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];

				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Our Offerings.']);
				}
			}
		}
	}
	public function get_packaging_innovation_our_offering_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 7, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_innovation_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' =>7, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_innovation_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		
		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 7, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');	
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Our Offering data.']);
			}
		}
	}
	public function delete_packaging_innovation_our_offering()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_offering', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 7]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}


	// Benefits of Packaging Innovation

	public function benefits_of_packaging_innovation(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/benefits_of_packaging_innovation');
		}
	}
	public function save_benefits_of_packaging_innovation()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
					'fk_service_id' => 7, // Assuming 1 is the service ID for Talent Flex
				];
				// Insert into database
				$this->model->insertData('tbl_discover_benefits', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Packaging Innovation data saved successfully.']);
			}
		}
	}
	public function get_benefits_of_packaging_innovation_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','fk_service_id' => 7), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_benefits_of_packaging_innovation_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_benefits_of_packaging_innovation()
	{
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('title', 'Title', 'required|trim');
    	$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_discover_benefits', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Packaging Innovation updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Discover the Benefits of Packaging Innovation data.']);
		}
	}
	public function delete_benefits_of_packaging_innovation()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_discover_benefits', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Discover the Benefits of Packaging Innovation deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Discover the Benefits of Packaging Innovation.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Packaging Innovation Success Stories

	public function packaging_innovation_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_innovation_success_stories');
		}
	}

	public function save_packaging_innovation_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 5, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 7,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Success Stories.']);
				}
			}
		}
	}
	public function get_packaging_innovation_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 7, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_innovation_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 7, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_innovation_success_stories(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_success_stories', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Success Stories with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Success Stories updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Success Stories data.']);
			}
		}		
	}
	public function delete_packaging_innovation_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Success Stories deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	//Packaging Procurement Banner Video
	public function packaging_procurement_video_banner(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_procurement_video_banner');
		}
	}
	public function save_packaging_procurement_video_banner(){
		 $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 8, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
	}

	public function get_packaging_procurement_video_banner_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 8), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_procurement_video_banner_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_procurement_video_banner()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_packaging_procurement_video_banner()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Packaging Procurement Our Offerings

	public function packaging_procurement_our_offerings(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_procurement_our_offerings');
		}
	}

	public function save_packaging_procurement_our_offering() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 7, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Our Offerings already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 8,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];

				if($this->model->insertData('tbl_our_offering',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Our Offerings saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Our Offerings.']);
				}
			}
		}
	}
	public function get_packaging_procurement_our_offering_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' => 8, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_procurement_our_offering_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_offering',array('fk_service_id' =>8, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_procurement_our_offering()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		
		$existingData = $this->model->selectWhereData('tbl_our_offering', ['fk_service_id' => 8, 'title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');	
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Our Offering with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_offering', $data, array('id' => $id, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Our Offering updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Our Offering data.']);
			}
		}
	}
	public function delete_packaging_procurement_our_offering()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_offering', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 8]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Our Offering deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Our Offering.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Benefits of Packaging Procurement

	public function benefits_of_packaging_procurement(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/benefits_of_packaging_procurement');
		}
	}
	public function save_benefits_of_packaging_procurement()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
					'fk_service_id' =>8, // Assuming 1 is the service ID for Talent Flex
				];
				// Insert into database
				$this->model->insertData('tbl_discover_benefits', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Packaging Innovation data saved successfully.']);
			}
		}
	}
	public function get_benefits_of_packaging_procurement_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','fk_service_id' => 8), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_benefits_of_packaging_procurement_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_discover_benefits',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_benefits_of_packaging_procurement()
	{
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('title', 'Title', 'required|trim');
    	$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_discover_benefits', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Discover the Benefits of Packaging Innovation updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Discover the Benefits of Packaging Innovation data.']);
		}
	}
	public function delete_benefits_of_packaging_procurement()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_discover_benefits', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Discover the Benefits of Packaging procurement deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Discover the Benefits of Packaging procurement.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Packaging Procurement Success Stories

	public function packaging_procurement_success_stories(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_procurement_success_stories');
		}
	}

	public function save_packaging_procurement_success_stories() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_success_stories', ['fk_service_id' => 5, 'title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Success Stories already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 8,
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_success_stories',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Success Stories saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Success Stories.']);
				}
			}
		}
	}
	public function get_packaging_procurement_success_stories_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 8, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_packaging_procurement_success_stories_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_success_stories',array('fk_service_id' => 8, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_procurement_success_stories(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_success_stories', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Success Stories with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_success_stories', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Success Stories updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Success Stories data.']);
			}
		}		
	}
	public function delete_packaging_procurement_success_stories()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_success_stories', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Success Stories deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// How we Do it
	public function how_we_do_it(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/how_we_do_it');
		}
	}
	public function save_how_we_do_it() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_how_we_do_it', ['title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Data already exists.'
				]);
			}else {
				$data = [
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_how_we_do_it',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_how_we_do_it_data(){
		$response['data'] = $this->model->selectWhereData('tbl_how_we_do_it',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_how_we_do_it_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_how_we_do_it',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_how_we_do_it(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_how_we_do_it', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_how_we_do_it', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	public function delete_how_we_do_it()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_how_we_do_it', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Our Promise
	public function our_promise(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/our_promise');
		}
	}
	public function save_our_promise() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_promise', ['title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Data already exists.'
				]);
			}else {
				$data = [
					'title' => $title,
					'description' => $description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_promise',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_our_promise_data(){
		$response['data'] = $this->model->selectWhereData('tbl_our_promise',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_our_promise_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_promise',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_our_promise(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_our_promise', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_our_promise', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	public function delete_our_promise()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_promise', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Leadership Team

	public function leadership_team(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/leadership_team');
		}
	}
	public function save_leadership_team() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'name' => form_error('name'),
					'description' => form_error('description'),
					'designation' => form_error('designation')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$designation = $this->input->post('designation');
			$link = $this->input->post('link');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_leadership_team', ['name'=> $name,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Data already exists.'
				]);
			}else {
				$data = [
					'name' => $name,
					'description' => $description,
					'image' => $imagePath,
					'designation' => $designation,
					'link' => $link,
				];
				// Insert into database
				if($this->model->insertData('tbl_leadership_team',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_leadership_team_data(){
		$response['data'] = $this->model->selectWhereData('tbl_leadership_team',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_leadership_team_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_leadership_team',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_leadership_team(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_name' => form_error('edit_name'),
					'edit_designation' => form_error('edit_designation'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$name = $this->input->post('edit_name');
		$designation = $this->input->post('edit_designation');
		$description = $this->input->post('edit_description');

		$existingData = $this->model->selectWhereData('tbl_leadership_team', ['name'=> $name, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this name already exists.'
			]);
			return;
		} else {
			$data = [
				'name' => $name,
				'designation' => $designation,
				'description' => $description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_leadership_team', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	public function delete_leadership_team()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_leadership_team', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	public function knowledge_centre()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/knowledge_centre');
		}
	}
	public function save_knowledge_centre() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'date' => form_error('date')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$title = $this->input->post('title');
			$date = $this->input->post('date');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_knowledge_centre', ['title'=> $title,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['title' => "Data Already Exist"]
				]);
			}else {
				$data = [
					'title' => $title,
					'date' => $date,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_knowledge_centre',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_knowledge_centre_data(){
		$response['data'] = $this->model->selectWhereData('tbl_knowledge_centre',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_knowledge_centre_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_knowledge_centre',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_knowledge_centre(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_date', 'date', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_date' => form_error('edit_date')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$title = $this->input->post('edit_title');
		$date = $this->input->post('edit_date');

		$existingData = $this->model->selectWhereData('tbl_knowledge_centre', ['title'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'title' => $title,
				'date' => $date,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_knowledge_centre', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}

	public function delete_knowledge_centre()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_knowledge_centre', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// Case Study
	public function case_study()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/case_study');
		}
	}
	public function save_case_study() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'description' => form_error('description'),
					'link' => form_error('link'),
					'title' => form_error('title'),
					'date' => form_error('date'),
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$description = $this->input->post('description');
			$link = $this->input->post('link');
			$title = $this->input->post('title');
			$date = $this->input->post('date');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_case_study', ['description'=> $description,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['description' => "Data Already Exist"]
				]);
			}else {
				$data = [
					'description' => $description,
					'link' => $link,
					'image' => $imagePath,
					'title' => $title,
					'date' => $date,
				];
				// Insert into database
				if($this->model->insertData('tbl_case_study',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_case_study_data(){
		$response['data'] = $this->model->selectWhereData('tbl_case_study',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_case_study_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_case_study',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_case_study(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('edit_link', 'Link', 'required|trim');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_date', 'Date', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_description' => form_error('edit_description'),
					'edit_link' => form_error('edit_link'),
					'edit_title' => form_error('edit_title'),
					'edit_date' => form_error('edit_date'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$description = $this->input->post('edit_description');
		$link = $this->input->post('edit_link');
		$title = $this->input->post('edit_title');
		$date = $this->input->post('edit_date');

		$existingData = $this->model->selectWhereData('tbl_case_study', ['description'=> $description, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this description already exists.'
			]);
			return;
		} else {
			$data = [
				'description' => $description,
				'link' => $link,
				'image' => $image,
				'title' => $title,
				'date' => $date,
			];
			if ($this->model->updateData('tbl_case_study', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	public function delete_case_study()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_case_study', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	public function our_impact()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/our_impact');
		}
	}

	public function save_our_impact()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('heading', 'Heading', 'required|trim');
		$this->form_validation->set_rules('sub_text', 'sub_text', 'required|trim');
		$this->form_validation->set_rules('value1_title', 'Title 1', 'required|trim');
		$this->form_validation->set_rules('value1_description', 'Description 1', 'required|trim');
		$this->form_validation->set_rules('value2_title', 'Title 2', 'required|trim');
		$this->form_validation->set_rules('value2_description', 'Description 1', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'heading' => form_error('heading'),
					'sub_text' => form_error('sub_text'),
					'value1_title' => form_error('value1_title'),
					'value1_description' => form_error('value1_description'),
					'value2_title' => form_error('value2_title'),
					'value2_description' => form_error('value2_description'),
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$heading = $this->input->post('heading');
			$sub_text = $this->input->post('sub_text');
			$value1_title = $this->input->post('value1_title');
			$value1_description = $this->input->post('value1_description');
			$value2_title = $this->input->post('value2_title');
			$value2_description = $this->input->post('value2_description');
			$existingData = $this->model->selectWhereData('tbl_impact_sections', ['heading'=> $heading,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['heading' => "Data Already Exist"]
				]);
			}else {
				$data = [
					'heading' => $heading,
					'sub_text' => $sub_text,
					'value1_title' => $value1_title,
					'value1_description' => $value1_description,
					'value2_title' => $value2_title,
					'value2_description' => $value2_description,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_impact_sections',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_our_impact_data(){
		$response['data'] = $this->model->selectWhereData('tbl_impact_sections',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_our_impact_details(){
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_impact_sections',array('is_delete'=>'1','id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_our_impact(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_heading', 'Heading', 'required|trim');
		$this->form_validation->set_rules('edit_sub_text', 'sub_text', 'required|trim');
		$this->form_validation->set_rules('edit_value1_title', 'Title 1', 'required|trim');
		$this->form_validation->set_rules('edit_value1_description', 'Description 1', 'required|trim');
		$this->form_validation->set_rules('edit_value2_title', 'Title 2', 'required|trim');
		$this->form_validation->set_rules('edit_value2_description', 'Description 1', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_heading' => form_error('edit_heading'),
					'edit_sub_text' => form_error('edit_sub_text'),
					'edit_value1_title' => form_error('edit_value1_title'),
					'edit_value1_description' => form_error('edit_value1_description'),
					'edit_value2_title' => form_error('edit_value2_title'),
					'edit_value2_description' => form_error('edit_value2_description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];
				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$heading = $this->input->post('edit_heading');
		$sub_text = $this->input->post('edit_sub_text');
		$value1_title = $this->input->post('edit_value1_title');
		$value1_description = $this->input->post('edit_value1_description');
		$value2_title = $this->input->post('edit_value2_title');
		$value2_description = $this->input->post('edit_value2_description');

		$existingData = $this->model->selectWhereData('tbl_impact_sections', ['heading'=> $heading, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data already exists.'
			]);
			return;
		} else {
			$data = [
				'heading' => $heading,
				'sub_text' => $sub_text,
				'value1_title' => $value1_title,
				'value1_description' => $value1_description,
				'value2_title' => $value2_title,
				'value2_description' => $value2_description,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_impact_sections', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	public function delete_our_impact()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_impact_sections', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Success Stories';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// Our Services
	public function our_services()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/our_services');
		}
	}
	public function save_our_services()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'link' => form_error('link')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$description = $this->input->post('description');
			$link = $this->input->post('link');
			$title = $this->input->post('title');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_services', ['description'=> $description,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['description' => "Data Already Exist"]
				]);
			}else {
				$data = [
					'description' => $description,
					'link' => $link,
					'image' => $imagePath,
					'service_name' => $title,
				];
				// Insert into database
				if($this->model->insertData('tbl_services',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_our_services_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_services',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_our_services_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_services',array('id'=>$id), '*');
		echo json_encode($response);
	}
	public function update_our_services()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('edit_link', 'Link', 'required|trim');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_description' => form_error('edit_description'),
					'edit_link' => form_error('edit_link'),
					'edit_title' => form_error('edit_title'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$description = $this->input->post('edit_description');
		$link = $this->input->post('edit_link');
		$title = $this->input->post('edit_title');

		$existingData = $this->model->selectWhereData('tbl_services', ['service_name'=> $title, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data with this description already exists.'
			]);
			return;
		} else {
			$data = [
				'description' => $description,
				'link' => $link,
				'image' => $image,
				'service_name' =>$title
			];
			if ($this->model->updateData('tbl_services', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}		
	}
	// Impact Box

	public function impact_box(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/impact_box');
		}
	}
	public function save_impact_box()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('heading', 'heading', 'required|trim');
		$this->form_validation->set_rules('value', 'Value', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'value' => form_error('value'),
					'heading' => form_error('heading'),
					'link' => form_error('link'),
					'description' => form_error('description')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$description = $this->input->post('description');
			$link = $this->input->post('link');
			$heading = $this->input->post('heading');
			$value = $this->input->post('value');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_impact_boxes', ['front_heading'=> $heading,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['heading' => "Data Already Exist"]
				]);
			}else {
				$data = [
					'front_heading' => $heading,
					'front_value' => $value,
					'image' => $imagePath,
					'back_description' => $description,
					'link' => $link,
				];
				// Insert into database
				if($this->model->insertData('tbl_impact_boxes',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Data.']);
				}
			}
		}
	}
	public function get_impact_box_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_impact_boxes',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_impact_box_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_impact_boxes',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_impact_box()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_heading', 'Heading', 'required|trim');
		$this->form_validation->set_rules('edit_value', 'Value', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('edit_link', 'Link', 'required|trim');
		
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_heading' => form_error('edit_heading'),
					'edit_value' => form_error('edit_value'),
					'edit_description' => form_error('edit_description'),
					'edit_link' => form_error('edit_link'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];
				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$heading = $this->input->post('edit_heading');
		$value = $this->input->post('edit_value');
		$description = $this->input->post('edit_description');
		$link = $this->input->post('edit_link');
		
		$existingData = $this->model->selectWhereData('tbl_impact_boxes', ['front_heading'=> $heading, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Data already exists.'
			]);
			return;
		} else {
			$data = [
				'front_heading' => $heading,
				'front_value' => $value,
				'back_description' => $description,
				'link' => $link,
				'image' => $image,
			];
			if ($this->model->updateData('tbl_impact_boxes', $data, array('id' => $id,'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Data.']);
			}
		}
	}
	// Blogs
	public function blog()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/blogs');
		}
	}
	public function save_blogs()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_blogs', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Blogs data saved successfully.']);
			}
		}
	}
	public function get_blogs_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_blogs',array('is_delete'=>'1','id'=>1), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_blogs_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_blogs',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_blogs()
	{
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('title', 'Title', 'required|trim');
    	$this->form_validation->set_rules('description', 'Description', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$previous_image = $this->input->post('edit_previous_image');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_blogs', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Blogs updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update blogs data.']);
		}
	}
	public function delete_blogs()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_blogs', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Blogs deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete blogs';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	// More Blogs
	public function more_blogs()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/more_blogs');
		}
	}
	public function save_more_blogs()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('link', 'Link', 'required');
		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
					'image' => form_error('image'),
					'link' => form_error('link'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'image' => $imagePath,
					'link' => $this->input->post('link'),
				];
				// Insert into database
				$this->model->insertData('tbl_blogs', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Blogs data saved successfully.']);
			}
		}
	}
	public function get_more_blogs_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_blogs',array('is_delete'=>'1','id !='=>1), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_more_blogs_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_blogs',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_more_blogs()
	{
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
    	$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
    	$this->form_validation->set_rules('edit_link', 'Link', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'edit_title' => form_error('edit_title'),
					'edit_description' => form_error('edit_description'),
					'edit_link' => form_error('edit_link'),
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$title = $this->input->post('edit_title');
		$description = $this->input->post('edit_description');
		$previous_image = $this->input->post('edit_previous_image');
		$link = $this->input->post('edit_link');

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,
			'image' => $image,
			'link' => $link,
		];

		if ($this->model->updateData('tbl_blogs', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Blogs updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update blogs data.']);
		}
	}
	public function delete_more_blogs()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_blogs', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Blogs deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete blogs';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
	//  Maxmold built_reliability
	public function built_reliability()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/built_reliability');
		}
	}
	public function save_built_reliability()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
		} else {			
				$data = [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
				];
				// Insert into database
				$this->model->insertData('tbl_built_reliability', $data);
				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
		}
	}
	public function get_built_reliability_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_built_reliability',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_built_reliability_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_built_reliability',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_built_reliability()
	{
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('title', 'Title', 'required|trim');
    	$this->form_validation->set_rules('description', 'Description', 'required|trim');
    	if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'title' => form_error('title'),
					'description' => form_error('description'),
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$description = $this->input->post('description');		
		// Update DB
		$data = [
			'title' => $title,
			'description' => $description,	
		];

		if ($this->model->updateData('tbl_built_reliability', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
		}
	}
	public function delete_built_reliability()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_built_reliability', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete data';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// story_behind_maxmold
	public function story_behind_maxmold()
	{
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/story_behind_maxmold');
		}
	}
	public function save_story_behind_maxmold()
	{
		$this->load->library('form_validation');
		// Set rules
		$this->form_validation->set_rules('description', 'Description', 'required');
		if (empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image', 'Image', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'description' => form_error('description'),
					'image' => form_error('image'),
				]
			]);
		} else {
			// File Upload (optional)
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['image' => $this->upload->display_errors('', '')]
				]);
			} else {
				$uploadData = $this->upload->data();
				$imagePath = 'uploads/' . $uploadData['file_name'];
				// Prepare data for insertion
				$data = [
					'description' => $this->input->post('description'),
					'image' => $imagePath,
				];
				// Insert into database
				$this->model->insertData('tbl_story_behind_maxmold', $data);

				// Save to database or proceed with business logic
				echo json_encode(['status' => 'success', 'message' => 'Data saved successfully.']);
			}
		}
	}
	public function get_story_behind_maxmold_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_story_behind_maxmold',array('is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_story_behind_maxmold_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_story_behind_maxmold',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_story_behind_maxmold()
	{
		$this->load->library('form_validation');    	
    	$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');	

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [				
					'edit_description' => form_error('edit_description'),					
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$description = $this->input->post('edit_description');
		$previous_image = $this->input->post('edit_previous_image');		

		$image = $previous_image;
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				// Optional: delete old image
				if ($previous_image && file_exists($previous_image)) {
					@unlink($previous_image);
				}
			}
		}
		// Update DB
		$data = [
			'description' => $description,
			'image' => $image,
		];

		if ($this->model->updateData('tbl_story_behind_maxmold', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
		}
	}
	public function delete_story_behind_maxmold()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_story_behind_maxmold', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Data deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete data';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	public function design_value_banner_video(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/design_value_banner_video');
		}
	}
	public function save_design_value_banner_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('sub_title', 'Sub Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');
        $this->form_validation->set_rules('video', 'Video', 'callback_video_check');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'sub_title' => form_error('sub_title'),
                    'description' => form_error('description'),
                    'video' => form_error('video')
                ]
            ]);
        } else {
            $video_name = '';
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
                $config['max_size']      = 51200; // 50MB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('video')) {
                    echo json_encode([
                        'status' => 'error',
                        'errors' => [
                            'video' => $this->upload->display_errors()
                        ]
                    ]);
                    return;
                } else {
                    $upload_data = $this->upload->data();
                    $video_name = 'uploads/' . $upload_data['file_name'];
                }
            }
			// Prepare data for insertion
			
            $insert_data = [
                'video' => $video_name,
				'title' => $this->input->post('title'),
				'sub_title' => $this->input->post('sub_title'),
				'description' => $this->input->post('description'),
				'fk_service_id' => 5, // Assuming 1 is the service ID for Talent Flex
            ];
            $this->model->insertData('tbl_service_banner_video',$insert_data);
            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
    }
	public function get_design_value_banner_video_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','fk_service_id' => 5), '*', false, array('id' => 'DESC'));
		echo json_encode($response);
	}
	public function get_design_value_banner_video_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_service_banner_video',array('is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_design_value_banner_video()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_title', 'Title', 'required|trim');
		$this->form_validation->set_rules('edit_sub_title', 'Sub Title', 'required|trim');
		$this->form_validation->set_rules('edit_description', 'Description', 'required|trim');
		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_title' => form_error('edit_title'),
					'edit_sub_title' => form_error('edit_sub_title'),
					'edit_description' => form_error('edit_description')
				]
			]);
			return;
		}
		$id = $this->input->post('id');
		$previous_video = $this->input->post('edit_previous_video');
		$video_name = $previous_video;
		// Only validate file if a new file is uploaded
		if (!empty($_FILES['edit_video']['name'])) {
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] = 'mp4|mov|avi|wmv|webm';
			$config['max_size']      = 51200; // 50MB
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('edit_video')) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => $this->upload->display_errors('', '')
					]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$video_name = 'uploads/' . $upload_data['file_name'];
				// Optional: delete old video if exists and is different
				if ($previous_video && file_exists($previous_video) && $previous_video != $video_name) {
					@unlink($previous_video);
				}
			}
		} else {
			// If no new file, ensure previous video exists
			if (empty($previous_video)) {
				echo json_encode([
					'status' => 'error',
					'errors' => [
						'edit_video' => 'The Video field is required.'
					]
				]);
				return;
			}
		}
		$data = [
			'video' => $video_name,
			'title' => $this->input->post('edit_title'),
			'sub_title' => $this->input->post('edit_sub_title'),
			'description' => $this->input->post('edit_description')
		];
		if ($this->model->updateData('tbl_service_banner_video', $data, array('id' => $id, 'is_delete' => '1'))) {
			echo json_encode(['status' => 'success', 'message' => 'Video Banner updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update Video Banner data.']);
		}
	}
	public function delete_design_value_banner_video()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_service_banner_video', ['is_delete' => '0'], ['id' => $id]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Video Banner deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Video Banner.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// design_value_our_leaders
	public function design_value_our_leaders(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/design_value_our_leaders');
		}
	}
	public function save_design_value_our_leaders() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'name' => form_error('name'),
					'designation' => form_error('designation')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$name = $this->input->post('name');
			$designation = $this->input->post('designation');
			$link = $this->input->post('link');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 1, 'name'=> $name,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Design Value Our Leaders already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 5,
					'name' => $name,
					'designation' => $designation,
					'link' => $link,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_leaders',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Design Value Our Leaders saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Design Value Our Leaders.']);
				}
			}
		}
	}
	public function get_design_value_our_leaders_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 5, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_design_value_our_leaders_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 5, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_design_value_our_leaders()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_name' => form_error('edit_name'),
					'edit_designation' => form_error('edit_designation')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$name = $this->input->post('edit_name');
		$designation = $this->input->post('edit_designation');
		$link = $this->input->post('edit_link');

		$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 5, 'name'=> $name, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Design Value Our Leaders with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'name' => $name,
				'designation' => $designation,
				'image' => $image,
				'link' => $link,
			];
			if ($this->model->updateData('tbl_our_leaders', $data, array('id' => $id, 'fk_service_id' => 5, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Design value Our Leaders updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Design value Our Leaders data.']);
			}
		}	
	}
	public function delete_design_value_our_leaders()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_leaders', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 5]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Design Value Our Leaders deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Design Value Our Leaders.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}

	// packaging_innovation_our_leaders
	public function packaging_innovation_our_leaders(){
		$admin_session = $this->session->userdata('admin_session'); // Check if admin session exists			
		if (!$admin_session) {
			redirect(base_url('common/index')); // Redirect to login page if session is not active
		} else {
			$this->load->view('admin/packaging_innovation_our_leaders');
		}
	}
	public function save_packaging_innovation_our_leaders() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'name' => form_error('name'),
					'designation' => form_error('designation')
				]
			]);
			return;
		}		
		if (empty($_FILES['image']['name'])) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => 'The Image field is required.']
			]);
			return;
		}
		// File Upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			echo json_encode([
				'status' => 'error',
				'errors' => ['image' => $this->upload->display_errors()]
			]);
			return;
		} else {
			$uploadData = $this->upload->data();
			$imagePath = 'uploads/' . $uploadData['file_name'];
			$name = $this->input->post('name');
			$designation = $this->input->post('designation');
			$link = $this->input->post('link');
			// Prepare data for insertion
			$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 1, 'name'=> $name,'is_delete' => '1'], '*');
			if (!empty($existingData)) {
				// If data already exists, update it
				echo json_encode([
					'status' => 'error',
					'message' => 'Design Value Our Leaders already exists.'
				]);
			}else {
				$data = [
					'fk_service_id'=> 4,
					'name' => $name,
					'designation' => $designation,
					'link' => $link,
					'image' => $imagePath,
				];
				// Insert into database
				if($this->model->insertData('tbl_our_leaders',$data)){
					echo json_encode(['status' => 'success', 'message' => 'Our Leaders saved successfully.']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Failed to save Our Leaders.']);
				}
			}
		}
	}
	public function get_packaging_innovation_our_leaders_data()
	{
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 4, 'is_delete'=>'1'), '*', false, array('id' => 'DESC'));
		echo json_encode($response);	
	}
	public function get_packaging_innovation_our_leaders_details()
	{
		$id = $this->input->post('id');
		$response['data'] = $this->model->selectWhereData('tbl_our_leaders',array('fk_service_id' => 4, 'is_delete'=>'1','id'=> $id), '*');
		echo json_encode($response);
	}
	public function update_packaging_innovation_our_leaders()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('edit_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('edit_designation', 'Designation', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'errors' => [
					'id' => form_error('id'),
					'edit_name' => form_error('edit_name'),
					'edit_designation' => form_error('edit_designation')
				]
			]);
			return;
		}

		$id = $this->input->post('id');
		$previous_image = $this->input->post('edit_previous_image');
		
		if (!empty($_FILES['edit_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('edit_image')) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => $this->upload->display_errors('', '')]
				]);
				return;
			} else {
				$upload_data = $this->upload->data();
				$image = 'uploads/' . $upload_data['file_name'];

				if ($previous_image && file_exists($previous_image)) {
					unlink($previous_image);
				}
			}
		} else {
			if (empty($previous_image)) {
				echo json_encode([
					'status' => 'error',
					'errors' => ['edit_image' => 'The Image field is required.']
				]);
				return;
			} else {
				$image = $previous_image; // Use previous image if no new upload
			}
		}
		$name = $this->input->post('edit_name');
		$designation = $this->input->post('edit_designation');
		$link = $this->input->post('edit_link');

		$existingData = $this->model->selectWhereData('tbl_our_leaders', ['fk_service_id' => 4, 'name'=> $name, 'is_delete' => '1', 'id !=' => $id], '*');
		if (!empty($existingData)) {
			// If data already exists, return error
			echo json_encode([
				'status' => 'error',
				'message' => 'Our Leaders with this title already exists.'
			]);
			return;
		} else {
			$data = [
				'name' => $name,
				'designation' => $designation,
				'image' => $image,
				'link' => $link,
			];
			if ($this->model->updateData('tbl_our_leaders', $data, array('id' => $id, 'fk_service_id' => 4, 'is_delete' => '1'))) {
				echo json_encode(['status' => 'success', 'message' => 'Our Leaders updated successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to update Our Leaders data.']);
			}
		}	
	}
	public function delete_packaging_innovation_our_leaders()
	{
		$id = $this->input->post('id');
		$response = [];
		if ($id) {
			// Soft delete by setting is_delete = 0 (you can change logic)
			$update = $this->model->updateData('tbl_our_leaders', ['is_delete' => '0'], ['id' => $id, 'fk_service_id' => 4]);
			if ($update) {
				$response['status'] = true;
				$response['message'] = 'Our Leaders deleted successfully.';
			} else {
				$response['status'] = false;
				$response['message'] = 'Failed to delete the Our Leaders.';
			}
		} else {
			$response['status'] = false;
			$response['message'] = 'Invalid request.';
		}
		echo json_encode($response);
	}
}

    	

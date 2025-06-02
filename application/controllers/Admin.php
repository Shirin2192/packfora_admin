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
	}	public function upload_client_image()
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
			'image' => base_url().'uploads/clients/' . $filename
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
		$response['data'] = $this->model->selectWhereData('our_clients',array(), '*', false, array('id' => 'DESC'));
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

            $insert_data = [
                'video' => $video_name
            ];

            $this->model->insertData('tbl_life_at_packfora',$insert_data);

            echo json_encode(['status' => 'success', 'message' => 'Video uploaded successfully']);
        }
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
		$video_name = $previous_video;

		// Only validate file if a new file is uploaded
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

		if ($this->model->updateData('tbl_life_at_packfora', $data, array('id' => $id, 'is_delete' => '1'))) {
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

}	


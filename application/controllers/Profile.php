<?php

/**
 * Handles profile updates
 */
class Profile extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->helper('cookie');
    $this->load->library('session');
    $this->load->model('users_model');
  }
  
  /**
   * Profile Function - Shows profile page of user
   */
  public function profile() {
    if(!$this->session->userdata('logged_in')) {
      $data['username'] = $this->input->cookie('username');
      $data['password'] = $this->input->cookie('password');
      $this->load->view('login', $data);
    } else {
      $data['userdata'] = $this->session->all_userdata();
      $data['error'] = '';
      $this->load->view('profile', $data);
    }
  }

  /**
   * DP Upload Function - Handles dp upload of users
   */
	public function dp_upload(){
		if(!empty($_FILES)) {
			$user = $this->users_model->get_user($this->session->userdata('username'));
			$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name'] = time();
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('file')) {
				$user['dp'] = $this->upload->display_errors();
			} else {
				$fileData = $this->upload->data(); 
				$user['dp'] = $fileData['file_name']; 
				$this->users_model->update($user); 
				$this->session->set_userdata($user);
			}
		} 
		redirect('Profile/profile');
  }
  
  /**
	 * Update Function - Handles user update request
	 */
	public function update() {
		$user = $this->users_model->get_user($this->session->userdata('username'));
    $user['email'] = $this->input->post("email");
		$user['birthdate'] = $this->input->post("birthdate");
		$user['gender'] = $this->input->post("gender");
		$this->users_model->update($user);
		$this->session->set_userdata($user);
		redirect('Profile/profile');
	}
}

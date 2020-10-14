<?php

class Upload extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
  }
  
  public function do_upload(){
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1000;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['file_name'] = time();
		$this->load->library('upload', $config);
		if(!$this->upload->dp_upload('dp')) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('profile', $error);
		} else {
			$data = array('upload_data' => $this->upload->data());
    }
  }
}
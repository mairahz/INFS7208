<?php

/**
 * Handles Video Upload
 */
class Uploadvid extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->helper('cookie');
    $this->load->library('session');
    $this->load->model('videos_model');
  }
  
  /**
   * Upload Form Function - Shows upload form for video
   */
  public function uploadform() {
    if(!$this->session->userdata('logged_in')) {
      $data['username'] = $this->input->cookie('username');
      $data['password'] = $this->input->cookie('password');
      $this->load->view('login', $data);
    } else {
      $data['userdata'] = $this->session->all_userdata();
      $this->load->view('uploadvid', $data);
    }
  }

  /**
   * Video Upload Function - Handles video upload request
   */
  public function vid_upload(){
		if(!empty($_FILES)) {
			$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'mp4|flv|avi|webm|gif|jpg|png|jpeg';
			$config['file_name'] = time();
      $this->load->library('upload', $config);
      $video = $this->session->userdata('video');
			if(!$this->upload->do_upload('file')) {
				$video['success'] = $this->upload->display_errors();
			} else {
        $fileData = $this->upload->data(); 
        if($fileData['file_ext'] == ".jpeg" || $fileData['file_ext'] == ".jpg" || $fileData['file_ext'] == ".png" || $fileData['file_ext'] == ".gif") {
          $video['thumbnail'] = $fileData['file_name'];
        } else {
          $video['video'] = $fileData['file_name'];
        }
        $video['username'] = $this->session->userdata('username');
        $this->session->set_userdata('video', $video);
			}
		} 
  }
  
  /**
   * Details Upload Function - Handles upload of video details request
   */
  public function details_upload(){
    $video = $this->session->userdata('video');
    $video['title'] = $this->input->post("title");
    $video['des'] = $this->input->post("des");
    $this->videos_model->insert($video);
    redirect('');
  }
}

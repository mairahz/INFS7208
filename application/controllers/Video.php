<?php
/**
 * Video Class - Handles functions for video page
 */
class Video extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'url_helper'));
		$this->load->library('session');
		$this->load->model('videos_model');
		$this->load->model('comments_model');
	}

	/**
	 * Video Function - Shows data page for a video
	 */
	public function video($id) {
		$data['userdata'] = $this->session->all_userdata();
		$data['video'] = $this->videos_model->get_video_details($id);
		$data['videoID'] = $id;
		$username = $this->session->userdata('username');
		$data['fav'] =  $this->videos_model->get_fav($username, $id);
		$data['comments'] = $this->comments_model->get_comments($id);
		$data['videos'] = $this->videos_model->get_videos();
		$this->load->view('video', $data);
	}

	/**
	 * Add Favourite Function - Handles adding a video to the favourite list
	 */
	public function addFav($id) {
		$username = $this->session->userdata('username');
		$this->videos_model->add_fav($username, $id);
		redirect('video/'.$id);
	}

	/**
	 * Unfavourite Function - Handles removing a video from favourites
	 */
	public function unFav($id) {
		$username = $this->session->userdata('username');
		$this->videos_model->unfav($username, $id);
		redirect('video/'.$id);
	}

	/**
	 * Add Comment Function - Adds a comment to video
	 */
	public function add_comment($id){
		if($this->session->userdata('username') == NULL){
			$username = $_SERVER['REMOTE_ADDR'];
		} else {
			$username = $this->session->userdata('username');
			if($this->input->post('anon') !== NULL){
				$name = $this->videos_model->get_anon($id, $username);
				if($name == NULL) {
					$names = array(
						'Christopher',
						'Ryan',
						'Ethan',
						'John',
						'Zoey',
						'Sarah',
						'Michelle',
						'Samantha',
						'Walker',
						'Thompson',
						'Anderson',
						'Johnson',
						'Tremblay',
						'Peltier',
						'Cunningham',
						'Simpson',
						'Mercado',
						'Sellers'
					);
					$random_name = $names[mt_rand(0, sizeof($names) - 1)]; // Randomises name selection
					$anon = 'Anonymous '.$random_name;
					while($this->videos_model->check_anon($id, $anon) != NULL) {
						$random_name = $names[mt_rand(0, sizeof($names) - 1)];
						$anon = 'Anonymous '.$random_name;
					}
					$this->videos_model->add_anon($id, $username, $anon);	
					$username = $anon;
				} else {
					$username = $name["anon"];
				}
			}
		}
		$comment = $this->input->post('commentBox');
		$this->comments_model->add_comment($id, $username, $comment);
		redirect('video/'.$id);
	}

}

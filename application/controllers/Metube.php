<?php
/**
 * Handles navigation links, home and search
 */
class Metube extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'url_helper', 'captcha'));
		$this->load->library('session');
		$this->load->model('videos_model');
		$this->load->model('comments_model');
		$this->load->model('users_model');
	}
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$data['videos'] = $this->videos_model->get_videos();
		$data['userdata'] = $this->session->all_userdata();
		$data['title'] = 'Home';
		$data['heading'] = 'Recommended Videos';
		$this->load->view('home', $data);
	}

	/**************************************
	 * Search *
	 **************************************/

	/**
	 * Search Function - handles getting the search results
	 */
	public function search() {
		$input = $this->input->get('search');
		$videos = $this->videos_model->search($input);
		$data['userdata'] = $this->session->all_userdata();
		$data['videos'] = $videos;
		$data['heading'] = 'Search results for '. "'".$input."'";
		$data['title'] = 'Search';
		$this->load->view('home', $data);
	}

	/**
	 * SearchList Function - Handles suggestions for search
	 */
	public function searchList() {
		$query = $this->input->post('search');
		$data = $this->videos_model->search($query);
		echo json_encode($data);
	}

	/**************************************
	 * Navigation Side Bar Links *
	 **************************************/

	/**
	 * Upload Videos Function - Handles page that shows videos that the user has uploaded
	 */
	public function upvideos() {
		$data['username'] = $this->session->userdata('username');
		$username = $this->session->userdata('username');
		$data['userdata'] = $this->session->all_userdata();
		$data['videos'] = $this->videos_model->get_videos($username);
		$data['title'] = 'Uploads';
		$data['heading'] = 'Videos you uploaded';
		$this->load->view('home', $data);
	}

	/**
	 * Delete Function - Handles delete request for an uploaded video
	 */
	public function delete($id) {
		$this->videos_model->delete($id);
		redirect('Metube/upvideos');
	}

	/**
	 * Favourite Function - Shows favourite list
	 */
	public function fav() {
		$username = $this->session->userdata('username');
		$data['videos'] = $this->videos_model->get_fav($username);
		$data['userdata'] = $this->session->all_userdata();
		$data['title'] = 'Favourite';
		$data['heading'] = 'Favourite Videos';
		$this->load->view('home', $data);
	}

	/**
	 * Unfavourite List Function - Handles removing a video from favourites from the list
	 */
	public function unFavList($id) {
		$username = $this->session->userdata('username');
		$this->videos_model->unfav($username, $id);
		redirect('Metube/fav');
	}
}

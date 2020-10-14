<?php
require_once(APPPATH.'../vendor/autoload.php');

/**
 * Login Class - Handles login and logout requests of users
 */
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'url_helper'));
		$this->load->library('session');
		$this->load->model('users_model');
  }
  
	/**
	 * Login Form Function - Shows login form
	 */
	public function loginForm() {
		if(!$this->session->userdata('logged_in')){
			$data['error'] = $this->session->userdata('error');
			if($this->input->cookie('username') != '') { // Check if user has cookie set
				$data['username'] = $this->input->cookie('username');
				$data['password'] = $this->input->cookie('password');
			} else {
				$data['username'] = '';
				$data['password'] = '';
			}
			$this->load->view('login', $data);
			$this->session->unset_userdata('error', '');
		} 
  }

  /**
	 * Login Function - Handles form submitted by user to log in
	 */
  public function login() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$remember = $this->input->post("remember");
		$user = $this->users_model->get_user($username);
		if(!$this->session->userdata('logged_in')) {
			if ($username == $user['username'] & password_verify($password, $user['password'])) {
				// Create cookie if checked
				if((int) $remember == 1) {
					$this->input->set_cookie('username', $username, '15');
					$this->input->set_cookie('password', $password, '15');
				} 
				// Create session
				$this->session->set_userdata($user);
				$this->session->set_userdata('logged_in', True);
				$this->session->unset_userdata('error', '');
        redirect('');
			} elseif ($username == $user['username'] & $password != $user['password']) {
				$this->session->set_userdata('error', 'Incorrect password');
        redirect('Login/loginForm');
			
			} else {
				$this->session->set_userdata('error', 'No account found');
        redirect('Login/loginForm');
			}
		} else {
			$this->load->view('home');
		}
	}

  /**
   * FB Login Function - Handles login via facebook requests
   */
	public function fbLogin(){
		$fb = new Facebook\Facebook([
			'app_id' => '253853199025794',
			'app_secret' => '3d86811642fe0908a64d75707a69185a',
			'default_graph_version' => 'v2.10',
			]);
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; 
		$loginUrl = $helper->getLoginUrl(base_url().'Login/fbLoginCallback', $permissions);
		redirect($loginUrl);
	}

  /**
   * FB Login Callback Function - Handles redirect from facebook login request
   */
	public function fbLoginCallback(){
		$fb = new Facebook\Facebook([
			'app_id' => '253853199025794',
			'app_secret' => '3d86811642fe0908a64d75707a69185a',
			'default_graph_version' => 'v2.10',
		]);

		$helper = $fb->getRedirectLoginHelper();
		try {
			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exception\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exception\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (isset($accessToken)) {
			// Logged in!
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			$response = $fb->get('/me?locale=en_US&fields=name,email');
			$userNode = $response->getGraphUser();
			$user = $this->users_model->get_user($userNode->getField('name'));
			if ($user == NULL) {
				$this->users_model->register($userNode->getField('name'), $userNode->getField('email'));
				$user = $this->users_model->get_user($userNode->getField('name'));
				$this->session->set_userdata($user);
				$this->session->set_userdata('logged_in', True);
			} else {
				$this->session->set_userdata($user);
				$this->session->set_userdata('logged_in', True);
			}
			redirect('');
		}
	}

  /**
   * Logout Function - Handles log out request
   */
	public function logout() {
		// Unset user data
		$this->session->sess_destroy();
		redirect('');
	}

}

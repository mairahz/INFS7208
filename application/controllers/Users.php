<?php

/**
 * Handles User registration,email verification and forgot password
 */
class Users extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->helper(array('cookie', 'form', 'url', 'captcha'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->model('users_model');
		$this->load->model('email_model');
	}

	/**************************************
	 * Class Functions *
	 **************************************/

	/**
	 * Password Check Function - Checks that password matches criteria
	 */
	function password_check($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Validata Captcha Function - Checks that captcha entered is correct
	 */
	function validate_captcha()
  {
		if ($this->input->post('captcha') != $this->session->userdata['captcha']) {
				$this->form_validation->set_message('validate_captcha', 'Captcha Code is wrong');
				return false;
		} else {
				return true;
		}
	}

	/**************************************
	 * Captcha Functions *
	 **************************************/
	
	/**
	 * Refresh Function - Refreshes captcha
	 */
	public function refresh()
	{
		$config = array(
				'img_url' => base_url() . 'captcha/',
				'img_path' => 'captcha/',
				'img_height' => 50,
				'word_length' => 5,
				'img_width' => 200,
				'font_size' => 50
		);
		$captcha = create_captcha($config);
		$this->session->unset_userdata('captcha');
		$this->session->set_userdata('captcha', $captcha['word']);
		echo $captcha['image'];
	}

	/**************************************
	 * Register Functions * 
	 **************************************/

	/**
	 * Register Form Function - Shows form for users to register
	 */
	public function registerForm() {
		$config = array(
			'img_url' => base_url('captcha'),
			'img_path' => './captcha/',
			'img_height' => 50,
			'word_length' => 5,
			'img_width' => 200,
			'font_size' => 50
	);
	$captcha = create_captcha($config);
	$data['captcha'] = $captcha;

	$this->session->unset_userdata('captcha');
	$this->session->set_userdata('captcha', $captcha['word']);
	$this->load->view('register', $data);
	}

	/**
	 * Register Function - Function that validates the register form and registers the user
	 */
	public function register() {
		$this->form_validation->set_message('password_check', 'Your password must have at least a character and a number.');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|callback_password_check|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');
		$this->form_validation->set_rules('ans1', 'Answer 1', 'required');
		$this->form_validation->set_rules('ans2', 'Answer 2', 'required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');

		$data = array();
	
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'code' => 1,
				'msg' => validation_errors()
			);
			$original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
			$original_string = implode("", $original_string);
			$captcha = substr(str_shuffle($original_string), 0, 6);
			$vals = array(
				'word' => $captcha,
				'img_url' => base_url('captcha'),
				'img_path' => './captcha/',
				'font_size' => 10,
				'img_width' => 150,
				'img_height' => 50,
				'expiration' => 7200
			);
			$cap = create_captcha($vals);
			$data['image'] = $cap['image'];
			$this->session->unset_userdata('captcha');
			$this->session->set_userdata('captcha', $cap['word']);

		} else {
			$username = $this->input->post("username");
			$email = $this->input->post("email");
			$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
			$qn1 = $this->input->post("question1");
			$qn2 = $this->input->post("question2");
			$ans1 = $this->input->post("ans1");
			$ans2 = $this->input->post("ans2");
			$result = $this->users_model->check_user($username, $email);
			if ($result != ''){
				$data = array(
					'code' => 1,
					'msg' => $result
				);
			} elseif($qn1 === $qn2) {
				$data = array(
					'code' => 1,
					'msg' => 'Please choose different secret questions.'
				);
			} else {
				$data = array(
					'code' => 0,
					'msg' => 'Successfully registered! Redirecting you to home page'
				);
				$this->session->unset_userdata('captcha');
				$code = substr(md5(time()), 0, 20);
				$this->session->set_userdata('logged_in', True);
				$this->users_model->register($username, $email, $password, $code, $qn1, $qn2, $ans1, $ans2);
				$this->email_model->sendVerificationEmail($email, $code);
				$user_data = $this->users_model->get_user($username);
				$this->session->set_userdata($user_data);
			}
		}
		echo json_encode($data);
	}

	/**************************************
	 * Email Verification Functions *
	 **************************************/

	/**
	 * Verify Function - Updates user's email to be verified if the code is correct
	 */
	public function verify($code){
		$verified = $this->users_model->verifyEmail($code);
		if ($verified > 0){ 
			$error = 'success';
		} else {
			$error = 'error';
		}
		$data['error'] = $error;
		$this->session->set_userdata('verified', 'Y');
		$data['userdata'] = $this->session->all_userdata();
		$this->load->view('profile', $data);
	}
	 
	/**
	 * Send Verification Email Function - sends a verification email to the user
	 */
	public function sendVerificationEmail(){  
		$code = $this->session->userdata('verify_code');
		$email = $this->session->userdata('email');
		$this->email_model->sendVerificationEmail($email, $code);
		redirect('Profile/profile');   
	} 

	/**************************************
	 * Forgot Password Functions *
	 **************************************/

	/**
	 * Forgot Function - Shows forgot password form
	 */
	public function forgot(){
		 $username = $this->input->post('forgotUser');
		 $data['username'] = $username;
		 $data['qns'] = $this->users_model->get_qns($username);
		 $this->load->view('forgot', $data);
	}

	/**
	 * Verify Questions Function - Verify that the answers that the user entered are correct
	 */
	public function verifyQns(){
		$username = $this->input->post('username');
		$qn1 = $this->input->post('qn1');
		$qn2 = $this->input->post('qn2');
		$ans1 = $this->input->post('ans1');
		$ans2 = $this->input->post('ans2');
		$qns = $this->users_model->get_qns($username);
		$i=0;
		foreach($qns as $qn){
			if ($qn1 == $qn['question']){
				if($ans1 == $qn['answer']){
					$i += 1;
				} else {
					break;
				}
			} elseif($qn2 == $qn['question']) {
				if($ans2 == $qn['answer']){
					$i += 1;
				} else {
					break;
				}
			}
		}
		if ($i == 2) {
			$data = array(
				'code' => 0,
				'msg' => 'Successfully verified! Please change your password.'
			);
		} else {
			$data = array(
				'code' => 1,
				'msg' => 'One or both answers to the question are wrong.'
			);
		}
		echo json_encode($data);
	}

	/**
	 * Change Password Function - Functio that changes the user password
	 */
	public function changePass(){
		$this->form_validation->set_message('password_check', 'Your password must have at least a character and a number.');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|callback_password_check|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'code' => 1,
				'msg' => validation_errors()
			);
		} else {
			$username = $this->input->post('username');
			$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
			$this->users_model->update_pass($username, $password);
			$data = array(
				'code' => 0,
				'msg' => 'Password successfully changed! Please login.'
			);
		}
		echo json_encode($data);
	}
	
}

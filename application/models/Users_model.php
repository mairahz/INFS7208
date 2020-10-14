<?php

class Users_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /**
   * Gets a user or all users if no username is specified
   */
  public function get_user($username = FALSE) {
    if ($username === FALSE) {
      $query = $this->db->get('users');
      return $query->result_array();
    }
    $query = $this->db->get_where('users', array('username' => $username));
    return $query->row_array();
  }

  /**
   * Checks if username is taken or if the email is already registered
   */
  public function check_user($username, $email) {
    $result = $this->db->get_where('users', array('username' => $username));
    if ($result->num_rows() > 0){
      $data = 'Username is taken. Please choose a different username.';
    } else {
      $result = $this->db->get_where('users', array('email' => $email));
      if ($result->num_rows() > 0){
        $data = 'This email has been registered.';
      } else {
        $data = '';
      }
    }
    return $data;
  }

  /**
   * Register a user
   */
  public function register($username, $email, $password = FALSE, $code = FALSE, $qn1 = FALSE, $qn2 = FALSE, $ans1 = FALSE, $ans2 = FALSE) {
    if ($qn1 != FALSE) {
      $data = array(
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'verify_code' => $code
      );

      $qns1 = array(
        'username' => $username,
        'question' => $qn1,
        'answer' => $ans1,
      );
      $qns2 = array(
        'username' => $username,
        'question' => $qn2,
        'answer' => $ans2,
      );
      $this->db->insert('questions', $qns1);
      $this->db->insert('questions', $qns2);
    } else {
      $data = array(
        'username' => $username,
        'email' => $email,
      );
    }
    $this->db->insert('users', $data);
  }

  /**
   * Updates user's details
   */
  public function update($user) {
    $this->db->update('users', $user, array('username' => $user['username']));
  }

  /**
   * Updates user's password
   */
  public function update_pass($username, $password) {
    $this->db->update('users', array('password' => $password), array('username' => $username));
  }

  /**
   * Returns rows where the verification code is correct
   */
  public function verifyEmail($code){
    $data = array(
      'verified' => 'Y'
    );
    $this->db->update('users', $data, array('verify_code' => $code));
    return $this->db->affected_rows();
  }

  /**
   * Get secret questions
   */
  public function get_qns($username) {
    $query = $this->db->get_where('questions', array('username' => $username));
    return $query->result_array();
  }

}
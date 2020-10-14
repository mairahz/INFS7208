<?php

class Email_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->library('email');
  }

  /**
   * Sends verification email
   */
  function sendVerificationEmail($email, $code){

    $config = array(   
      'protocol' => 'smtp', 
      'smtp_host' => 'mailhub.eait.uq.edu.au', 
      'smtp_port' => 25, 
      'mailtype' => 'html', 
      'charset' => 'iso-8859-1', 
      'wordwrap' => TRUE 
    );
  
    // $config = Array(
    //   'protocol' => 'smtp',
    //   'smtp_host' => 'smtp.gmail.com',
    //   'smtp_port' => 465,
    //   'smtp_user' => 'metubead@gmail.com', 
    //   'smtp_pass' => 'lengami240398', 
    //   'smtp_crypto' => 'ssl',
    //   'mailtype' => 'html',
    //   'charset' => 'iso-8859-1',
    //   'wordwrap' => TRUE
    // );
      
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from('noreply@infs3202-78e5e2fd.uqcloud.net', "Admin Team");
    $this->email->to($email);  
    $this->email->subject("Email Verification");
    $this->email->message("Dear User,\r\n Please click on the URL below or paste the URL into your browser to verify your Email Address \r\n https://infs3202-78e5e2fd.uqcloud.net/MeTube/index.php/Users/verify/".$code." \r\n "." \r\n Thank You \r\n Admin Team");
    $this->email->send();

  }


}
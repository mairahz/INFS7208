<?php
require __DIR__ . '/../../vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class Notification extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('users_model');
  }
  
	public function commentNotif(){
		$username = $_POST['username'];
		$subscription = $this->users_model->get_user($username);
    $subscription = $subscription['endpoint'];
    
    $auth = array(
      'VAPID' => array(
        'subject' => 'MeTube',
        'publicKey' => file_get_contents(__DIR__ . '/../../public_key.txt'),
        'privateKey' => file_get_contents(__DIR__ . '/../../private_key.txt')
      )
    );

    $webPush = new WebPush($auth);

    // $res = $webPush->sendNotification(
    //   $subscription,
    //   "Hello!"
    // );
		echo json_encode($subscription );
	}

}

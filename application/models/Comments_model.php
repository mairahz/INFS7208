<?php

class Comments_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /**
   * Get comments of a video
   */
  public function get_comments($videoID) {
    $query = $this->db->get_where('comments', array('videoID' => $videoID));
    return $query->result_array();
  }

  /**
   * Add a comment to a video
   */
  public function add_comment($videoID, $username, $comment) {
    $data = array(
      'videoID' => $videoID,
      'username' => $username,
      'comment' => $comment
    );
    return $this->db->insert('comments', $data);
  }
}
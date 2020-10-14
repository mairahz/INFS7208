<?php

class Videos_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /**
   * Searches for videos based on input
   */
  public function search($input) {
    if($input == null) {
      $query = $this->db->get('videos');
      return $query->result_array();
    }
    $query =  $this->db->query('SELECT videoID, username, thumbnail, title, des
                                FROM videos
                                WHERE title LIKE "%'.$input.'%"
                                OR username LIKE "%'.$input.'%"
                                ');
    return $query->result_array();
  }

  /**
   * Get all videos or video that is uploadded by a user if specified
   */
  public function get_videos($username = FALSE) {
    if ($username === FALSE) {
      $query = $this->db->get('videos');
      return $query->result_array();
    }
    $query = $this->db->get_where('videos', array('username' => $username));
    return $query->result_array();
  }

  /**
   * Get details of a video
   */
  public function get_video_details($id) {
    $query = $this->db->get_where('videos', array('videoID' => $id));
    return $query->row_array();
  }

  /**
   * Adds a video
   */
  public function insert($video) {
    return $this->db->insert('videos', $video);
  }

  /**
   * Deletes a video
   */
  public function delete($videoID) {
    $this->db->query("DELETE FROM videos
                      WHERE videoID = '".$videoID."'
                      ");
  }

  /**
   * Get all videos that a user has fvaourited or checks if the user has favourited a particular video
   */
  public function get_fav($username, $videoID = FALSE){
    if($videoID === FALSE) {
      $query = $this->db->query("SELECT videos.videoID, videos.username, videos.video, videos.thumbnail, videos.title, videos.des
                                  FROM videos
                                  JOIN favourite_videos ON videos.videoID = favourite_videos.videoID
                                  AND favourite_videos.username = '".$username."'");
      return $query->result_array();
    }
    $query = $this->db->query("SELECT username, videoID FROM favourite_videos
                                WHERE username = '".$username."'
                                AND videoID = '".$videoID."'
                                ");
    return $query->row();
  }

  /**
   * Add a video to a user's favourite
   */
  public function add_fav($username, $videoID) {
    $this->db->insert('favourite_videos', array('username' => $username, 'videoID' => $videoID));
  }

  /**
   * Removes a video from a user's favourite
   */
  public function unfav($username, $videoID) {
    $this->db->query("DELETE FROM favourite_videos
                      WHERE username = '".$username."'
                      AND videoID = '".$videoID."'
                      ");
  }

  /**
   * Gets anonymous name of a user for a particular video
   */
  public function get_anon($id, $username) {
    $query = $this->db->get_where('anonymous', array('videoID' => $id, 'username' => $username));
    return $query->row_array();
  }

  /**
   * Adds an anonymous name for a user for a video
   */
  public function add_anon($id, $username, $anon) {
    $this->db->insert('anonymous', array('videoID' => $id, 'username' => $username, 'anon' => $anon));
  }

  /**
   * Check if anonymous name has been used for a video
   */
  public function check_anon($id, $anon) {
    $query = $this->db->get_where('anonymous', array('videoID' => $id, 'anon' => $anon));
    return $query->result_array();
  }
}
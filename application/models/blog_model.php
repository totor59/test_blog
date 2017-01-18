<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_all_posts($limit, $start) {
    return $query =  $this->db->select('*')
    ->order_by('date', 'DESC')
    ->get('article', $limit, $start)
    ->result();
  }

  public function get_post($slug) {
  return $query = $this->db->select('*')
    ->from('article')
    ->where('slug', $slug)
    ->get()
    ->row();
  }
}

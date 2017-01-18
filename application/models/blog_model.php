<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all_posts($limit, $start) {
        $query =  $this->db->select('*')
                           ->order_by('id', 'DESC')
                           ->get('article', $limit, $start)
                           ->result();
        return $query;
    }
  }

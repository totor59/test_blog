<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('blog_model');
    $this->load->helper('url');
    $this->load->library('pagination');
  }

  function index()
  {
    // PAGINATION
    $start = $this->uri->segment(2);
    $limit = 3;
    $config = array();
    $config["base_url"] = base_url(). "blog/";
    $config["total_rows"] = $this->db->get('article')->num_rows();
    $config["per_page"] = $limit;
    $config['use_page_numbers'] = FALSE;
    $this->pagination->initialize($config);
    $data["links"] = $this->pagination->create_links();
    // PAGINATION END
    $data['query'] = $this->blog_model->get_all_posts($limit, $start);
    $this->load->view('blog/index',$data);
  }
}
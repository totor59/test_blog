<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('blog_model');
  }

  function index() {
    $this->output->enable_profiler(true);
    if($this->session->userdata('logged_in') === TRUE ) {
      // PAGINATION
      $start = $this->uri->segment(3);
      $limit = 3;
      $config = array();
      $config["base_url"] = base_url(). "dashboard/page/";
      $config['first_url'] = base_url(). "dashboard/";
      $config["total_rows"] = $this->db->get('article')->num_rows();
      $config["per_page"] = $limit;
      $config['use_page_numbers'] = FALSE;
      $this->pagination->initialize($config);
      $data["links"] = $this->pagination->create_links();
      // PAGINATION END
      $data['query'] = $this->blog_model->get_all_posts($limit, $start);
      $data['title'] = 'Dashboard';
      $this->load->view('templates/header', $data);
      $this->load->view('admin/dashboard',$data);
      $this->load->view('templates/footer');
    }
    else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  public function view($slug) {
    if(!$this->session->userdata('logged_in')) {
      redirect('login', 'refresh');
    }
    $data['post'] = $this->blog_model->get_post($slug);
    if(!isset($data['post'])) {
      show_404();
    } else {
      $this->load->view('templates/header-view', $data);
      $this->load->view('admin/view', $data);
      $this->load->view('templates/footer');
    }
  }
  public function logout() {
    //$this->session->unset_userdata('logged_in');
    session_destroy();
    redirect(base_url().'blog/');
  }

  // CRUD FUNCTIONS

  public function create() {
    if(!$this->session->userdata('logged_in') === TRUE ) {
      redirect('login', 'refresh');
    }
    $this->output->enable_profiler(true);
    $data['title'] = 'Create a blog item';
    $slug = url_title($this->input->post('title'), 'dash', TRUE);
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('admin/create');
      $this->load->view('templates/footer');
    }
    else {
      $this->blog_model->set_article();
      $this->load->view('messages/create_success');
    }
  }

  public function delete($slug) {
    if(!$this->session->userdata('logged_in') === TRUE ) {
      redirect('login', 'refresh');
    }
    $this->output->enable_profiler(true);
    $this->blog_model->delete_article($slug);
    $this->load->view('messages/delete_success');
  }

  public function update($slug) {
    if(!$this->session->userdata('logged_in') === TRUE ) {
      redirect('login', 'refresh');
    }
    $this->output->enable_profiler(true);
    $data['post'] = $this->blog_model->get_post($slug);
    $data['title'] = 'Update a blog item';
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Text', 'required');
    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      var_dump($data);
      $this->load->view('admin/update', $data);
      $this->load->view('templates/footer');
    }
    else {
      $id = $this->input->post('id');
      $this->blog_model->set_article($id);
      $this->load->view('messages/update_success');
    }
  }
}

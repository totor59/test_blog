<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
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

  public function set_article($id)  {
  // On crée un slug clean et on utilise convert_accented_characters pour supprimer les accents
  $slug = url_title(convert_accented_characters($this->input->post('title'), 'dash', TRUE));
  $data = array(
    'title' => $this->input->post('title'),
    'slug' => $slug,
    'content' => $this->input->post('content')
  );
  if ( $id == 0 ) {
    // Si l'ID est égal a 0 on insère un nouvel article
    $this->db->insert('article', $data);
  } else {
    // Sinon on update l'article qui correspond a l'ID
    $this->db->where('id', $id)
             ->update('article', $data);
  }
}

public function delete_article($slug)  {
  $this->db->where('slug',$slug)
           ->delete('article');
}
}

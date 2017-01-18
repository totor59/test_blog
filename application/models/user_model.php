<?php
class User_model extends CI_Model {
  public function __construct() {
  }

  public function login($username,$password) {
  // On sélectionne les users qui correspondent a $usernmae et $password
  $query = $this->db->where('username', $username)
                    ->where('password', $password)
                    ->get('users');
  // Si la requéte retourne un résultat et on crée les variables de session
  if($query->num_rows() == 1) {
    $row = $query->row();
    $username = ucfirst($row->username);
    $data = array(
      'username' => $username,
      'usertype' => $row->usertype,
      'user_id' => $row->id,
      'logged_in' => true,
    );
    $this->session->set_userdata($data);
    return true;
  } else {
    return false;
  }
}
}

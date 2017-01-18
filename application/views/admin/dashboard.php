<?php if($query):foreach($query as $post):?>
  <h3><?=$post->title; // Titre de l'article ?></h3>
  <div class="main">
    <?=character_limiter($post->content, 256); // Extrait de l'article ?>
  </div>
  <p><a href="<?=site_url('dashboard/'.$post->slug); // Redirige vers la single view ?>">Lire la suite</a></p>
  <form method=POST action="<?php echo base_url().'dashboard/update/'.$post->slug; ?>">
    <input type="submit" value="EDIT">
  </form>
  <form method="POST" action="<?php echo base_url().'dashboard/delete/'.$post->slug; ?>">
    <input type="submit" value="DELETE">
  </form>

  <?php
endforeach;
endif;
?>
<?= $links; // Pagination ?>
<br>
<a href="<?=site_url('create'); // Redirige vers la création d'article ?>">Ecrire un nouvel article</a>
<?php
// Si l'utilisateur est loggé on affiche le bouton log out
if($_SESSION['logged_in']) {
  echo form_open('logout/');
  echo form_submit('submit','Log out');
  echo form_close();
}

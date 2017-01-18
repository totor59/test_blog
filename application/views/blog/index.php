
<?php if($query):foreach($query as $post):?>

  <h3><?=$post->title// Titre de l'article ?></h3>
  <div class="main">
    <?=character_limiter($post->content, 256)// Extrait de l'article ?>
  </div>
  <p><a href="<?=site_url('blog/'.$post->slug) ?>">Lire la suite</a></p>

<?php endforeach;
endif;
var_dump($query); ?>
<?= $links; ?>

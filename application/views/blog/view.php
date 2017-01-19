

<p><?php echo $post->content; // Contenu de l'article ?></p>
<p>Ecrit le <?php echo date('d-m-Y',strtotime($post->date));?></p>
<br>
<a href="<?php echo base_url().'blog/'; // Retourner à l'index ?>">BACK TO BLOG INDEX</a>
<br>

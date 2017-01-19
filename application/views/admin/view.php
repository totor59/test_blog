<?php if(!isset($post->content)) {
  echo "This page was accessed incorrectly";
} else {?>
<p><?php echo $post->content;?></p>
<p>Ecrit le <?php echo date('d-m-Y',strtotime($post->date));?></p>
<br>
<a href="<?php echo base_url().'dashboard/'; ?>">BACK TO DASHBOARD</a>
<br>
<form method=POST action="<?php echo base_url().'dashboard/update/'.$post->slug; ?>">
  <input type="submit" value="EDIT">
</form>
<form method="POST" action="<?php echo base_url().'dashboard/delete/'.$post->slug; ?>">
  <input type="submit" value="DELETE">
</form>
<?php }

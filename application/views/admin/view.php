
<p><?php echo $post->content;?></p>
<br>
<a href="<?php echo base_url().'dashboard/'; ?>">BACK TO DASHBOARD</a>
<br>
<form method=POST action="<?php echo base_url().'dashboard/update/'.$post->slug; ?>">
  <input type="submit" value="EDIT">
</form>
<form method="POST" action="<?php echo base_url().'dashboard/delete/'.$post->slug; ?>">
  <input type="submit" value="DELETE">
</form>

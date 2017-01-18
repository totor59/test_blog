<?php echo validation_errors(); ?>
<?php echo form_open('Dashboard/update/'.$post->id); ?>
<input type="input" name="title" value="<?php echo $post->title;?>" /><br />
<textarea name="content" class="ckeditor" rows="10" cols="40"><?php echo $post->content;?></textarea><br />
<input type="hidden" name="id" value="<?php echo $post->id;?>"/>
<input type="submit" name="submit" value="Edit the article" />
<script>
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
</script>
</form>

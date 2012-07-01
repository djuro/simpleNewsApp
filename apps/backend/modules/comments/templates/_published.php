<input type="checkbox" class="pub_cbox" data-commentid="<?php echo $comments->getId()?>" name="comment_published" <?php

if($comments->getPublished()==1)
{
  echo 'checked="checked"';
}


?>>
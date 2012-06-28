<input type="checkbox" class="pub_cbox" data-articleId="<?php echo $articles->getId()?>" name="article_published" <?php

if($articles->getPublished()==1)
{
  echo 'checked="checked"';
}


?>>
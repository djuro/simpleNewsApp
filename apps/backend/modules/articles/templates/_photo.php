<?php use_helper('text')?>
<?php echo '<span title="'.$articles->getPhoto().'"><u>'.truncate_text($articles->getPhoto(),15,'...',true).'</u></span>' ?>
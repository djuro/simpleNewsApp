<input type="checkbox" class="active_cbox" data-userid="<?php echo $users->getId()?>" name="user_active" <?php

if($users->getActive()==1)
{
  echo 'checked="checked"';
}


?>>
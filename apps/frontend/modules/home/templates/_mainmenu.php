<div id="menu">
				<ul>
					<li><a href="<?php echo url_for('home/index')?>"><?php echo __('Homepage')?></a></li>
					
					<?php  if(!empty($user_name)):  ?>
					
					<li><a href="#" onClick="return false;"><?php echo __('Welcome ').$user_name.' '.$user_surname;?></a></li>
					<li><a href="<?php echo url_for('user/logout')?>"><?php echo __('Log out')?></a></li>
					
					<?php  elseif(!empty($user_nickname)): ?>
					
					<li><a href="#" onClick="return false;"><?php echo __('Welcome ').$user_nickname;?></a></li>
					<li><a href="<?php echo url_for('user/logout')?>"><?php echo __('Log out')?></a></li>
					
					<?php  else:?>
					
					<li><a href="<?php echo url_for('user/index')?>"><?php echo __('Register')?></a></li>
					<li><a href="<?php echo url_for('user/login')?>"><?php echo __('Log in')?></a></li>
					
					<?php  endif; ?>
					
					
				</ul>
			</div>
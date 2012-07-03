<?php if($author===true):?>

<ul id="backendmenu" style="position:relative;">

	<img src="/sfproject/web/images/ajax-loader.gif" id="ajxload" style="display:none;position:absolute;z-index:100;left:500px;top:-20px;">

	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('articles/index')?>">Articles</a></li>
	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('comments/index')?>">Comments</a></li>
	<li style="list-style-type:none;display:inline;"><a href="http://localhost/sfproject/web/en/home">Frontend</a></li>
	
</ul>

<?php else: ?>

<ul id="backendmenu" style="position:relative;">

	<img src="/sfproject/web/images/ajax-loader.gif" id="ajxload" style="display:none;position:absolute;z-index:100;left:500px;top:-20px;">

	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('articles/index')?>">Articles</a></li>
	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('comments/index')?>">Comments</a></li>
	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('categories/index')?>">Categories</a></li>
	<li style="list-style-type:none;display:inline;"><a href="<?php echo url_for('users/index')?>">Users</a></li>
	<li style="list-style-type:none;display:inline;"><a href="http://localhost/sfproject/web/en/home">Frontend</a></li>
	
</ul>

<?php endif; ?>
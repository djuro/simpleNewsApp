<?php 
  use_helper('text');
  use_helper('date');
  use_helper('I18N');
  use_javascript("jquery.js");
  use_javascript("show_comments.js");
?>
<div id="page">
			<div id="content">
			
			<div class="post">

			<h2 class="title"><?php echo $article->getTitle();?></h2>
			<img src="<?php echo '/sfproject/web/uploads/'.$article->getPhoto();?>" style="width:600px;">
			<p>&nbsp;</p>
			<div class="entry"><?php echo nl2br($article->getText())?>
			</div>
			
      <p class="meta"><?php echo $article->Users->getName().'&nbsp;'; echo $article->Users->getSurname();?>,
      &nbsp;&nbsp;&nbsp;<?php echo format_datetime($article->getPublishedAt(),'F','','UTF-8')?> 
      <a href="#" onClick="return false;" id="showcomments" class="comments">Comments <?php echo $num_comments->getCmnts()?></a></p>
      

	  <div id="comments-div" style="display:none;">
			<?php 
			
			foreach($article->Comments as $comment)
			       {
			        echo '<div class="post">';
					
			        echo '<div class="entry">';
			        echo $comment->getText();
			        echo '</div>';
					echo '<p style="font-size:10px;"><strong>';
					
					$comment_autor = $comment->getUsers()->getName();
					if(!empty($comment_autor)):
					     echo $comment->getUsers()->getName().'&nbsp;'.
					          $comment->getUsers()->getSurname().'&nbsp;';
					else:
					     echo $comment->getUsers()->getNickname().'&nbsp;';
					endif;
					     echo format_datetime($comment->getPublishedAt(),'F','','UTF-8').'</strong></p>';
			        echo '</div>';
			       }
				   
			?>
	 </div>
			</div>
			<!--  prikazuje ili skriva link za dodavanje komentara -->
			<?php if(!empty($user_id)):?>

			<p><a href="<?php echo url_for('comment/').'index/article/'.$article->getId()?>">Ostavite komentar</a></p>
		    <?php else:?>
		     <p><a href="<?php echo url_for('user/index')?>">Ostavite komentar</a></p>
		    <?php endif;?>
		    
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					
					<li>
						<!--h3>Veroeros etiam</h3>
						<p><strong>Morbi sit amet</strong> mauris Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Proin auctor dolor loremmassa. Phasellus sit. <a href="#">More&hellip;</a></p>
					</li-->
					<?php include_component('home', 'toparticles') ?>
					<!--  here was a list of sidebar links -->
					<?php include_component('home', 'categorieslist') ?>
				</li>
				</ul>
				<?php include_component('home', 'tagcloud') ?>
			</div>
			<!-- end #sidebar -->
			<div style="clear: both;">&nbsp;</div>
			<div id="widebar">
				<!--div id="colA">
					<h3>Volutpat Consequat</h3>
					<dl class="list1">
						<dt>12.17.2007</dt>
						<dd><a href="#">Praesent nonummy sed lorem</a></dd>
						<dt>12.13.2007</dt>
						<dd><a href="#">Mauris sagittis neque nec nisi sed</a></dd>
						<dt>12.05.2007</dt>
						<dd><a href="#">Vel turpis integer leo venenatis</a></dd>
						<dt>12.02.2007</dt>
						<dd><a href="#">Et pharetra quis sed viverra ante</a></dd>
						<dt>11.30.2007</dt>
						<dd><a href="#">Integer leo lorem sed lorem</a></dd>
					</dl>
				</div>
				<div id="colB">
					<h3>Pharetra Sed Tempus</h3>
					<p>Morbi sit amet mauris Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Lorem ipsum dolor sit dolore phasellus pede lorem proin auctor dolor loremmassa phasellus sit. <a href="#">More&hellip;</a></p>
				</div>
				<!--   here was a nice thumbs html -->
				<?php //include_partial('nice_thumbs') ?>
				
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #widebar -->
		</div>
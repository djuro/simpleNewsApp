<?php 
  use_helper('text');
  use_helper('date');
?>
<div id="page">
			<div id="content">
			
			
				<?php
                  foreach($articles_category as $article):
				?>
			<div class="post">
			<h2 class="title">
			  <a href="<?php echo url_for('home/article').'/id/'.$article['id']?>"><?php echo $article->getTitle();?></a>
			</h2>
			<div class="entry">
			  <!-- slika -->
			  <a href="<?php echo url_for('home/article').'/id/'.$article['id']?>">
			  <img src="<?php echo '/sfproject/web/uploads/'.$article['photo']?>" width="138" height="93" class="left">
			  </a>
			<p><?php echo truncate_text($article->getText(),255,'...',true)?></p>
			</div>
			<p class="meta"><a href="#"><?php echo $article->Categories->getName()?></a>&nbsp;&nbsp;&nbsp;<?php echo format_datetime($article->getPublishedAt(),'F','hr','UTF-8')?><a href="<?php echo url_for('home/article').'/id/'.$article->getId()?>" class="permalink">Read more</a> </p>
           </div>
		<?php endforeach; ?>
			
			
				
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					
					<li>
						<h3>Veroeros etiam</h3>
						<p><strong>Morbi sit amet</strong> mauris Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Proin auctor dolor loremmassa. Phasellus sit. <a href="#">More&hellip;</a></p>
					</li>
					<!--  here was a list of sidebar links -->
					<?php include_component('home', 'categorieslist') ?>
				</ul>
			</div>
			<!-- end #sidebar -->
			<div style="clear: both;">&nbsp;</div>
			<div id="widebar">
				<div id="colA">
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
				<?php include_partial('nice_thumbs') ?>
				
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #widebar -->
		</div>
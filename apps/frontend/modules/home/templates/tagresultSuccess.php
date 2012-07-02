<?php 
  use_helper('text');
  use_helper('date');
?>
<div id="page">
			<div id="content">
			<br />
			<?php 
            //tag = $tagged_articles->getFirst();

			echo '<h1>Odabrani tag: '.$tag['tagtext'].'</h1>'?>
			<?php
                foreach($tagged_articles as $article):
			?>
			<!-- 'post' sadrzi odlomak jednog clanka -->
            <div class="post">
			<h2 class="title"><a href="<?php echo url_for('home/article').'/id/'.$article->getId()?>">
			<?php echo $article->getTitle();?></a></h2>
			<div class="entry">
				
			 <!-- slika, smanjen prikaz -->
			 <a href="<?php echo url_for('home/article').'/id/'.$article->getId()?>">
			  <img src="<?php echo '/sfproject/web/uploads/'.$article->getPhoto()?>" width="138" height="93" class="left">
			 </a>
			
			
			<!-- odlomak clanka -->
			<p><?php echo truncate_text($article->getText(),255,'...',true)?></p>
	
		
			</div>
			<p class="meta"><a href="<?php echo url_for('home/category').'/id/'.$article->getCategoryId()?>">
			  <?php echo $article->getCategories()->getName()?></a>&nbsp;&nbsp;&nbsp;
			  <?php echo format_datetime($article->getPublishedAt(),'F','hr','UTF-8')?>
			  <a href="<?php echo url_for('home/article').'/id/'.$article->getId()?>" class="permalink">Read more</a></p>
            </div>
		    <?php endforeach; ?>
			
			
			
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					
					<li>
						
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
				</div-->
				<!--   here was a nice thumbs html -->
				<?php //include_partial('nice_thumbs') ?>
				
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #widebar -->
		</div>
	
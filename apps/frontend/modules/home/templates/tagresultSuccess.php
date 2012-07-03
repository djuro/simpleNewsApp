<?php 
  use_helper('text');
  use_helper('date');
  use_helper('I18N');
?>
<div id="page">
			<div id="content">
			<br />
			<?php 
            //tag = $tagged_articles->getFirst();

			echo '<h1>'. __('The chosen tag:').' '.$tag['tagtext'].'</h1>'?>
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
			  <?php echo format_datetime($article->getPublishedAt(),'F','','UTF-8')?>
			  <a href="<?php echo url_for('home/article').'/id/'.$article->getId()?>" class="permalink">
			  	<?php __('Read more')?></a></p>
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
				
				<!--   here was a nice thumbs html -->
				<?php //include_partial('nice_thumbs') ?>
				
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #widebar -->
		</div>
	
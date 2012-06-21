<?php 
  use_helper('text');
  use_helper('date');
?>
<div id="page">
			<div id="content">
			
			<div class="post">
			<h2><?php echo $article->getTitle()?></h2>
			<div class="entry">
			<?php echo nl2br($article->getText())?>
			</div>
			<p>&nbsp;</p>
			<h3 class="title"><?php echo $sf_data->getRaw('h2title')?></h3>
			<div class="entry">
			<?php echo $form->renderFormTag(url_for('comment/index')) ?>
  <table>
    <?php echo $form['article_id']->renderRow(array('class' => 'hdn'), '&nbsp;') ?>
    <?php echo $form['user_id']->renderRow(array('class' => 'hdn'), '&nbsp;') ?>
    <?php echo $form['text']->renderRow() ?>
   
    <tr>
      <td colspan="2">
        <input type="submit" />
      </td>
    </tr>
  </table>
</form>
			</div>
			<p class="meta"><a href="<?php //echo url_for('home/category').'/id/'.$article['c_id']?>"><?php //echo $article['name']?></a>&nbsp;&nbsp;&nbsp;<?php //echo format_datetime($article['published_at'],'F','hr','UTF-8')?><a href="<?php //echo url_for('home/article').'/id/'.$article['id']?>" class="permalink">..</a> <a href="#" class="comments">..</a></p>

		<?php // endforeach; ?>
			
			</div>
				<!-- >div class="post">
					<h2 class="title"><a href="#">Welcome to Pluralism</a></h2>
					<div class="entry"> <img src="/symfony/web/images/img06.jpg" alt="" width="138" height="93" class="left" />
						<p>This is <strong>Pluralism</strong>, a free, fully standards-compliant CSS template designed by <a href="http://www.nodethirtythree.com/">NodeThirtyThree</a> for <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>, released for free under the <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attribution 2.5</a> license. The photos in this design are from <a href="http://www.pdphoto.org/">PDPhoto.org</a>. You're free to use this template for anything as long as you link back to <a href="http://www.freecsstemplates.org/">my site</a>. Enjoy :)</p>
						<p>Sed vel quam. Vestibulum pellentesque. Morbi sit amet magna ac lacus interdum. Donec pede nisl, Maecenas sed sem sit amet lectus mattis molestie. Integer quis eros lorem ipsum dolor sit.</p>
					</div>
					<p class="meta"> <span class="posted">Posted by <a href="#">Someone</a> on December 17, 2007</span> <a href="#" class="permalink">Read more</a> <a href="#" class="comments">Comments (18)</a> </p>
				</div>
				<div class="post">
					<h2 class="title"><a href="#">Sapien sed varius</a></h2>
					<div class="entry">
						<p>Morbi sit amet mauris. Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Proin auctor dolor et massa. Phasellus sit amet velit. Vestibulum vel lacus vitae tortor consectetuer sapien semper dictum. Integer est felis, facilisis quis, lacinia sed, lacinia et, augue. Vivamus ultrices lacinia urna. Proin varius sollicitudin nunc. Vivamus condimentum, dui nec imperdiet porta, odio risus molestie nisl, nec laoreet purus sapien a massa.</p>
					</div>
					<p class="meta"> <span class="posted">Posted by <a href="#">Someone</a> on December 13, 2007</span> <a href="#" class="permalink">Read more</a> <a href="#" class="comments">Comments (18)</a> </p>
				</div-->
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					<!-- >li id="search">
						<h3>Search</h3>
						<form id="searchform" method="get" action="">
							<div>
								<input type="text" name="s" id="s" size="15" />
								<br />
								<input name="submit" type="submit" value="Go" />
							</div>
						</form>
					</li-->
					<li>
						<h3>Veroeros etiam</h3>
						<p><strong>Morbi sit amet</strong> mauris Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Proin auctor dolor loremmassa. Phasellus sit. <a href="#">More&hellip;</a></p>
					</li>
					<!--  here was a list of sidebar links -->
					<?php include_component('home', 'populararticles') ?>
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
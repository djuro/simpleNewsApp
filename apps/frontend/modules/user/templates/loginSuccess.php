<?php 
  use_helper('text');
  use_helper('date');
  use_helper('I18N');
?>
<div id="page">
			<div id="content">
			
			<div class="post">
			
			<h2><?php echo __('User')?></h2>
			
			<div class="entry">
			<?php //echo nl2br($article->getText())?>
			<?php echo $form->renderFormTag(url_for('user/login')) ?>
             <table>
                  <?php echo $form['username']->renderRow() ?>
                  
                  <?php echo $form['password']->renderRow() ?>
                  
                  <tr>
                  <td colspan="2">
                  <input type="submit" value="OK" />
                </td>
              </tr>
            </table>
          </form>
			</div>
			
			
			<!-- h3 class="title"></h3-->
			<!-- div class="entry">
			
			</div-->
			
		<?php if(!empty($username)){echo $username.'&nbsp;' .$id.'&nbsp;'.$uloga;} ?>
			
			</div>
				
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					
					<li>
						<!--h3>Veroeros etiam</h3>
						<p><strong>Morbi sit amet</strong> mauris Nam vitae nibh eu sapien dictum pharetra. Vestibulum elementum neque vel lacus. Proin auctor dolor loremmassa. Phasellus sit. <a href="#">More&hellip;</a></p-->
					<?php include_component('home', 'toparticles') ?>
					</li>
					<!--  here was a list of sidebar links -->
					<?php include_component('home', 'categorieslist') ?>
				</ul>
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
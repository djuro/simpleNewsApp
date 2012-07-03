<?php $tagovi_css = $sf_data->getRaw('tagovi_css')?>
<li style="list-style-type:none;">
    <h3><?php echo __('Tags') ?></h3>
		<div id="cloud" style="padding:5px;width:200px;">
			<?php 
              foreach($tagovi_css as $tag):
              	echo $tag.' ';
              endforeach;
			?>
		</div>
</li>
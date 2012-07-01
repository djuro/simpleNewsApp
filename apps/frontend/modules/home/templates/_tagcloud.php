<li style="list-style-type:none;">
    <h3>Tags</h3>
		<div style="height:200px;width:2oopx;border:solid 1px #ff0000;">
			<?php 
              foreach($tagcloud as $tag):
              	echo '<span>'.$tag->getTagtext().' '.$tag->getBroj().'</span> ';
              endforeach;
			?>
		</div>
</li>
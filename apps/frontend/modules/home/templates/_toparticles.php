<li>
    <h3>Top articles</h3>
		<ul id="toparticles">
		 <?php 
		  foreach($top_articles as $t)
		   {
		    echo '<li style="margin-bottom:8px;"><a href="'.url_for('home/article').'/id/'.$t->getId().'">'.$t->getTitle().'</a></li>';
		   }
		 ?>
		</ul>
</li>
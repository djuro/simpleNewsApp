<li>
    <h3>Blandit Volutpat</h3>
		<ul>
		 <?php 
		  foreach($naslovi as $t)
		   {
		    echo '<li><a href="#">'.$t->getName().'</a></li>';
		   
		   }
		 ?>
		</ul>
</li>
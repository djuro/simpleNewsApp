<li>
    <h3>Categories</h3>
		<ul id="kategorije">
		 <?php 
		  foreach($naslovi as $t)
		   {
		    echo '<li style="font-size:18px;margin:8px;margin-left:0px;"><a href="'.url_for('home/category').'/id/'.$t->getId().'">'.$t->getName().'</a></li>';
		   }
		 ?>
		</ul>
</li>
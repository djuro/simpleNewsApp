<?php
 
class homeComponents extends sfComponents
{
  public function executePopulararticles()
  {
   
    /*
    // Doctrine
    $query = Doctrine::getTable('News')
              ->createQuery()
              ->orderBy('published_at DESC')
              ->limit(5);
 
    $this->news = $query->execute();
    */
   $this->naslovi = array('Morbi sit amet sed magna','Lacus dapibus interdum','Donec pede nisl dolore sed','Lacus dapibus et interdum','Morbi sit amet magna  etiam','Maecenas sed sem lorem','Lacus dapibus interdum','Donec pede nisl dolore');
  }
}
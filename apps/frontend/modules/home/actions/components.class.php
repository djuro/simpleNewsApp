<?php
 
class homeComponents extends sfComponents
{
  public function executeCategorieslist()
  {
   
   $query = Doctrine::getTable('Categories')
              ->createQuery();
              
 
   $this->naslovi = $query->execute();
   
   //$this->naslovi = array('Morbi sit amet sed magna','Lacus dapibus interdum','Donec pede nisl dolore sed','Lacus dapibus et interdum','Morbi sit amet magna  etiam','Maecenas sed sem lorem','Lacus dapibus interdum','Donec pede nisl dolore');
  }
  
  public function executeMainmenu()
  {
    
    $this->user_name = $this->getUser()->getAttribute('user_name');
    $this->user_surname = $this->getUser()->getAttribute('user_surname');
    $this->user_nickname = $this->getUser()->getAttribute('user_nickname');
  }


  public function executeToparticles()
  {
    $query = Doctrine::getTable('Articles')
              ->createQuery('a')
              ->select('a.id,a.title')
              ->from('Articles a')
              ->orderBy('a.read_count DESC')
              ->limit('5');

    $this->top_articles = $query->execute();
    
  }
}
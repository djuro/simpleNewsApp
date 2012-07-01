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

  /**
  * Selecta clanke koji su najvise puta citani za prikaz u 'Top articles'
  */
  public function executeToparticles()
  {
    $query = Doctrine::getTable('Articles')
              ->createQuery('a')
              ->select('a.id,a.title')
              ->from('Articles a')
              ->where('a.published=?',1)
              ->orderBy('a.read_count DESC')
              ->limit('5');

    $this->top_articles = $query->execute();
    
  }

  /**
  * Selecta tagove i grupira ih po zastupljenosti
  */
  public function executeTagcloud()
  {
    /*
    SELECT a.id,a.title,count(t.id) AS broj,t.text 
    FROM articles a 
    INNER JOIN articles_tags at ON a.id=at.articles_id 
    INNER JOIN tags t ON at.tags_id=t.id 
    GROUP BY t.text
    */
    $query = Doctrine::getTable('Articles')
            ->createQuery('a')
            ->select('a.id,t.id,t.text AS tagtext,COUNT(t.text) AS broj')
            ->from('Articles a')
            ->innerJoin('a.Tags t')
            ->groupBy('t.text')
            ->orderBy('broj DESC');

    $this->tagcloud = $query->execute();
  }
}
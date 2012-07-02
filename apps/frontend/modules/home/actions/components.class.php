<?php
 
class homeComponents extends sfComponents
{
  public function executeCategorieslist()
  {
   
   $query = Doctrine::getTable('Categories')
              ->createQuery();
              
 
   $this->naslovi = $query->execute();
   
   
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

    $connection = Doctrine_Manager::connection();
    $query = "SELECT a.id,a.title,count(t.id) AS broj,t.text 
              FROM articles a 
              INNER JOIN articles_tags at ON a.id=at.articles_id 
              INNER JOIN tags t ON at.tags_id=t.id 
              GROUP BY t.text";
    $statement = $connection->execute($query);
    $statement->execute();
    $this->tagcloud = $statement->fetchAll(PDO::FETCH_OBJ);
    
    $this->tagovi_css = array();

    foreach($this->tagcloud as $tag)
    {
     switch($tag->broj)
     {
      case($tag->broj <= 2):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag1">'.$tag->text.'</a>';
      break;
      case($tag->broj <= 4):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag2">'.$tag->text.'</a>';
      break;
      case($tag->broj <= 6):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag3">'.$tag->text.'</a>';
      break;
      case($tag->broj <= 8):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag4">'.$tag->text.'</a>';
      break;
      case($tag->broj <= 10):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag5">'.$tag->text.'</a>';
      break;
      case($tag->broj > 10):
       $this->tagovi_css[] = '<a href="'.url_for('home/tagresult').'?tag='.rawurlencode($tag->text).'" class="tag6">'.$tag->text.'</a>';
      break;
     }
    }
    /*
    $query = Doctrine::getTable('Articles')
            ->createQuery('a')
            ->select('a.id,t.id,t.text AS tagtext,COUNT(t.text) AS broj')
            ->from('Articles a')
            ->innerJoin('a.Tags t')
            ->groupBy('t.text')
            ->orderBy('broj DESC');

    $this->tagcloud = $query->execute();
    */
  }
}
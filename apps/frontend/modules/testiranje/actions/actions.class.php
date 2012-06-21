<?php

/**
 * testiranje actions.
 *
 * @package    simplenews
 * @subpackage testiranje
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testiranjeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    
   $q = Doctrine_Manager::getInstance()->getCurrentConnection();
   $result = $q->execute("SELECT a.id,a.title,a.text,a.published_at,c.name
    FROM articles a
    INNER JOIN
    (SELECT articles.category_id,MAX(articles.published_at) AS latest FROM
    articles  GROUP BY articles.category_id) b ON
    a.category_id=b.category_id AND a.published_at=b.latest
    INNER JOIN categories c ON a.category_id=c.id");
   
   
    $this->results = $result->fetchAll();

  }



  public function executeJs(sfWebRequest $request)
  {

    
  }
}

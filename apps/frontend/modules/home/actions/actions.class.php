<?php

/**
 * home actions.
 *
 * @package    simplenews
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  
    $articles = ArticlesTable::getInstance();

    $this->articles = $articles->getLatestFromAllCategories();
  }
  
  
  /**
   * Prikazuje stranicu sa clancima iz odabrane kategorije 
   * 
   */
  public function executeCategory(sfWebRequest $request)
  {
   $id = $request->getParameter('id');
   
   $articles = ArticlesTable::getInstance();
 
   $this->articles_category = $articles->getAllFromCategory($id);
    
  }
  
  /**
   * Prikazuje stranicu sa odabranim cijelim clankom
   * 
   */
  public function executeArticle(sfWebRequest $request)
  {
   $id = $request->getParameter('id');

   $articles = ArticlesTable::getInstance();
   
   $this->article = $articles->getOneArticle($id);
   
   $this->num_comments = $articles->countComments($id);
   
   $this->user_id = $this->getUser()->getAttribute('id');

   $articles->articleIncrement($id);
   
   $this->forward404Unless($this->article);
  }

  /**
  * Selecta i prikazuje clanke kojima je pridruzen tag na koji je kliknuto u cloud-u
  */
  public function executeTagresult(sfWebRequest $request)
  {
   $tag = $request->getParameter('tag');

   $articles = ArticlesTable::getInstance();

   $this->tagged_articles = $articles->getTaggedArticles($tag);
   $obj = $this->tagged_articles->getFirst();
   $this->tag = $obj->toArray();

   $this->forward404Unless($this->tagged_articles);
  }
}

<?php

/**
 * comment actions.
 *
 * @package    simplenews
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->h2title = "Va&#353; komentar";
    
    $article_id = $request->getParameter('article'); 
    // selectati clanak
    $articles = ArticlesTable::getInstance();
    $this->article = $articles->find($article_id);
    
    // forma
    $this->form = new sfForm();
    $this->form->setWidgets(array(
    'article_id'    => new sfWidgetFormInputHidden(array('default'=>$article_id)),
    'user_id'    => new sfWidgetFormInputHidden(array('default'=>2)),
    'text' => new sfWidgetFormTextarea(array('label'=>'Komentar'),array('rows' => '5', 'cols' => 55)),
   ));
  
   
   // validatori
   $this->form->setValidators(array(
   
    'article_id'    => new sfValidatorString(array('required'=>false)),
    'user_id'    => new sfValidatorString(array('required'=>false)),
    'text' => new sfValidatorString(array('min_length' => 4))
   ));
  $this->form->getWidgetSchema()->setNameFormat('commentf[%s]');
  
  // Deal with the request
  if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('commentf'));
      if ($this->form->isValid())
      {
      // Handle the form submission
      //$comment_form = $this->form->getValues();
      
      $text = $this->form->getValue('text');
      $article_id = $this->form->getValue('article_id');
      $user_id = $this->form->getValue('user_id');
      // Or to get a specific value
      //$name = $this->form->getValue('name');
 
      // Do stuff
      $comment = new Comments();
      $comment->setText($text);
      $comment->setArticleId($article_id);
      $comment->setUserId($user_id);
      $comment->setPublishedAt('2012-12-14 12:45:00');
      
      $comment->save();
    // ...
    $this->redirect('home/index');
   }
   }
  }
}

<?php

require_once dirname(__FILE__).'/../lib/commentsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/commentsGeneratorHelper.class.php';

/**
 * comments actions.
 *
 * @package    simplenews
 * @subpackage comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentsActions extends autoCommentsActions
{

 protected function buildQuery()
  {
    if($this->getUser()->hasCredential('author')===true)
   {
    return parent::buildQuery()
      ->select('c.id,c.user_id,c.text,c.article_id,c.published_at,c.published')
      ->from('Comments c')
      ->innerJoin('c.Articles a')
      ->innerJoin('c.Users u')
      ->where('a.user_id = ?', $this->getUser()->getAttribute('id'));
   }
  else
   {
    return parent::buildQuery();
   }
  }


 /**
 * Prima Ajaxom postan ID clanka i varijablu published:1/0, kontaktira model funkciju za promjenu 
 * svojstva 'published' comment-a u bazi
 *
 */
 public function executeChangepublished(sfWebRequest $request)
 {
  $comments = CommentsTable::getInstance();

  if ($request->isXmlHttpRequest())
   {
     $comment_id = $request->getParameter('comment_id');
     $published = $request->getParameter('published');
     $c = $comments->updateComment($comment_id,$published);

     return $this->renderText($c);
   }
 }


 /**
* Prima Ajax-om postan ID komentara sa comments liste u backendu, kontaktira metodu u modelu, vraca 
* tekst komentara za prikaz u cjelosti unutar dialogbox-a.
*/
public function executeCompletetext(sfWebRequest $request)
{
  $comments = CommentsTable::getInstance();

  if ($request->isXmlHttpRequest())
  {
    $comment_id = $request->getParameter('comment_id');
    $c = $comments->getOneComment($comment_id);

    return $this->renderText(nl2br('<p>'.$c->getText().'</p>'));
  }
}

}

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

}

<?php

require_once dirname(__FILE__).'/../lib/tagsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tagsGeneratorHelper.class.php';

/**
 * tags actions.
 *
 * @package    simplenews
 * @subpackage tags
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tagsActions extends autoTagsActions
{

  protected function buildQuery()
  {
   if($this->getUser()->hasCredential('author')===true)
   {
    return parent::buildQuery()
     ->from('Tags t')
     ->leftJoin('t.ArticlesTags at')
     ->leftJoin('at.Articles a')
     ->innerJoin('a.Users u')
     ->where('user_id = ?', $this->getUser()->getAttribute('id'));
   }
  else
   {
    return parent::buildQuery();
   }
  }

}

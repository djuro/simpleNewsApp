<?php

require_once dirname(__FILE__).'/../lib/articlesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/articlesGeneratorHelper.class.php';

/**
 * articles actions.
 *
 * @package    simplenews
 * @subpackage articles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articlesActions extends autoArticlesActions
{


 

protected function buildQuery()
{
  if($this->getUser()->hasCredential('author')===true)
   {
    return parent::buildQuery()
      ->where('user_id = ?', $this->getUser()->getAttribute('id'));
   }
  else
   {
    return parent::buildQuery();
   }
}



}






/*
protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }
*/
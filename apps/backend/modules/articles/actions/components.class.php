<?php
 
class articlesComponents extends sfComponents
{
    
  public function executeMainmenu()
  {
    $this->author = $this->getUser()->hasCredential('author');
  }
}
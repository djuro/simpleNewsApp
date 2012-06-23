<?php
 
class articlesComponents extends sfComponents
{
    
  public function executeMainmenu()
  {
    // samo provjeriti ima li user credential 'author', na osnovu toga prikazuje se odgovarajuci menu
    $this->author = $this->getUser()->hasCredential('author');
  }
}
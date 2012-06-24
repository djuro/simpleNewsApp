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


 
/**
*  Selecta clanke koji pripadaju logiranom 'autoru' ili sve clanke ako je korisnik 'editor'
*/
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



public function executeCreate(sfWebRequest $request)
  {
    if ($request->isMethod('post'))
     {
      $this->form = $this->configuration->getForm();
      $this->articles = $this->form->getObject();

      $this->form->bind($request->getParameter('articles'), $request->getFiles('articles'));
      if ($this->form->isValid())
      {
       // Handle the form submission
       $articles = $this->form->getValues();

       $title = $articles['title'];
       $text = $articles['text'];

       // sfValidatedFile radi objekt "od" uploadanog fajla
       $file = $this->form->getValue('photo');

       $filename = 'article_photo_'.sha1($file->getOriginalName());
       $extension = $file->getExtension($file->getOriginalExtension());
       $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
    
       // spremanje clanka
       $artcl = new Articles();
        
       $artcl->setTitle($articles['title']);
       $artcl->setText($articles['text']);
       $artcl->setCategoryId($articles['category_id']);
       $artcl->setUserId($articles['user_id']);
       $artcl->setPhoto($filename);

       // ako je clanak odmah 'objavljen' stavljamo sadasnje vrijeme kao vrijeme objavljivanja
       $published = $articles['published'];

       if($published==1):
        $artcl->setPublished(1);
        $artcl->setPublishedAt(date("Y-m-d g:i:s"));
       else:
        $artcl->setPublished(0);
        $artcl->setPublishedAt(date("0000-00-00 00:00:00"));
       endif;
       
       $artcl->save();
      }

     }

    $this->setTemplate('new');
  }



}

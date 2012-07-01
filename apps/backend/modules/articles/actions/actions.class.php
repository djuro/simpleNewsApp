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


 


public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(array(), array('vrijednost' => "7654321"));
    $this->articles = $this->form->getObject(); 
  }


/**
* Prikazuje formu sa podacima, za edit
*/
public function executeEdit(sfWebRequest $request)
  {
    $this->articles = $this->getRoute()->getObject();
     $tags = $this->articles->getTags();
    $tagstr = "";
    //$tagsarray = array();
    foreach($tags as $t):
      $tagstr = $tagstr.$t->getText().',';
      //$tagsarray[$t->getId()] = $t->getText();
    endforeach;
    $tagstr = trim($tagstr);
    $this->form = $this->configuration->getForm($this->articles,array('val'=>rtrim($tagstr,",")));
  }

/**
*  
*/
 public function executeUpdate(sfWebRequest $request)
  {
    $this->articles = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->articles);

    $this->form->bind($request->getParameter('articles'), $request->getFiles('articles'));
    if ($this->form->isValid())
     {

      $articles = $this->form->getValues();

      $title = $articles['title'];
      $text = $articles['text'];
      

      $category = $articles['category_id'];
      $published = $articles['published'];
      $user = $articles['user_id'];

      $tags = $articles['tags'];

      $file = $this->form->getValue('photo');

       if(is_object($file)):
         $filename = 'article_photo_'.sha1($file->getOriginalName());
         $extension = $file->getExtension($file->getOriginalExtension());
         $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
       else:
         $filename = NULL;
         $extension = NULL;
      endif;
      $photo =  $filename.$extension;

      $article_id = $this->articles->getId();
      
      $tags_array = explode(",",$tags);
      $new_tags = array_map('trim', $tags_array);
      
      $atbl = ArticlesTable::getInstance();
      $atbl->updateArticletotal($title,$text,$category,$published,$user,$photo,$article_id);
      
      //$atbl->deleteAlltags($article_id);

      // kolekcija objekata Tags
      $old_tags_objekti = $this->articles->getTags();
      
      $old_tags = array();
      
      // pretvaranje u array
      foreach($old_tags_objekti as $obj):
        $old_tags[$obj->getId()] = trim($obj->getText());
      endforeach;
      
      // brisanje tagova u articles_tags
      //$atbl->deleteTags($article_id);
      
      $rslt_insert = array_diff($new_tags,$old_tags);
      $rslt_delete = array_diff($old_tags,$new_tags); 

      

      if(count($rslt_insert)>0):
        
        foreach($rslt_insert as $k=>$tag):
        //if($k!='' && $tag!=''):
          $this->articles->Tags[$k]->setText($tag);
        //endif;
        endforeach;

        $this->articles->save();
        
        //$vraceno = $atbl->insertTags($article_id,$rslt_insert);
      endif;
      
    
      
      if(count($rslt_delete)>0):
        $atbl->deleteTags($article_id,$rslt_delete);
      endif;
     }
     /*
     print_r($rslt_insert);
     print_r($rslt_delete);
     */
     
    $this->forward('articles', 'index');
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
        
       
       $articles = $this->form->getValues();

       $title = $articles['title'];
       $text = $articles['text'];
       $newtags = $articles['tags'];

       // sfValidatedFile radi objekt "od" uploadanog fajla
       $file = $this->form->getValue('photo');

       if(is_object($file)):
         $filename = 'article_photo_'.sha1($file->getOriginalName());
         $extension = $file->getExtension($file->getOriginalExtension());
         $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
       else:
         $filename = NULL;
         $extension = NULL;
      endif;

       // spremanje clanka
       $artcl = new Articles();
        
       $artcl->setTitle($articles['title']);
       $artcl->setText($articles['text']);
       $artcl->setCategoryId($articles['category_id']);
       $artcl->setUserId($articles['user_id']);
       $artcl->setPhoto($filename.$extension);

       // ako je clanak odmah 'objavljen' stavljamo sadasnje vrijeme kao vrijeme objavljivanja
       $published = $articles['published'];

       if($published==1):
        $artcl->setPublished(1);
        $artcl->setPublishedAt(date("Y-m-d g:i:s"));
       else:
        $artcl->setPublished(0);
        $artcl->setPublishedAt(date("0000-00-00 00:00:00"));
       endif;

       // spremanje tagova
       $tags = new Tags();

       $tags_array=explode(",",$newtags);
       
       //$i=0;
       foreach($tags_array as $k=>$v):
        $artcl->Tags[$k]->setText($v);
       endforeach;

       
       $artcl->save();
       
      }

     }

    $this->setTemplate('new');
  }


public function executeDelete(sfWebRequest $request)
{
  $article = $this->getRoute()->getObject();

  //echo $article->getTitle();

  $atags_tbl = ArticlesTagsTable::getInstance();
  
  $article_id = $article->getId();
  $q_at = $atags_tbl->createQuery()
               ->delete('ArticlesTags at')
               ->where('at.articles_id=?',$article_id);
  $q_at->execute();
  
  $articles = ArticlesTable::getInstance();

  $q_a = $articles->createQuery()
                  ->delete('Articles a')
                  ->where('a.id=?',$article_id);
  $q_a->execute();   

  $this->forward('articles', 'index');        

}

/**
* Prima Ajax-om postan ID clanka sa articles liste u backendu, kontaktira metodu u modelu, vraca 
* naslov i tekst clanka za prikaz u cjelosti unutar dialogbox-a.
*/
public function executeCompletetext(sfWebRequest $request)
{
  $articles = ArticlesTable::getInstance();

  if ($request->isXmlHttpRequest())
  {
    $artcl_id = $request->getParameter('artcl_id');
    $a = $articles->getOneArticle($artcl_id);

    return $this->renderText(nl2br('<h2>'.$a->getTitle().'</h2><p>'.$a->getText().'</p>'));
  }
}

/**
* Prima Ajaxom postan ID clanka i varijablu published:1/0, kontaktira model funkciju za promjenu statusa clanka u bazi
*
*/
public function executeChangepublished(sfWebRequest $request)
{
 $articles = ArticlesTable::getInstance();

 if ($request->isXmlHttpRequest())
  {
    $article_id = $request->getParameter('article_id');
    $published = $request->getParameter('published');
    $a = $articles->updateArticle($article_id,$published);

    return $this->renderText($a);
  }
}




}

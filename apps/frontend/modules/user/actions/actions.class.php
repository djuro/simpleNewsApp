<?php

/**
 * user actions.
 *
 * @package    simplenews
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
     $this->form = new sfForm();
     $this->form->setWidgets(array(
      'nickname'    => new sfWidgetFormInputText(),
      'email'   => new sfWidgetFormInput(),
     ));
    
     $this->form->setValidators(array(
      'nickname'    => new sfValidatorString(),
      'email'   => new sfValidatorEmail(),
     ));

     $this->form->getWidgetSchema()->setNameFormat('newuser[%s]');
     
	 if ($request->isMethod('post'))
     {
      $this->form->bind($request->getParameter('newuser'));
      if ($this->form->isValid())
      {
        // Handle the form submission
        $newuser = $this->form->getValues();
        $nickname = $newuser['nickname'];
 
        
        $email = $newuser['email'];
        $password = UsersTable::getInstance()->createPassword();
        $user = new Users();
        
        $user->setUsername($email);
        $user->setEmail($email);
		    $user->setPassword(sha1($password));
		    $user->setRoleId(3);
		    $user->setActive(1);
		    $user->setNickname($nickname);
     
        $user->save();

        UsersTable::getInstance()->sendEmail($nickname,$email,$password);
      }
     }
   }
   
   
   /**
    * Prikazuje formu za login korisnika,
    * dodjeljuje credential i preusmjerava korisnika dalje
    *  
    */
   public function executeLogin(sfWebRequest $request)
   {
   
    $this->form = new sfForm();
    $this->form->setWidgets(array(
      'username'    => new sfWidgetFormInputText(),
      'password'   => new sfWidgetFormInputPassword(),
      ));
    
    $this->form->setValidators(array(
      'username'    => new sfValidatorString(),
      'password'   => new sfValidatorString(),
      ));
    
    $this->form->getWidgetSchema()->setNameFormat('loginuser[%s]');
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('loginuser'));
      if ($this->form->isValid())
      {
        // Handle the form submission
        $loginuser = $this->form->getValues();
        
        $c = new sfContext();
        
        $username = $loginuser['username'];
 
        $password = $loginuser['password'];
 
        $user = UsersTable::GetInstance();
        
        $user_data = $user->verifyUser($username,$password);
  
        if($user_data[0]===true)
         {
          $this->getUser()->setAuthenticated(true);
          $this->getUser()->setAttribute("id",$user_data[2]);
          $this->getUser()->addCredential($user_data[3]);
          $this->getUser()->setAttribute("user_name",$user_data[4]);
          $this->getUser()->setAttribute("user_surname",$user_data[5]);
          $this->getUser()->setAttribute("user_nickname",$user_data[6]);
          
          // preusmjeriti korisnika na odgovarajucu akciju
          switch($user_data[3])
           {
            case 'editor':
             $this->redirect('http://localhost/sfproject/web/backend_dev.php/articles');
            break;
            
            case 'author':
             $this->redirect('http://localhost/sfproject/web/backend_dev.php/articles');
            break;
            
            case 'anonymous':
             $this->forward('home', 'index');
            break;
           }
         }
       }
      
     }
    
   }
   
   /**
    * Odjavljuje korisnika (brise atribute i credentials)
    *  
    */
   public function executeLogout(sfWebRequest $request)
   {
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->clearCredentials();
    $this->getUser()->getAttributeHolder()->clear();
    $this->forward('home', 'index');
   }

}

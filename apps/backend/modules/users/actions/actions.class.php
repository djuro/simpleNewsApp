<?php

require_once dirname(__FILE__).'/../lib/usersGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usersGeneratorHelper.class.php';

/**
 * users actions.
 *
 * @package    simplenews
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends autoUsersActions
{


/**
* Override metode za spremanje podataka novog korisnika zbog potrebe za sha1() password stringa
*
*/

   public function executeCreate(sfWebRequest $request)
   {
    $this->form = $this->configuration->getForm();
    $this->users = $this->form->getObject();

    $this->form->bind($request->getParameter('users'));
      if ($this->form->isValid())
      {
        
       $user = new Users();
       
       $usr = $this->form->getValues();
       
       $user->setRoleId($usr['role_id']);
       $user->setUsername($usr['username']);
       $user->setPassword(sha1($usr['password']));
       $user->setActive($usr['active']);
       $user->setName($usr['name']);
       $user->setSurname($usr['surname']);
       $user->setEmail($usr['email']);
       $user->setNickname($usr['nickname']);

       $user->save();
      } 

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    $this->setTemplate('index');
   }


/**
* Override metode za prikaz forme za preuredjivanje jer treba polje passworda set-ati na ''
*
*/

   public function executeEdit(sfWebRequest $request)
   {
    $this->users = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->users);

    $this->form->getWidget('password')->setAttribute('value', '');
    $this->form->setValidator('password', new sfValidatorPass());
    
   }

/**
* Override metode za spremanje korisnikovih podataka
*
*/
   
   public function executeUpdate(sfWebRequest $request)
   {
    $this->users = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->users);

    $this->form->getWidget('password')->setAttribute('value', '');
    unset($this->form['password']);
    $this->form->setValidator('password', new sfValidatorPass());

    $this->form->bind($request->getParameter('users'));

    if ($this->form->isValid())
    {
     $users = UsersTable::getInstance();

     $users->updateUserdata($this->users->getId(),$this->form->getValues());
    }
    
    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    $this->setTemplate('index');
   }
}

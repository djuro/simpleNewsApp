<?php

/**
 * UsersTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UsersTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UsersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Users');
    }
    
    
    /**
     *  'Selecta' korisnika na osnovu username-a, provjerava je li aktivan, 
     *   provjerava password i vraca array ako su uvjeti ispunjeni
     */
    public function verifyUser($username,$password)
    {
     $user_result = $this->createQuery("usr")
                 ->select("usr.username,usr.name,usr.surname,usr.password,usr.id,r.name,usr.active")
                 ->innerJoin("usr.Roles r")
				         ->where("usr.username=?",$username)
                 ->fetchOne();

     if (is_object($user_result)) 
     {
      $usrnm = $user_result->getUsername();
      $active = $user_result->getActive();

      // provjera postoji li  dati username i da li je taj user aktivan
      if(!empty($usrnm) && $active==1)
       {

        // user je aktivan, provjera passworda
        if(sha1($password)==$user_result->getPassword())
         {
          
          return array(
                       true,
                       $usrnm,
                       $user_result->getId(),
                       $user_result->getRoles()->getName(),
                       $user_result->getName(),
                       $user_result->getSurname(),
                       $user_result->getNickname(),
                      );
         }
        else
         {
          return array(false,false,false,false);
         }
       }
      else
       {
        return array(false,false,false,false);
       }    
     }
   
    }
    
    
    /**
     * 'Slaze' random password od slucajnih brojeva, za novog anonimnog korisnika 
     * 
     */
    public function createPassword()
    {
     $brojA = rand(0,1000);
     $brojB = rand(0,1000);
     
     $passwd = $brojA.$brojB;
     return $passwd;
    }


    /**
    * 
    * Radi update preuredjenih korisnikovih podataka
    */
    public function updateUserData($id,$data)
    {

      $passwd = $data['password'];
      
      if($passwd !=''):
        $q = $this->createQuery()
                  ->update('Users')
                  ->set('role_id','?',$data['role_id'])
                  ->set('username','?',$data['username'])
                  ->set('password','?',sha1($data['password']))
                  ->set('name','?',$data['name'])
                  ->set('surname','?',$data['surname'])
                  ->set('active','?',$data['active'])
                  ->set('email','?',$data['email'])
                  ->set('nickname','?',$data['nickname'])
                  ->where('id=?',$id);
      else:
        $q = $this->createQuery()
                  ->update('Users')
                  ->set('role_id','?',$data['role_id'])
                  ->set('username','?',$data['username'])
                  ->set('name','?',$data['name'])
                  ->set('surname','?',$data['surname'])
                  ->set('active','?',$data['active'])
                  ->set('email','?',$data['email'])
                  ->set('nickname','?',$data['nickname'])
                  ->where('id=?',$id);
      endif;

      $q->execute();
    }


    /**
    * Salje mail koji sadrzi password, novom registriranom korisniku
    */
    public function sendEmail($nick,$email,$passwd)
    {
      $mailer = sfContext::getInstance()->getMailer();

      $mailer->composeAndSend(
              'djuro.mandinic@gmail.com',
               $email,
              'Welcome to SimpleNews',
              'Hello '.$nick.',  Your account password is: '.$passwd);
    }

}
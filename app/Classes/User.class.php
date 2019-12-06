<?php

//User Klasse
class User
{
    
    private $fullname;
    private $email;  
    private $password;
     
    public function __construct($fullname, $email, $password )
    {
        $this->fullname = $fullname;       
        $this->email = $email;  
        $this->password = $password;
        
        $this->saveUser();
    }    
   
    /*saveUser() - erstellt neues Database Objekt und übergibt die eingegebene Emailaddresse. in der Database Klasse wird checkMail() aufgerufen.
    Es wird geprüft, ob die Email bereits in der Datenbank vorhanden ist. Falls nicht, wird registerUser() in der Datenbankklasse aufgerufen und die eingegebenen User Daten übergeben.
    Ein neuer User wird in der Datenbank angelegt.*/
    public function saveUser()
    {
        $db = new Database($this->email);
              
        if($db->checkMail())
        {
            //return false;
            echo 'This email is already registered';    
        }
        else
        {
            $db->registerUser($this->fullname, $this->email, $this->password);
            //return true;
            echo 'You have been successfully registered';    
        } 
    }
}

 
        
        


    
    
    
    
    
    
    
    
    
    


    


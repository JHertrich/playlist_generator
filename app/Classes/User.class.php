<?php
/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//USER CLASS
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
   
    /*saveUser() - CHECKS, IF EMAIL ALREADY EXISTS (checkMail() in Database.class.php
    IF EMAIL NOT TAKEN, USER IS SAVED TO DATABASE
    */
    public function saveUser()
    {
        $db = new Database($this->email);
              
        if($db->checkMail())
        {
            echo 'This email is already registered';    
        }
        else
        {
            $db->registerUser($this->fullname, $this->email, $this->password);
            echo 'You have been successfully registered';    
        } 
    }
}

 
        
        


    
    
    
    
    
    
    
    
    
    


    


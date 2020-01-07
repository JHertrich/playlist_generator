<?php 

/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//LOGIN HANDLER (VALIDATION)

session_start();

include 'Classes/Database.class.php';


try{
    //STORING LOGIN FORM DATA TO VARIABLES
    
    if(isset($_POST['email']))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];        
    };   

    
    //VALIDATION OF THE DATA AND ERROR MESSAGES
    if(empty($email) or empty($password))
    {
        echo 'all fields required';
    }  

    elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    {
      echo 'Please enter a valid email'; 
    }

    else
    {
        $db = new Database($email);

        if(!$db->checkMail())
        {
            echo 'You are not registered yet';
            exit;
        }

        elseif(!password_verify($password, $db->getPassword()))
        {
            echo "Incorrect Password";
            exit;
        }
        
        //IF DATA OK, USER GETS LOGGED IN AND SENT BACK TO index.php
        else
        {
            echo 'You are logged in now' . '<br>';  
            $_SESSION['user'] = $db->getUser();
            header("Location: http://localhost:8080/projects/playlist_generator%202/public/index.php");
            
        }  
    }
}   
//CATCH DATABASE CONNECTION ERRORS IN PDOException 
catch (PDOException $e) 
{
    $errNo = $e->getCode();
    $errMsg = $e->getMessage();
    $errArray = $e->errorInfo;
    echo 'Server connection failed. Please try again later';   
}  
   

?>
            



       
        
        
    

    


 

   
    
    



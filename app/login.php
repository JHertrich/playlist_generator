<?php 
session_start();
//ini_set('session.cookie_secure', '0');

include 'Classes/Database.class.php';


try{
    //Übergabe der Formular Eingaben in Variablen
    
    if(isset($_POST['email']))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];        
    };   

    
    //Überprüfung, ob User Eingaben gültig. 

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
    
        else
        {
            echo 'You are logged in now' . '<br>';  
            $_SESSION['user'] = $db->getUser();
            header("Location: http://localhost:8080/projects/playlist_generator%202/public/index.php");
            
        }  
    }
}   
            
            
//falls der Datenbankzugriff, bzw die sql queries in der Database Klasse fehlerhaft sind, wird hier die PDO Exception "gefangen"  
catch (PDOException $e) 
{
    $errNo = $e->getCode();
    $errMsg = $e->getMessage();
    $errArray = $e->errorInfo;
    echo 'Server connection failed. Please try again later';   
}  
   

?>
            



       
        
        
    

    


 

   
    
    



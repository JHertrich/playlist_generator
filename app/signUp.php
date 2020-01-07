<?php  
/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//SIGNUP HANDLER - VALIDATION OF DATA FROM SIGNUP FORM

include 'Classes/Database.class.php';
include 'Classes/User.class.php' ;


try{
    //STORE SIGNUP FORM DATA IN VARIABLES 
    
    if(isset($_POST['fullname']))
    {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConf = $_POST["passwordConf"];

    };   
    

    //VALIDATION OF THE DATA AND ERROR MESSAGES 

    if(empty($fullname) or empty($email) or empty($password))
    {
        echo 'all fields required';
    }  

    //Check Email
    elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    {
      echo 'Please enter a valid email'; 
    }

    elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
        echo 'the password does not meet the requirements!';
    }

    elseif($password != $passwordConf)
    {
       echo "Passwords don't match";    
    }

    
    // IF DATA OK, A NEW USER OBJECT IS INSTANTIATED
    else
    {
        $hashedPw = password_hash($password, PASSWORD_DEFAULT); 
        $usr = new User($fullname, $email, $hashedPw); 
    }
}   


//CATCH DATABASE CONNECTION ERRORS IN PDOException 
catch (PDOException $e) 
{
    $errNo = $e->getCode();
    $errMsg = $e->getMessage();
    $errArray = $e->errorInfo;
    echo $errMsg;
    echo 'Connection failed. Please try again later';   
}  

 

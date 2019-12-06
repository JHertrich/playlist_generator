<?php  

//hier werden die beiden benötigten Klassen inkludiert
include 'Classes/Database.class.php';
include 'Classes/User.class.php' ;


try{
    //Übergabe der Formular Eingaben in Variablen
    
    if(isset($_POST['fullname']))
    {
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConf = $_POST["passwordConf"];

    };   
    

    //Überprüfung, ob User Eingaben gültig. 

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

    
    //Falls alle Angaben korrekt, wird ein User Objekt angelegt. Falls die saveUser funktion False zurückgibt, wird ein error an signUp_form in der querystring geschickt
    //Falls saveUser true, wird wird ein success an signUp_form in der querystring geschickt
    else
    {
        $hashedPw = password_hash($password, PASSWORD_DEFAULT); 
        $usr = new User($fullname, $email, $hashedPw); 
    }
}   


//falls der Datenbankzugriff, bzw die sql queries in der Database Klasse fehlerhaft sind, wird hier die PDO Exception "gefangen"  
catch (PDOException $e) 
{
    $errNo = $e->getCode();
    $errMsg = $e->getMessage();
    $errArray = $e->errorInfo;
    echo $errMsg;
    echo 'Connection failed. Please try again later';   
}  

 

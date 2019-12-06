<?php

//Database Klasse

class Database
{
    private $host ;
    private $user ;
    private $pass ;
    private $dbname ;
    private $dsn ;
    private $email ;

    private $pdo ;


    public function __construct($email)
    {
        $this->host = '127.0.0.1';
        $this->user = 'root';
        $this->pass = '';
        $this->dbname = 'playlists';
        $this->dsn = 'mysql:host=' .$this->host . ';dbname=' . $this->dbname; 
        $this->email = $email;

        $this->connect();
    }

    //Verbindung mit der SQL Datenbank
    
    public function connect()
    {
        
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    }
        
     
    //checkMail() - gibt Anzahl rows zurück, bei der die Emailaddresse mit der im HTML Formular eingegebenen Emailaddresse übereinstimmt
    public function checkMail()
    { 
        $sql = "SELECT COUNT(*) FROM t_user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $found = $stmt->fetchColumn();
        return $found;
    }
        
        
    //registerUser() - fügt Userdaten in die Datenbank ein
    
    public function registerUser($fn, $email, $pw)
    { 
        $sql = "INSERT INTO t_user (fullname, email, pw) VALUES (:fullname, :email, :pw)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['fullname'=>$fn, 'email'=>$email, 'pw'=>$pw]);
        return true;
    }

    //get Password() - For Login - check if Pw is correct
    public function getPassword()
    {
        $sql = "SELECT * FROM t_user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        
        $row = $stmt->fetch();
        $storedPw = $row->pw;
        return $storedPw;
    }
}
    


        


     
     
    
             




  
     
    
       


    

         










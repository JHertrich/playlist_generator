<?php
/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//DATABASE CLASS

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

    //CONNECTION TO MariaDB DATABASE USING PDO
    
    public function connect()
    {
        
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
    }
        
     
    //checkMail() - CHECKS IF EMAIL ALREADY EXISTS IN DATABASE 
    public function checkMail()
    { 
        $sql = "SELECT COUNT(*) FROM t_user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        $found = $stmt->fetchColumn();
        return $found;
    }
        
        
    //registerUser() - SAVES USER DATA TO DATABASE
    
    public function registerUser($fn, $email, $pw)
    { 
        $sql = "INSERT INTO t_user (fullname, email, pw) VALUES (:fullname, :email, :pw)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['fullname'=>$fn, 'email'=>$email, 'pw'=>$pw]);
        return true;
    }

    //get Password() - GETS THE STORED PASSWORD WHEN USER LOGS IN TO CHECK IF THE PASSWORD IS CORRECT
    public function getPassword()
    {
        $sql = "SELECT * FROM t_user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        
        $row = $stmt->fetch();
        $storedPw = $row->pw;
        return $storedPw;
    }

    //GETS THE USER ID OF THE LOGGED IN USER
    public function getUser(){
        $sql = "SELECT * FROM t_user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->email]);
        
        $row = $stmt->fetch();
        $userId = $row->user_id;
        return $userId;
    }

    //SAVES ARTIST DATA TO DATABASE AND RETURNS ARTIST ID
    public function saveArtist($artistName)
    { 
        $sql = "INSERT IGNORE INTO interpret (int_name) VALUES (:int_name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['int_name'=>$artistName]);
        
       if($this->pdo->lastInsertId()){
            return $this->pdo->lastInsertId();
        }
        else{
             $sql2 = "SELECT * FROM interpret WHERE int_name = '$artistName'"; 
             
             foreach($this->pdo->query($sql2) as $row){
                 return $row->int_id;
             }
         }   
     }
            
    //SAVES SONG DATA TO DATABASE AND RETURNS SONG ID   
    public function saveSong($artistId, $trackName)
    { 
        $sql = "INSERT IGNORE INTO song (int_id, song_titel) VALUES (:int_id, :song_titel)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['int_id'=>$artistId, 'song_titel'=>$trackName]);

        if($this->pdo->lastInsertId()){
            return $this->pdo->lastInsertId();
        }
        else{
             $sql2 = "SELECT * FROM song WHERE song_titel = '$trackName'"; 
             
             foreach($this->pdo->query($sql2) as $row){
                 return $row->song_id;
            }
        }   
    }
            
    //SAVES PLAYLIST DATA TO DATABASE AND RETURNS PLAYLIST ID   
    public function savePlaylist($userLoggedIn, $playlistName)
    { 
        $sql = "INSERT IGNORE INTO playlist (user_id, pl_name) VALUES (:user_id, :pl_name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id'=>$userLoggedIn, 'pl_name'=>$playlistName]);

        return $this->pdo->lastInsertId();
    }

    //SAVES SONGS IN PLAYLIST DATA TO DATABASE
    public function saveSongsInPlaylist($songId, $playlistId, $songPosition)
    { 
        $sql = "INSERT INTO so_in_pl (song_id, pl_id, song_pos) VALUES (:song_id, :pl_id, :song_pos)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['song_id'=>$songId, 'pl_id'=>$playlistId, 'song_pos'=>$songPosition]);
    }
}

        
        
        
    


        


     
     
    
             




  
     
    
       


    

         










<?php
/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/08/2020
*/

include 'Classes/Database.class.php';

try{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        //RECEIVE THE RAW POST DATA FROM main.js
        $content = file_get_contents("php://input");
    
        //Decode the incoming RAW post data from JSON
        $array = json_decode($content, true);

       //SAVING POST DATA IN VARIABLES
        $artists = $array['artists'];
        $tracks = $array['tracks'];
        $playlistName = $array['name'];
        $userLoggedIn = $array['user'];
  
        //SAVING POST DATA IN RESPECTIVE DATABASE TABLES (USING THE DATABASE CLASS)
        $db = new Database('');  

        $playlistId = $db->savePlaylist($userLoggedIn, $playlistName);

        for($i=0; $i<count($artists); $i++){

            $songPosition = $i +1;
                     
            $artistId = $db->saveArtist($artists[$i][0]);
            $songId = $db->saveSong($artistId, $tracks[$i][0]);

            $db->saveSongsInPlaylist($songId, $playlistId, $songPosition);
                        
        }

    }
           
    else{
        throw new Exception( "no json data received");
    }
}
catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
            
    
        

        
        
      
           


           

   
   
   
            
            





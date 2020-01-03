<?php
include 'Classes/Artist.class.php';
include 'Classes/Song.class.php';
include 'Classes/Playlist.class.php';
include 'Classes/Database.class.php';

try{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        //Receive the RAW post data.
        $content = file_get_contents("php://input");
    
        //Attempt to decode the incoming RAW post data from JSON.
        $array = json_decode($content, true);


        foreach($array as $key => $value){
            foreach($value as $values){
                $data[] = $values[0];
            }
        }

        $artists = array_slice($data, 0,20);
        $tracks = array_slice($data, 20, 40);


        for($i=0; $i<count($artists); $i++){
           $artist = new Artist($artists[$i]);
           echo $artistId;

           die('first Artist inserted');
           
        }
    }
        

        
    else{
        throw new Exception( "no json data received");
    }
}
catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
        
      
           
            
            





<?php

include 'Classes/Database.class.php';

try{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        //Receive the RAW post data.
        $content = file_get_contents("php://input");
    
        //Attempt to decode the incoming RAW post data from JSON.
        $array = json_decode($content, true);
    
    

        /*
        foreach($array as $key => $value){
            foreach($value as $values){
                $data[] = $values[0];
            }
        }
        $artists = array_slice($data, 0, 20);
        $tracks = array_slice($data, 20, 40);
        $playlistName = ['name'];

         */
       
        $artists = $array['artists'];
        $tracks = $array['tracks'];
        $playlistName = ['name'];



        $db = new Database('');  


        for($i=0; $i<count($artists); $i++){

           $artistId = $db->saveArtist($artists[$i][0]);
           $db->saveSong($artistId, $tracks[$i][0]);
           
           die('first Artist and Song inserted');

        }

    }
           


    else{
        throw new Exception( "no json data received");
    }
}
catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
        

        
        
      
           


           

   
   
   
            
            





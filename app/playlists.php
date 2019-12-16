<?php

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

        print_r($tracks);
                

        
    }
    else{
        throw new Exception( "no json data received");
    }
}
catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
        





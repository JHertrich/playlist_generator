<?php

class Artist {
    private $artistName;
    private $artistId;


    public function __construct($artist)
    {
        $this->artistName = $artist;       
              
        $db = new Database('');
        $this->artistId = $db->saveArtist($this->artistName); 
        //get this private attribute...  
    }
        
}
        

                  
            
       
        
      
    
    

<?php

class Song {
    private $artist;
    private $songtitle;

    public function __construct($artist, $songtitle)
    {
        $this->artist = $artist;       
        $this->songtitle = $songtitle;  
              
        $this->saveSong();
    }    

    public function saveSong(){

    }
    
}
    


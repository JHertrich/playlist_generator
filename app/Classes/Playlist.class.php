<?php

// Playlist Class
class Playlist
{
    private $userId;
    private $playlistName;

    public function __construct($userId, $playlistName){
        $this->userId = $userId;
        $this->playlistName = $playlistName;
    }
    
}
    
    
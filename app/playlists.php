<?php

if(isset($_POST['artists'])){
    $artists = json_decode($_POST['artists']);
    $tracks = json_decode($_POST['tracks']);
    
    echo $artists;
    echo $tracks;
}
else{
    echo 'Data not received';
}



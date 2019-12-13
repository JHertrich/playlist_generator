<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    print_r($_POST);
    //$json = json_decode($_POST['artist']);
    

}
else{
    echo "no data";
}
  




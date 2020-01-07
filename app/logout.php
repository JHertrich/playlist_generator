<?php

/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//LOGOUT HANDLER - DESTROYS SESSION AND SENDS USER BACK TO index.php
session_start();
session_destroy();

header('Location: http://localhost:8080/projects/playlist_generator%202/public/index.php')

?>
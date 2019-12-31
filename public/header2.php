<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Playlist generator</title>

</head>

<body>
    <div class="container">

        <header id="header">
            <div class="logo">
                <img class="logo-img" src="#" alt="">
                <div class="logo-text">Playlist generator</div>
            </div>
            <nav>
                <div class="stored-playlists">
                    <a href="#" class="your-playlists">Your playlists</a>
                    <!--only accessible if logged in-->
                </div>
               
                <div class="spotify-connect">
                    <img src="#" alt="" class="spotify-logo">
                    <a class="connect-link" href="#">Connect to Spotify</a>
                    <!--signs up to spotify-->
                </div>
                <div class="logout">
                    <a href="../app/logout.php" class="logout-link">logout</a>
                    <!--sends to Login/signup page-->
                </div>
            </nav>
        </header>
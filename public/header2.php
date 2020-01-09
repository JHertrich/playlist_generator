<!--
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020

HEADER2 FOR index.php -> SHOWN IF USER LOGGED IN
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Playlist generator</title>
    <script type="text/javascript">
    var userId = <?php echo $userid;?>;
    </script>
</head>

<body>
    <div class="container">

        <header id="header">
            <div class="logo">
                <img class="logo-img" src="#" alt="">
                <div class="logo-text">Playlist generator</div>
            </div>
            <nav>
                <!--
                <div class="stored-playlists">
                    <a href="#" class="your-playlists">Your playlists</a>
                </div>
                only accessible if logged in-->    
               <!--
                <div class="spotify-connect">
                    <img src="#" alt="" class="spotify-logo">
                    <a class="connect-link" href="#">Connect to Spotify</a>
                </div>
                signs up to spotify, only accessible if logged in-->    
                <div class="logout">
                    <a href="../app/logout.php" class="logout-link">logout</a>
                    <!--sends to Logout page, if logged in-->
                </div>
            </nav>
        </header>
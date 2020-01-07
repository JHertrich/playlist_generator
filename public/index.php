<!--
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020

Index.php -> MAIN SITE
-->

<?php
//CHECKS IF PHP SESSION (IF USER IS LOGGED IN) -> SHOWS RESPECTIVE HEADER 

session_start();

if(!isset($_SESSION['user'])){
    include 'header1.php';
}

else{
    $userid = $_SESSION['user'];
    include 'header2.php';   
}
?>

        <section class="main-section">
            <div class="image-section">
                <img src="#" alt="" class="main-img">
            </div>
            <div class="song-section">
                <h1 class="title">Auto-generate your personal playlist</h1>
                <p class="subtitle">Playlist generator will create
                    a playlist for you, that is based on the most popular tracks of similar artists.</p>
                <form class="artist-selection" action="#">
                    <label for="song-input">Pick an artist</label>
                    <input class="artist-input" type="text" name="artist-input" placeholder="Your artist">
                    <input class="search-btn" type="button" value="Search">
                </form>
            </div>
        </section>


        <section class="playlist-showcase">
            <div class="generated-playlist">
                <!--this where the generated playlist and preview buttons should show up-->
                <ul class="new-playlist"></ul>
            </div>
            <div class="save-section">
                <div class="save-here">
                    <button class="save" type="submit">Save here</button>
                </div>
                <div class="add-to-spotify">
                    <button class="add" type="submit">Add to spotify</button>
                </div>
                <div class="save-error"></div>
            </div>
            <div class="login-to-save">
                <a href="signup_login.php"><button class="login-to-save-btn">Login to save playlists</button></a>
            </div>
        </section>
    </div>
            
    <footer id="footer">
        <div class="footer-container">
            <div class="contact">
                <h3>Contact us</h3>
                <p class="email">PlaylistGen@email.com</p>
            </div>

            <div class="social-links">
                <ul>
                    <li class="facebook"><a href="#"><img class="fb-icon src="" alt="">Facebook</a></li>
                    <li class=" twitter"><a href="#"><img class="tw-icon src="" alt="">Twitter</a></li>
                    <li class=" instagram"><a href="#"><img class="inst-icon src="" alt="">Instagram</a></li>
                </ul>
            </div>   
    </div>
    </footer>

   <script src=" https://code.jquery.com/jquery-3.4.1.min.js"></script> 
   <script src=" js/bundle.js"></script>

</body>

</html>



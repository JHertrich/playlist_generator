<!DOCTYPE html>

<html>

<head>
    <title>signup/login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup_login.css">
</head>

<body>
    <div class="container-main">
        <header id="header">
            <div class="logo">
                <img class="logo-img" src="#" alt="">
                <div class="logo-text">Playlist generator</div>
            </div>
            <nav>
                <div class="spotify-connect">
                    <img src="#" alt="" class="spotify-logo">
                    <a class="connect-link" href="#">Connect to Spotify</a>
                    <!--signs up to spotify-->
                </div>
            </nav>
        </header>

        <div class="container-back">
            <div class="login-selection">
                <h1>Already </br> registered?</h1>
                <button class="login-selector">LOGIN</button>
            </div>
            <div class="singup-selection">
                <h1>Do you have </br> an account?</h1>
                <button class="signup-selector">SIGN UP</button>
            </div>
        </div>
        <div class="container-form">
            <form action="#" class="login-form">
                <h2>Login</h2>
                <input type="text" class="email" name="email" placeholder="Email">
                <input type="password" class="password" name="password" placeholder="Password">
                <input type="submit" id="login-submit" value="Login">
            </form>
            <form action="#" class="signup-form">
                <h2>Sign Up</h2>
                <input type="text" class="fullname" name="fullname" placeholder="Fullname">
                <input type="text" class="email" name="email" placeholder="Email">
                <input type="password" id="password" class="password" name="password" placeholder="Password">
                <input type="password" class="passwordConf" name="passwordConf" placeholder="Confirm Password">
                <input type="submit" id="signup-submit" value="Sign Up">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script src="js/signup_login.js"></script>
</body>

</html>
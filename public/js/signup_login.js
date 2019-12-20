//VALIDATION PLUGIN ON LOGIN FORM AND AJAX
$(".login-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            email: "Please enter a valid email address"
        }
    },
    //SHAKE EFFECT IF ERROR
    invalidHandler: function (form, validator) {
        $('form').effect("shake");
    },


    //AJAX LOGIN POST
    submitHandler: function (form) {

        $.ajax({

            url: "http://localhost:8080/projects/playlist_generator%202/app/login.php",
            method: "POST",
            async: true,
            data: $(".login-form").serialize(),


            // diese Funktion wird ausgeführt wenn der HTTPRequest erfolgreich war
            success: function (response) {

                $(".login-form").children().hide();
                $(".login-form").prepend("<h3>" + response + "<h3>");
                window.location.assign('http://localhost:8080/projects/playlist_generator%202/public/index.php');
            }
        });
    }
});




//VALIDATION PLUGIN ON SIGN UP FORM AND AJAX 
$(".signup-form").validate({
    rules: {
        fullname: "required",
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        },
        passwordConf: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            email: "Please enter a valid email address"
        }
    },
    //SHAKE EFFECT IF ERROR
    invalidHandler: function (form, validator) {
        $(".signup-form").effect("shake");
    },
    //AJAX SIGNUP POST  
    submitHandler: function (form) {

        $.ajax({

            url: "http://localhost:8080/projects/playlist_generator%202/app/signUp.php",
            method: "POST",
            async: true,
            data: $(".signup-form").serialize(),


            // diese Funktion wird ausgeführt wenn der HTTPRequest erfolgreich war
            success: function (response) {

                $(".signup-form").children().hide();
                $(".signup-form").prepend("<h3>" + response + "<h3>");
            }
        });
    }
});


//FORM ANIMATIONS
$(".login-selector").click(function () {
    $(".login-form").animate({
        left: "5vw",
        opacity: 1
    }, 200).css("z-index", 5).children().removeClass("error"); //REMOVING ERROR CLASS
    //REMOVING THE ERROR LABELS
    $("label").hide();

    $(".signup-form").animate({
        left: "5vw",
        opacity: 0
    }, 200);
});


$(".signup-selector").click(function () {
    $(".login-form").animate({
        left: "43vw",
        opacity: 0
    }, 200).css("z-index", -1);

    $(".signup-form").animate({
        left: "43vw",
        opacity: 1
    }, 200).css("z-index", 1).children().removeClass("error"); //REMOVING ERROR CLASS
    //REMOVING THE ERROR LABELS
    $("label").css("display", "none");
});




































































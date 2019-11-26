$(document).ready(function () {
    // Check if user has been SESSION
    $.ajax({
        type: "get",
        url: "http://teymurufaz.alwaysdata.net/BWP/hw_project/php/ajax.php",
        data: "issignedup",
        success: function (response) {
            if(response == 1){
                // TODO: window.location = "home.php"
            }
        }
    });

    // sign in
    $("#signin-button").click(function (e) { 
        e.preventDefault();
        var email = $("#emailSignIn").val().trim();
        var password = $("#passwordSignIn").val().trim();
        if(email != "" && password != ""){
            $.ajax({
                type: "post",
                url: "http://teymurufaz.alwaysdata.net/BWP/hw_project/php/ajax.php",
                data: {email:email, password:password},
                success: function (response) {
                    if(response == 1){
                        // TODO: window.location = "home.php"
                    }else{
                        $("#signin-msg").text("Invalid email or password");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    $("#signin-msg").text("Something went wrong. Please try again later!");
                }
            });
        }
    
    });

    //register
    $("#register-button").click(function (e) { 
        e.preventDefault();
        var firstname = $("#registerFirstName").val().trim();
        var lastname = $("#registerLastName").val().trim();
        var email = $("#registerEmail").val().trim();
        var password = $("#registerPass").val().trim();

        if(firstname != "" && lastname != "" && email != "" && password != ""){
            $.ajax({
                type: "post",
                url: "http://teymurufaz.alwaysdata.net/BWP/hw_project/php/ajax.php",
                data: {uniqueemail:email},
                success: function (response) {
                    if(response == 1){
                        $.ajax({
                            type: "post",
                            url: "http://teymurufaz.alwaysdata.net/BWP/hw_project/php/register.php",
                            data: {firstname:firstname, lastname:lastname, email:email, password:password},
                            success: function (response) {
                                // TODO: window.location = "home.php"
                            },
                            error: function (jqXhr, textStatus, errorMessage) {
                                $("#register-msg").text("Something went wrong. Please try again later!");
                            }
                        });
                    }else if(response == 0){
                        $("#register-msg").text("This email is already taken!");
                    }else{
                        $("#register-msg").text("Something went wrong. Please try again later!-1");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    $("#register-msg").text("Something went wrong. Please try again later!noconn");
                }
            });
        }
    });

    // Register Validity Checks
    $("#registerFirstName").keypress(function (e) { 
        var firstname = $("#registerFirstName").val().trim();
        if(firstname == ""){
            $("#registerFirstName").addClass("is-invalid");
            $("#registerFirstName").removeClass("is-valid");
        }else{
            $("#registerFirstName").addClass("is-valid");
            $("#registerFirstName").removeClass("is-invalid");
        }
    });
    $("#registerLastName").keypress(function (e) { 
        var lastname = $("#registerLastName").val().trim();
        if(lastname == ""){
            $("#registerLastName").addClass("is-invalid");
            $("#registerLastName").removeClass("is-valid");
        }else{
            $("#registerLastName").addClass("is-valid");
            $("#registerLastName").removeClass("is-invalid");
        }
    });
    $("#registerEmail").keypress(function (e) { 
        var email = $("#registerEmail").val().trim();
        if(email == ""){
            $("#registerEmail").addClass("is-invalid");
            $("#registerEmail").removeClass("is-valid");
        }else{
            $("#registerEmail").addClass("is-valid");
            $("#registerEmail").removeClass("is-invalid");
        }
    });
    $("#registerPass").keypress(function (e) { 
        var password = $("#registerPass").val().trim();
        if(password == ""){
            $("#registerPass").addClass("is-invalid");
            $("#registerPass").removeClass("is-valid");
        }else{
            $("#registerPass").addClass("is-valid");
            $("#registerPass").removeClass("is-invalid");
        }
    });

    $("emailSignIn").keypress(function (e) { 
        $("#signin-msg").text("");
    });
    $("passwordSignIn").keypress(function (e) { 
        $("#signin-msg").text("");
    });

});
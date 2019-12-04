$(document).ready(function () {
    // Check if user has been SESSION
    $.ajax({
        type: "get",
        url: "../php/ajax.php",
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
                url: "../php/ajax.php",
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
                url: "../php/ajax.php",
                data: {uniqueemail:email},
                success: function (response) {
                    if(response == 1){
                        $.ajax({
                            type: "post",
                            url: "../php/register.php",
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

});
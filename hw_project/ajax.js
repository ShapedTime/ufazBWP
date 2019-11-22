$(document).ready(function () {
    $("#signin-button").click(function (e) { 
        e.preventDefault();
        var email = $("#emailSignIn").val().trim();
        var password = $("#passwordSignIn").val().trim();
        if(email != "" && password != ""){
            $.ajax({
                type: "post",
                url: "http://teymurufaz.alwaysdata.net/BWP/hw_project/ajax.php",
                data: {email:email, password:password},
                success: function (response) {
                    if(response == 1){
                        // window.location = "home.php"
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
});
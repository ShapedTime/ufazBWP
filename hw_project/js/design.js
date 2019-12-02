$(function () {
    

    // Register Validity Checks
    $("#registerFirstName").on('input', function (e) { 
        var firstname = $("#registerFirstName").val().trim();
        if(firstname == ""){
            $("#registerFirstName").addClass("is-invalid");
            $("#registerFirstName").removeClass("is-valid");
        }else{
            $("#registerFirstName").addClass("is-valid");
            $("#registerFirstName").removeClass("is-invalid");
        }
    });
    $("#registerLastName").on('input', function (e) { 
        var lastname = $("#registerLastName").val().trim();
        if(lastname == ""){
            $("#registerLastName").addClass("is-invalid");
            $("#registerLastName").removeClass("is-valid");
        }else{
            $("#registerLastName").addClass("is-valid");
            $("#registerLastName").removeClass("is-invalid");
        }
    });
    $("#registerEmail").on('input', function (e) { 
        var email = $("#registerEmail").val().trim();
        if(email == ""){
            $("#registerEmail").addClass("is-invalid");
            $("#registerEmail").removeClass("is-valid");
        }else{
            $("#registerEmail").addClass("is-valid");
            $("#registerEmail").removeClass("is-invalid");
        }
    });
    $("#registerPass").on('input', function (e) { 
        var password = $("#registerPass").val().trim();
        if(password == ""){
            $("#registerPass").addClass("is-invalid");
            $("#registerPass").removeClass("is-valid");
        }else{
            $("#registerPass").addClass("is-valid");
            $("#registerPass").removeClass("is-invalid");
        }
    });

    $("#emailSignIn").on('input', function (e) { 
        $("#signin-msg").text("");
    });
    $("#passwordSignIn").on('input', function (e) { 
        $("#signin-msg").text("");
    });
    $(function () {
        $.ajax({
            type: "get",
            url: "../res/svg/bank-account.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".bank-account-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/cash.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".cash-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/credit-card.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".credit-card-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/down-arrow.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".down-arrow-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/ewallet.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".ewallet-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/bank-account.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".bank-account-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/home.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".home-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/credit-cards.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".credit-cards-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/document.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".bank-account-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/statistics.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".statistics-icon").append(response);
            }
        });
        $.ajax({
            type: "get",
            url: "../res/svg/wallet.svg",
            data: "",
            dataType: "image/svg+xml",
            success: function (response) {
                $(".wallet-icon").append(response);
            }
        });
    });
});
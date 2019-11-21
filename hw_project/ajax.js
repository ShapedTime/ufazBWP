$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "./ajax.php",
        data: "signin-button",
        // dataType: "dataType",
        success: function (response) {
            if(response==""){
                $("#sign-in-ajax").html('<button type="button" class="btn btn-success">Sign In</button>');
            }
            else{
                $("#sign-in-ajax").html('<button type="button" class="btn btn-success">'+response+'</button>');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $("#sign-in-ajax").html('<button type="button" class="btn btn-success">Sign In</button>');
        }
    });
});
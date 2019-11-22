<?php
    session_start();
    include_once "mysqli_config.php";
    if (isset($_POST["email"]) && isset($_POST["password"])) {        
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        if($email != "" && $password != ""){
            //TODO: verify that user exists and compare pass with 
            // password_verify ( string $password , string $hash ) : bool
            // https://www.amitmerchant.com/inbuilt-password-hashing-verification-php/
        }
        echo 0;
    }
?>
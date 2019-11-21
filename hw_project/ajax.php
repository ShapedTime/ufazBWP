<?php
    session_start();

    if(isset($_REQUEST["signin-button"])){
        if(isset($_SESSION["username"])){
            echo $_SESSION["user-first-name"]." ".$_SESSION["user-last-name"];
        }else{
            echo "";
        }
    }
?>
<?php

    $host="mysql-teymurufaz.alwaysdata.net";
    $user="169542";
    $pass="teymurufaz";
    $db="teymurufaz_hw_project";
    $conn=new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

?>
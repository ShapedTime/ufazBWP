<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    include_once "mysqli_config.php";
    if (isset($_POST["email"]) && isset($_POST["password"])) {        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        if($email != "" && $password != ""){
            if($stmt = $conn->prepare('SELECT * FROM `users` WHERE `email` = ?')){
                $stmt->bind_param('s', $_REQUEST["email"]);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id, $first_name, $last_name, $email, $password);
                if($stmt->num_rows > 0){
                    $stmt->fetch();
                    if(password_verify($_POST["password"], $password)){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo -1;
                }
            }
        }
    }
    if(isset($_REQUEST["issignedup"])){
        if($_SESSION["id"]){
            echo 1;
        }
    }
    if(isset($_REQUEST["uniqueemail"])){
        if(!empty($_REQUEST["uniqueemail"])){
            if($stmt = $conn->prepare('SELECT `id` FROM `users` WHERE `email` = ?')){
                $stmt->bind_param('s', $_REQUEST["uniqueemail"]);
                $stmt->execute();
                $stmt->store_result();

                if($stmt->num_rows >0) echo 0;
                else echo 1;
                $stmt->close();
            }else{
                echo -1;
            }
        }
    }
    

?>
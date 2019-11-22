<?php
    session_start();
    include_once "mysqli_config.php";
    if (isset($_POST["email"]) && isset($_POST["password"])) {        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        if($email != "" && $password != ""){
            //TODO: verify that user exists and compare pass with 
            // password_verify ( string $password , string $hash ) : bool
            if($stmt = $conn->prepare('SELECT * FROM `users` WHERE `email` = ?')){
                $stmt->bind_param('s', $_REQUEST["email"]);
                $result = $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $data = $stmt->fetch();
                    echo "post: ".$_POST["password"]."  data: ".$data[5];
                    if(password_verify($_POST["password"], $data["password"])){
                        echo 1;
                    }else{
                        echo "Wrong pass!";
                    }
                }else{
                    echo "No records";
                }
            }
        }
        echo 0;
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
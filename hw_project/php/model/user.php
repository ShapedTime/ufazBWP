<?php

    include_once "../mysqli_config.php";
    header("Access-Control-Allow-Origin: *");

    class User{ 
        private $id;
        private $first_name;
        private $last_name;
        private $email;

        public function __construct(){

        }

        public function create($email, $first_name, $last_name, $password){
            $email = sanitize($email);
            $first_name = sanitize($first_name);
            $last_name = sanitize($last_name);
            if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"])){
                if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
                    if ($stmt = $conn->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)')) {
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $stmt->bind_param('ssss', $first_name, $last_name, $email, $pass);
                        $stmt->execute();
                        $this->$email = $email;
                        $this->$id = $stmt->insert_id;
                        $this->$first_name = $first_name;
                        $this->$last_name = $last_name
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function read($email, $password){
            $email = sanitize($email);
            if($email != "" && $password != ""){
                if($stmt = $conn->prepare('SELECT * FROM `users` WHERE `email` = ?')){
                    $stmt->bind_param('s', $_REQUEST["email"]);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($id, $first_name, $last_name, $email, $pass);
                    if($stmt->num_rows > 0){
                        $stmt->fetch();
                        if(password_verify($password, $pass)){
                            $this->$email = $email;
                            $this->$id = $id;
                            $this->$first_name = $first_name;
                            $this->$last_name = $last_name;
                            return array(
                                "id" => $id,
                                "first_name" => $first_name,
                                "last_name" => $last_name,
                                "email" => $email,
                            );
                        }else{
                            return 0;
                        }
                    }else{
                        return -1;
                    }
                }else{
                    return 0;
                }
            }
        }


        function sanitize($arg){
            return mysqli_real_escape_string($conn, $arg);
        }
    }

?>
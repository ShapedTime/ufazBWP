<?php

    include_once "../mysqli_config.php";
    header("Access-Control-Allow-Origin: *");

    class User{ 
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $balance;
        public $transaction;


        public function __construct($id, $first_name, $last_name, $email)
        {
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->balance = array();
            $this->transaction = array();
        }


        public function create($email, $first_name, $last_name, $password){
            $email = $this->sanitize($email);
            $first_name = $this->sanitize($first_name);
            $last_name = $this->sanitize($last_name);
            if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"])){
                if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
                    /** @var mysqli $conn */
                    if ($stmt = $conn->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)')) {
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $stmt->bind_param('ssss', $first_name, $last_name, $email, $pass);
                        $stmt->execute();
                        $stmt->close();
                        $this->email = $email;
                        $this->id = $stmt->insert_id;
                        $this->first_name = $first_name;
                        $this->last_name = $last_name;
                        return array(
                            "id" => $this->id,
                            "first_name" => $first_name,
                            "last_name" => $last_name,
                            "email" => $email,
                        );
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

        public function verify($email, $password){
            $email = $this->sanitize($email);
            if($email != "" && $password != ""){
                /** @var mysqli $conn */
                if($stmt = $conn->prepare('SELECT * FROM `users` WHERE `email` = ?')){
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($id, $first_name, $last_name, $email, $pass);
                    if($stmt->num_rows > 0){
                        $stmt->fetch();
                        if(password_verify($password, $pass)){
                            $this->email = $email;
                            $this->id = $id;
                            $this->first_name = $first_name;
                            $this->last_name = $last_name;
                            $stmt->close();
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
                        return 0;
                    }
                }else{
                    return 0;
                }
            }
        }

        public function update($email, $first_name, $last_name){
            $email = $this->sanitize($email);
            $first_name = $this->sanitize($first_name);
            $last_name = $this->sanitize($last_name);
            /** @var mysqli $conn */
            if($stmt = $conn->prepare("UPDATE `users` SET first_name = ?, last_name = ?, email = ? WHERE id = ?")){
                $stmt->bind_param("sssi", $first_name, $last_name, $email);
                $stmt->execute();
                $stmt->close();
                $this->email = $email;
                $this->first_name = $first_name;
                $this->last_name = $last_name;
                return array(
                    "id" => $this->id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                );
            }else{
                return 0;
            }

        }

        public function read($id){
            $id = $this->sanitize($id);

            /** @var mysqli $conn */
            if($stmt = $conn->prepare("SELECT `id`, `first_name`, `last_name`, `email` FROM `users` WHERE id= ?")){
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $first_name, $last_name, $email);
                    $stmt->fetch();
                    $this->id = $id;
                    $this->first_name = $first_name;
                    $this->last_name = $last_name;
                    $this->email = $email;
                    $stmt->close();
                    return array(
                        "id" => $id,
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                        "email" => $email,
                    );
                }

            }
            return 0;
        }
        public function getBalances(){
            /** @var mysqli $conn */
            if($stmt = $conn->prepare("SELECT * FROM `balance` WHERE user_id = ?")){
                $stmt->bind_param("i", $this->id);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    $payment_method = new PaymentMethod(null, null, null);
                    $payment_method->read($row["payment_method_id"]);
                    array_push($this->balance, new Balance(row["id"], $this, $payment_method, $row["name"], $row["money"], $row["currency"]));
                }
                $stmt->close();
                return $this->balance;
            }
            $stmt->close();
            return 0;
        }

        public function getTransaction(){
            /** @var mysqli $conn */
            if($stmt = $conn->prepare("SELECT * FROM transaction WHERE user_id = ?")) {
                $stmt->bind_param('i', $this->id);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $category = new Category(null, null, null);
                    $balance = new Balance(null, null, null, null, null, null);
                    array_push($this->transaction, new Transaction($row["id"], $this, $category, $balance, $row["money"], $row["date"], $row["comment"]));
                }
                $stmt->close();
                return $this->transaction;
            }
            $stmt->close();
            return 0;
        }



        function sanitize($arg){
            /** @var mysqli $conn */
            return mysqli_real_escape_string($conn, $arg);
        }
    }

?>
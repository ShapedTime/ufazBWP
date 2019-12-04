<?php

include_once "../mysqli_config.php";
header("Access-Control-Allow-Origin: *");

class Transaction
{

    public $id;
    public $user;
    public $category;
    public $balance;
    public $money;
    public $date;
    public $comment;

    public function __construct($id, $user, $category, $balance, $money, $date, $comment)
    {
        $this->id = $id;
        $this->user = $user;
        $this->category = $category;
        $this->balance = $balance;
        $this->money = $money;
        $this->date = $date;
        $this->comment = $comment;
    }


    function sanitize($arg){
        /** @var mysqli $conn */
        return mysqli_real_escape_string($conn, $arg);
    }

    public function create($user_id, $category_id, $balance_id, $money, $date, $comment){
        $user_id = $this->sanitize($user_id);
        $category_id = $this->sanitize($category_id);
        $balance_id = $this->sanitize($balance_id);
        $money = $this->sanitize($money);
        $date = $this->sanitize($date);
        $comment = $this->sanitize($comment);
        $user = new User(null, null, null, null);
        $category = new Category(null, null, null);
        $balance = new Balance(null, null, null, null, null,null);
        if($user->read($user_id) && $category->read($category_id) && $balance->read($balance_id)){
            /** @var mysqli $conn */
            if($stmt = $conn->prepare("INSERT INTO `transaction` (user_id, category_id, balance_id, money, date, comment) VALUES (?, ?, ?, ?, ?, ?)")){
                if(empty($date)){
                    $date = date("Y-m-d");
                }
                $stmt->bind_param($user->id, $category->id, $balance->id, $money, $date, $comment);
                if($balance->transactMoney($money, $category->accounting->id)){
                    $stmt->execute();
                    $this->id = $stmt->insert_id;
                    $this->user = $user;
                    $this->category = $category;
                    $this->balance = $balance;
                    $this->money = $money;
                    $this->date = $date;
                    $this->comment = $comment;
                    $stmt->close();
                    return array(
                        "id" => $this->id,
                        "user" => $this->user,
                        "category" => $this->category,
                        "balance" => $this->balance,
                        "money" => $this->money,
                        "date" => $this->date,
                        "comment" => $this->comment,
                    );
                }
            }
            $stmt->close();
        }
        return 0;
    }

    public function read($id){
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("SELECT * FROM `transaction` WHERE id = ?")){
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $stmt->bind_result($id, $user_id, $category_id, $balance_id, $money, $date, $comment);
                $stmt->fetch();
                $user = new User(null, null, null, null);
                $category = new Category(null, null, null);
                $balance = new Balance(null, null, null, null, null, null);
                $user->read($user_id);
                $category->read($category_id);
                $balance->read($balance_id);
                $this->id = $id;
                $this->user = $user;
                $this->category = $category;
                $this->balance = $balance;
                $this->money = $money;
                $this->date = $date;
                $this->comment = $comment;
                $stmt->close();
                return array(
                    "id" => $this->id,
                    "user" => $this->user,
                    "category" => $this->category,
                    "balance" => $this->balance,
                    "money" => $this->money,
                    "date" => $this->date,
                    "comment" => $this->comment,
                );
            }
        }
        $stmt->close();
        return 0;
    }


}
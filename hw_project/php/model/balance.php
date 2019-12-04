<?php

include_once "../mysqli_config.php";
header("Access-Control-Allow-Origin: *");

class Balance
{

    public $id;
    public $user;
    public $payment_method;
    public $name;
    public $money;
    public $currency;


    public function __construct($id, $user, $payment_method, $name, $money, $currency)
    {
        $this->id = $id;
        $this->user = $user;
        $this->payment_method = $payment_method;
        $this->name = $name;
        $this->money = $money;
        $this->currency = $currency;
    }

    public function create($user_id, $payment_method_id, $name, $money, $currency){
        $user_id = $this->sanitize($user_id);
        $payment_method_id = $this->sanitize($payment_method_id);
        $name = $this->sanitize($name);
        $money = $this->sanitize($money);
        $currency = $this->sanitize($currency);

        if(!empty($user_id) && !empty($payment_method_id) && !empty($name) && !empty($money) && !empty($currency)){
            $user = new User(null, null, null, null);
            $payment_method = new PaymentMethod(null, null, null);
            if($user->read($user_id) && $payment_method->read($payment_method_id)) {
                /** @var mysqli $conn */
                if ($stmt = $conn->prepare("INSERT INTO balance (user_id, payment_method_id, name, money, currency) VALUES (?, ?, ?, ?, ?)")) {
                    $stmt->bind_param('iisds', $user_id, $payment_method_id, $name, $money, $currency);
                    $stmt->execute();
                    $this->id = $stmt->insert_id;
                    $this->user = $user;
                    $this->payment_method = $payment_method;
                    $this->name = $name;
                    $this->money = $money;
                    $this->currency = $currency;
                    $stmt->close();
                    return array(
                        "id" => $this->id,
                        "user" => $this->user,
                        "payment_method" => $payment_method,
                        "name" => $this->name,
                        "money" => $this->money,
                        "currency" => $this->currency,
                    );
                }
            }
        }
        return 0;
    }
    public function read($id){
        $id=$this->sanitize($id);
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("SELECT * FROM `balance` WHERE id = ?")){
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $stmt->bind_result($id, $user_id, $payment_method_id, $name, $money, $currency);
                $stmt->fetch();
                $user = new User(null,null,null,null);
                $user->read($user_id);
                $payment_method = new PaymentMethod(null, null, null);
                $payment_method->read($payment_method_id);
                $this->id=$id;
                $this->user=$user;
                $this->payment_method = $payment_method;
                $this->name = $name;
                $this->money = $money;
                $this->currency = $currency;
                $stmt->close();
                return array(
                    "id" => $this->id,
                    "user" => $this->user,
                    "payment_method" => $this->payment_method,
                    "name" => $this->name,
                    "money" => $this->money,
                    "currency" => $this->currency,
                );
            }
            $stmt->close();
        }
        return 0;
    }

    public function transactMoney($money, $accounting_id){
        if($accounting_id == 2){ // expense
            $money = -1*abs($money);
        }
        $money += $this->money;
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("UPDATE `balance` SET money = ? WHERE id = ?")){
            $stmt->bind_param('di', $money, $this->id);
            $stmt->execute();
            $stmt->close();
            $this->money=$money;
            return 1;
        }
        $stmt->close();
        return 0;
    }


    function sanitize($arg){
        /** @var mysqli $conn */
        return mysqli_real_escape_string($conn, $arg);
    }
}
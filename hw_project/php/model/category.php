<?php

include_once "../mysqli_config.php";
header("Access-Control-Allow-Origin: *");

class Category
{
    public $id;
    /** @var Accounting $accounting */
    public $accounting;
    public $name;

    public function __construct($id, $name, $accounting)
    {
        $this->id=$id;
        $this->name=$name;
        $this->accounting=$accounting;
    }


    function sanitize($arg){
        /** @var mysqli $conn */
        return mysqli_real_escape_string($conn, $arg);
    }

    public function create($name, $accounting_id){
        $name = $this->sanitize($name);
        $accounting_id = $this->sanitize($accounting_id);

        if(isset($name) && isset($accounting_id)){
            if(!empty($name) && !empty($accounting_id)){
                /** @var mysqli $conn */
                if($stmtacc = $conn->prepare("SELECT * FROM `accounting` WHERE id = ?")){
                    $stmtacc->bind_param('i', $accounting_id);
                    $stmtacc->execute();
                    $stmtacc->store_result();
                    if($stmtacc->num_rows == 1) {
                        if ($stmt = $conn->prepare("INSERT INTO `category` (accounting_id, name) VALUES (?, ?)")) {
                            $stmt->bind_param('is', $accounting_id, $name);
                            $stmt->execute();
                            $stmtacc->bind_result($accounting_id, $accounting_type);
                            $stmtacc->fetch();
                            $this->id = $stmt->insert_id;
                            $this->name=$name;
                            $this->accounting=new Accounting($accounting_id, $accounting_type);
                            $stmt->close();
                            return array(
                                "id" => $this->id,
                                "name" => $this->name,
                                "accounting" => $this->accounting,
                            );
                        }
                    }
                    $stmtacc->close();
                }

            }
        }
        return 0;
    }
    public function read($id = "%"){
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("SELECT * FROM `accounting` WHERE id LIKE ?")){
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows == 0) return 0;
            else{
                $pmarray = [];
                while($row = $result->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->name = $row["name"];
                    $acc = new Accounting(null, null);
                    $acc->read($row["accounting_id"]);
                    $this->accounting = $acc;
                    array_push($pmarray, new Category($row["id"], $row["name"], $acc));
                }
                return $pmarray;
            }
        }else{
            return 0;
        }
    }

}
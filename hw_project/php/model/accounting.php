<?php

include_once "../mysqli_config.php";
header("Access-Control-Allow-Origin: *");

class Accounting
{
    public $id;
    public $type;
    public $category;

    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->category = array();
    }

    function sanitize($arg){
        /** @var mysqli $conn */
        return mysqli_real_escape_string($conn, $arg);
    }
    public function create($type){
        $type = $this->sanitize($type);

        if(isset($type)){
            if(!empty($type)){
                /** @var mysqli $conn */
                if($stmt = $conn->prepare("INSERT INTO `payment_method` (type) VALUES (?)")){
                    $stmt->bind_param('s', $type);
                    $stmt->execute();
                    $stmt->close();
                    $this->id = $stmt->insert_id;
                    $this->type = $type;
                    return array(
                        "id"=>$this->id,
                        "type"=>$type,
                    );
                }
            }
        }
    }
    public function read($id = "%"){
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("SELECT * FROM `payment_method` WHERE id LIKE ?")){
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows == 0) return 0;
            else{
                $pmarray = [];
                while($row = $result->fetch_assoc()){
                    $this->id = $row["id"];
                    $this->type = $row["type"];
                    array_push($pmarray, new Accounting($row["id"], $row["type"]));
                }
                return $pmarray;
            }
        }else{
            return 0;
        }
    }

    public function getCategory(){
        /** @var mysqli $conn */
        if($stmt = $conn->prepare("SELECT * FROM `category` WHERE accounting_id = ?")){
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                array_push($this->category, new Category($row["id"], $row["name"], $this));
            }
            $stmt->close();
            return $this->category;
        }
        $stmt->close();
    }
}
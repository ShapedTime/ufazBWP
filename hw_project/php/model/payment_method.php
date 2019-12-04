<?   
    include_once "../mysqli_config.php";
    header("Access-Control-Allow-Origin: *");

    class PaymentMethod{ 
        public $id;
        public $type;
        public $icon;

        public function __construct($id, $type, $icon){
            $this->id = $id;
            $this->type = $type;
            $this->icon = $icon;
        }
        function sanitize($arg){
            /** @var mysqli $conn */
            return mysqli_real_escape_string($conn, $arg);
        }

        public function create($type, $icon){
            $type = $this->sanitize($type);
            $icon = $this->sanitize($icon);

            if(isset($type) && isset($icon)){
                if(!empty($type) && !empty($icon)){
                    /** @var mysqli $conn */
                    if($stmt = $conn->prepare("INSERT INTO `payment_method` (type, icon) VALUES (?, ?)")){
                        $stmt->bind_param('ss', $type, $icon);
                        $stmt->execute();
                        $stmt->close();
                        $this->id = $stmt->insert_id;
                        $this->type = $type;
                        $this->icon = $icon;
                        return array(
                            "id"=>$this->id,
                            "type"=>$type,
                            "icon"=>$icon,
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
                        $this->icon = $row["icon"];
                        array_push($pmarray, new PaymentMethod($row["id"], $row["type"], $row["icon"]));
                    }
                    return $pmarray;
                }
            }else{
                return 0;
            }
        }
    }

?>    
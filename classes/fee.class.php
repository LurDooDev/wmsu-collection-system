<?php

require_once 'database.class.php';

class Fee {
    public $feeID;
    public $feeType;
    public $feeAmount;
    public $feeName;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createFee() {
        try {
            $sql = "INSERT INTO fee (fee_type, fee_name, fee_amount) VALUES (:fee_type, :fee_name, :fee_amount)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':fee_type', $this->feeType);
            $stmt->bindParam(':fee_name', $this->feeName);
            $stmt->bindParam(':fee_amount', $this->feeAmount);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function get($fee_id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM fee WHERE fee_id = :fee_id");
        $stmt->bindParam(":fee_id", $fee_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function show(){
        $sql = "SELECT * FROM `fee` ORDER BY `fee`.`fee_id` ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete(){
        $sql = "DELETE FROM fee WHERE fee_id=:fee_id";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':fee_id', $this->feeID);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

   
}

?>

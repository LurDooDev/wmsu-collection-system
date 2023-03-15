<?php

require_once 'database.class.php';


class LocalFee {
    public $localID;
    public $localType;
    public $localName;
    public $collegeID;
    public $createdBy;
    public $semesterID;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createLocalFees() {
        try {
    
            // Insert the new row into the fee_schedule table with the retrieved ID values
            $insertSql = "INSERT INTO local_fee (local_name, created_by, college_id) VALUES (:local_name, :created_by, :college_id)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':local_name', $this->localName);
            $insertStmt->bindParam(':created_by', $this->createdBy);
            $insertStmt->bindParam(':college_id', $this->collegeID);
            $insertStmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function show(){
        $sql = "SELECT * FROM local_fee ORDER BY local_fee.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;   
    }


    function get($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM local_fee WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function showAllDetails() {
        $sql = "SELECT lf.local_fee_type, lf.id, lf.local_name, lf.created_by, c.college_name
                FROM local_fee lf
                JOIN colleges c ON lf.college_id = c.id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // function delete(){
    //     $sql = "DELETE FROM fee WHERE fee_id=:fee_id";

    //     $query=$this->db->connect()->prepare($sql);
    //     $query->bindParam(':fee_id', $this->feeID);

    //     if($query->execute()){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }	
    // }

   
}

?>
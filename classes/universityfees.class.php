<?php

require_once 'database.class.php';

class UniversityFee {
    public $universityID;
    public $universityType;
    public $universityName;
    public $universitycreatedby;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createUniversityFee() {
        try {
            $sql = "INSERT INTO university_fee (university_name, created_by) VALUES (:university_name, :created_by)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':university_name', $this->universityName);
            $stmt->bindParam(':created_by', $this->universitycreatedby);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function show(){
        $sql = "SELECT * FROM university_fee ORDER BY university_fee.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;   
    }


    function get($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM university_fee WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
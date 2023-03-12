<?php

require_once 'database.class.php';

class Program {
    public $programID;
    public $collegeID;
    public $programName;
    public $collegeName;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createProgram() {
        try {
    
            // Get the ID of the semester with the given semester name
            $collegeSql = "SELECT id FROM colleges WHERE id = :college_id";
            $collegeStmt = $this->db->connect()->prepare($collegeSql);
            $collegeStmt->bindParam(':college_id', $this->collegeID);
            $collegeStmt->execute();
            $collegeID = $collegeStmt->fetchColumn();
    
    
            // Insert the new row into the fee_schedule table with the retrieved ID values
            $insertSql = "INSERT INTO programs (program_name, college_id)
            VALUES (:program, :college_id)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':program', $programName);
            $insertStmt->bindParam(':college_id', $collegeID);
            $insertStmt->execute();

    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function deleteUniversityFeeSchedule($universityFeeID) {
        try {
            // Check if the given university fee has an active schedule
            $scheduleSql = "SELECT is_active FROM university_fee_schedule WHERE university_fee_id = :university_id AND is_active = true";
            $scheduleStmt = $this->db->connect()->prepare($scheduleSql);
            $scheduleStmt->bindParam(':university_id', $universityFeeID);
            $scheduleStmt->execute();
            $hasActiveSchedule = $scheduleStmt->fetchColumn();
    
            if ($hasActiveSchedule) {
                // Deactivate the university fee
                $deactivateSql = "UPDATE university_fee SET is_active = false WHERE id = :university_id";
                $deactivateStmt = $this->db->connect()->prepare($deactivateSql);
                $deactivateStmt->bindParam(':university_id', $universityFeeID);
                $deactivateStmt->execute();
            }
    
            // Delete the schedule for the given university fee
            $deleteSql = "DELETE FROM university_fee_schedule WHERE university_fee_id = :university_id";
            $deleteStmt = $this->db->connect()->prepare($deleteSql);
            $deleteStmt->bindParam(':university_id', $universityFeeID);
            $deleteStmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    


    function show(){
        $sql = "SELECT * FROM university_fee_schedule ORDER BY university_fee_schedule.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;   
    }

    function getFeeScheduleByFeeId($fee_id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM university_fee_schedule WHERE university_fee_id = :fee_id");
        $stmt->bindParam(":fee_id", $fee_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function get($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM programs WHERE college_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


   
}

?>
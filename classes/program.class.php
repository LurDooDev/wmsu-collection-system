<?php

require_once 'database.class.php';

class Program {
    public $programID;
    public $collegeID;
    public $programName;

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
            $insertStmt->bindParam(':program', $this->programName);
            $insertStmt->bindParam(':college_id', $collegeID);
            $insertStmt->execute();

    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function delete(){
            $sql = "DELETE FROM programs WHERE id=:id";
    
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':id', $this->programID);
    
            if($query->execute()){
                return true;
            }
            else{
                return false;
            }	
        }

        function update(){
                $sql = "UPDATE programs SET program_name=:program_name WHERE id=:id";
                $query=$this->db->connect()->prepare($sql);
                $query->bindParam(':program_name', $this->programName);
                $query->bindParam(':id', $this->programID);
                
                if ($query->execute()) {
                    $count = $query->rowCount();
                    echo "$count row updated";
                    return true;
                } else {
                    $error = $query->errorInfo();
                    echo "Update failed: " . $error[2];
                    return false;
                }	
            }


    function show(){
        $sql = "SELECT * FROM programs ORDER BY programs.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;   
    }

    function showAllDetailsByProgramId($college_id) {
        $sql = "SELECT p.program_name, p.id, p.college_id, c.college_name, c.college_code
                FROM programs p
                JOIN colleges c ON p.college_id = c.id
                WHERE p.college_id = :college_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':college_id', $college_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProgramByCollegeId($college_id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM programs WHERE college_id = :college_id");
        $stmt->bindParam(":college_id", $college_id);
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
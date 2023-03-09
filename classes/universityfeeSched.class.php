<?php

require_once 'database.class.php';

class UniversityFeeSched {
    public $universityFeeID;
    public $semesterID;
    public $schoolYearID;
    public $universityStartDate;
    public $universityEndDate;
    public $universitycreatedby;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createUniversityFeeSched() {
        try {
            // Get the ID of the fee with the given fee type
            $universityFeeSql = "SELECT id FROM university_fee WHERE id = :university_id";
            $universityFeeStmt = $this->db->connect()->prepare($universityFeeSql);
            $universityFeeStmt->bindParam(':university_id', $this->universityFeeID);
            $universityFeeStmt->execute();
            $universityFeeID = $universityFeeStmt->fetchColumn();
    
            // Get the ID of the semester with the given semester name
            $semesterSql = "SELECT id FROM semesters WHERE id = :semester_id";
            $semesterStmt = $this->db->connect()->prepare($semesterSql);
            $semesterStmt->bindParam(':semester_id', $this->semesterID);
            $semesterStmt->execute();
            $semesterID = $semesterStmt->fetchColumn();
    
            // Get the ID of the school year with the given school year name
            $schoolYearSql = "SELECT id FROM school_year WHERE id = :school_year_id";
            $schoolYearStmt = $this->db->connect()->prepare($schoolYearSql);
            $schoolYearStmt->bindParam(':school_year_id', $this->schoolYearID);
            $schoolYearStmt->execute();
            $schoolYearID = $schoolYearStmt->fetchColumn();
            
            // Define the variables for the prepared statement
            $universityStartDate = $this->universityStartDate;
            $universityEndDate = $this->universityEndDate;
            $universitycreatedby = $this->universitycreatedby;

            // Insert the new row into the fee_schedule table with the retrieved ID values
            $insertSql = "INSERT INTO university_fee_schedule (university_fee_id, semester_id, school_year_id, university_start_date, university_end_date, created_by)
            VALUES (:university_id, :semester_id, :school_year_id, :university_start_date, :university_end_date, :created_by)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':university_id', $universityFeeID);
            $insertStmt->bindParam(':semester_id', $semesterID);
            $insertStmt->bindParam(':school_year_id', $schoolYearID);
            $insertStmt->bindParam(':university_start_date', $universityStartDate);
            $insertStmt->bindParam(':university_end_date', $universityEndDate);
            $insertStmt->bindParam(':created_by', $universitycreatedby);
            $insertStmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function showAllDetails() {
        $sql = "SELECT ufs.university_start_date, ufs.university_end_date, ufs.created_by, uf.university_name, uf.university_amount, uf.university_type, s.semester_name, sy.school_year_name
                FROM university_fee_schedule ufs
                JOIN university_fee uf ON ufs.university_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN school_year sy ON ufs.school_year_id = sy.id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function show(){
        $sql = "SELECT * FROM university_fee_schedule ORDER BY university_fee_schedule.id ASC";
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
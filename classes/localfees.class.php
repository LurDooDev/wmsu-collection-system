<?php

require_once 'database.class.php';


class LocalFees {
    public $localFeeID;
    public $semesterID;
    public $academicYearID;
    public $localAmount;
    public $localName;
    public $localStartDate;
    public $localEndDate;
    public $localcreatedby;
    public $semesterDuration;
    public $isActive;
    public $collegeID;


    public $db;


    function __construct() {
        $this->db = new Database();
    }

    function createLocalFees() {
        try {
            $dbConnection = $this->db->connect();

            $semesterSql = "SELECT id FROM semesters WHERE id = :semester_id";
            $semesterStmt = $dbConnection->prepare($semesterSql);
            $semesterStmt->bindParam(':semester_id', $this->semesterID);
            $semesterStmt->execute();
            $semesterID = $semesterStmt->fetchColumn();
    
            $academicYearSql = "SELECT id FROM academic_year WHERE id = :academic_year_id";
            $academicYearStmt = $dbConnection->prepare($academicYearSql);
            $academicYearStmt->bindParam(':academic_year_id', $this->academicYearID);
            $academicYearStmt->execute();
            $academicYearID = $academicYearStmt->fetchColumn();

            $collegeSql = "SELECT id FROM colleges WHERE id = :college_id";
            $collegeStmt = $dbConnection->prepare($collegeSql);
            $collegeStmt->bindParam(':college_id', $this->collegeID);
            $collegeStmt->execute();
            $collegeID = $collegeStmt->fetchColumn();
    
          
            $insertSql = "INSERT INTO local_fees (academic_year_id, semester_id, college_id, fee_name, fee_amount, start_date, end_date, created_by)
                VALUES (:academic_year_id, :semester_id, :college_id, :fee_name, :fee_amount, :start_date, :end_date, :created_by)";
            $insertStmt = $dbConnection->prepare($insertSql);
            $insertStmt->bindParam(':academic_year_id', $academicYearID);
            $insertStmt->bindParam(':semester_id', $semesterID);
            $insertStmt->bindParam(':college_id', $collegeID);
            $insertStmt->bindParam(':fee_name', $this->localName);
            $insertStmt->bindParam(':fee_amount', $this->localAmount);
            $insertStmt->bindParam(':start_date', $this->localStartDate);
            $insertStmt->bindParam(':end_date', $this->localEndDate);
            $insertStmt->bindParam(':created_by',  $this->localcreatedby);
            $insertStmt->execute();
            $newlyInsertedId = $dbConnection->lastInsertId();
    
            $insertPendingSql = "INSERT INTO local_pending (student_id, local_fee_id, college_id, pending_amount)
            SELECT students.id, :local_fee_id, :college_id, :amount
            FROM students
            WHERE students.college_id = :college_id";
    $insertPendingStmt = $dbConnection->prepare($insertPendingSql);
    $insertPendingStmt->bindParam(':local_fee_id', $newlyInsertedId);
    $insertPendingStmt->bindParam(':amount', $this->localAmount);
    $insertPendingStmt->bindParam(':college_id', $collegeID); 
    $insertPendingStmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    function showAllDetailsByCollegeID($collegeid) {
        $sql = "SELECT lf.id, lf.start_date, lf.fee_amount, lf.end_date, lf.created_by, lf.fee_name, lf.fee_type, s.semester_name, sy.academic_name, c.college_name
                FROM local_fees lf
                JOIN semesters s ON lf.semester_id = s.id
                JOIN colleges c ON lf.college_id = c.id
                JOIN academic_year sy ON lf.academic_year_id = sy.id
                WHERE lf.college_id = :college_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':college_id', $collegeid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

   
}

?>
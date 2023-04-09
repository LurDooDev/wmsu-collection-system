<?php

require_once 'database.class.php';

class UniversityFees {
    public $universityFeeID;
    public $semesterID;
    public $academicYearID;
    public $universityAmount;
    public $universityName;
    public $universityStartDate;
    public $universityEndDate;
    public $universitycreatedby;
    public $semesterDuration;
    public $isActive;


    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createUniversityFees() {
        try {
    
            // Get the ID of the semester with the given semester name
            $semesterSql = "SELECT id FROM semesters WHERE id = :semester_id";
            $semesterStmt = $this->db->connect()->prepare($semesterSql);
            $semesterStmt->bindParam(':semester_id', $this->semesterID);
            $semesterStmt->execute();
            $semesterID = $semesterStmt->fetchColumn();
    
            // Get the ID of the school year with the given school year name
            $academicYearsql = "SELECT id FROM academic_year WHERE id = :academic_year_id";
            $academicYearStmt = $this->db->connect()->prepare($academicYearsql);
            $academicYearStmt->bindParam(':academic_year_id', $this->academicYearID);
            $academicYearStmt->execute();
            $academicYearID = $academicYearStmt->fetchColumn();
    
            // Insert a new row into the university_fee_schedule table
            $insertSql = "INSERT INTO university_fees (academic_year_id, semester_id, fee_name, fee_amount, start_date, end_date, created_by)
                VALUES (:academic_year_id, :semester_id, :fee_name, :fee_amount, :start_date, :end_date, :created_by)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':academic_year_id', $academicYearID);
            $insertStmt->bindParam(':semester_id', $semesterID);
            $insertStmt->bindParam(':fee_name', $this->universityName);
            $insertStmt->bindParam(':fee_amount', $this->universityAmount);
            $insertStmt->bindParam(':start_date', $this->universityStartDate);
            $insertStmt->bindParam(':end_date', $this->universityEndDate);
            $insertStmt->bindParam(':created_by',  $this->universitycreatedby);
            $insertStmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function showAllDetails() {
        $sql = "SELECT ufs.id, ufs.start_date, ufs.fee_amount, ufs.end_date, ufs.created_by, ufs.fee_name, ufs.fee_type, s.semester_name, sy.academic_name
                FROM university_fees ufs
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function showAllDetailsByPayId($fee_id) {
        $sql = "SELECT ufs.id, ufs.university_start_date, ufs.university_amount, ufs.university_end_date, ufs.created_by, ufs.is_active, uf.university_name, uf.university_fee_type, s.semester_name, sy.academic_name
                FROM university_fee_schedule ufs
                JOIN university_fee uf ON ufs.university_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id
                WHERE ufs.id = :fee_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':fee_id', $fee_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function showAllDetailsByFeeId($fee_id) {
        $sql = "SELECT ufs.university_start_date, ufs.university_amount, ufs.university_end_date, ufs.created_by, ufs.is_active, uf.university_name, uf.university_fee_type, s.semester_name, sy.academic_name
                FROM university_fee_schedule ufs
                JOIN university_fee uf ON ufs.university_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id
                WHERE ufs.university_fee_id = :fee_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':fee_id', $fee_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function calculateStartDate($schoolYearStartDate, $semesterID) {
        // Extract the year from the school year start date
        $startYear = date('Y', strtotime($schoolYearStartDate));
    
        // Calculate the start month based on the semester ID
        $startMonth = ($semesterID == 1) ? 8 : 1; // Assuming August start for 1st semester and January start for 2nd semester
    
        // Check if the current month is greater than or equal to the start month of the 2nd semester
        if (date('n') >=  $startMonth && $semesterID == 2) {
            $startYear++; // Increment the start year by 1
        }
    
        // Construct the start date string
        $startDate = date('Y-m-d', strtotime("$startYear-$startMonth-01"));
    
        return $startDate;
    }

    function calculateEndDate($schoolYearStartDate, $semesterID) {
        try {
            // Get the duration of the semester with the given ID
            $semesterDurationSql = "SELECT semester_duration FROM semesters WHERE id = :semester_id";
            $semesterDurationStmt = $this->db->connect()->prepare($semesterDurationSql);
            $semesterDurationStmt->bindParam(':semester_id', $semesterID);
            $semesterDurationStmt->execute();
            $duration = $semesterDurationStmt->fetchColumn();

            // Calculate the start and end dates of the semester based on the school year start date
            $startDate = $this->calculateStartDate($schoolYearStartDate, $semesterID);
            $endDate = date('Y-m-d', strtotime("$startDate +$duration months"));

            return $endDate;
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
    
    function showAllDetailsbyID($fee_id) {
        $sql = "SELECT ufs.university_start_date, ufs.university_end_date, ufs.created_by, uf.university_name, uf.university_amount, uf.university_type, s.semester_name, sy.school_year_name
                FROM university_fee_schedule ufs
                JOIN university_fee uf ON ufs.university_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN school_year sy ON ufs.school_year_id = sy.id
                WHERE ufs.university_fee_id = :fee_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':fee_id', $fee_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function showAllDetailsActive() {
        $sql = "SELECT ufs.id, ufs.university_start_date, ufs.university_amount, ufs.university_end_date, ufs.created_by, ufs.is_active, uf.university_name, uf.university_fee_type, s.semester_name, sy.academic_name
                FROM university_fee_schedule ufs
                JOIN university_fee uf ON ufs.university_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id
                WHERE ufs.is_active = 1";
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

    function getFeeScheduleByFeeId($fee_id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM university_fee_schedule WHERE university_fee_id = :fee_id");
        $stmt->bindParam(":fee_id", $fee_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function get($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM university_fee_schedule WHERE university_fee_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


   
}

?>
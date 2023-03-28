<?php
require_once 'database.class.php';


class localFeeSched {
    public $localFeeID;
    public $semesterID;
    public $academicYearID;
    public $collegeID;
    public $localAmount;
    public $localStartDate;
    public $localEndDate;
    public $localcreatedby;
    public $semesterDuration;
    public $isActive;


    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function showAllDetailsActive() {
        $sql = "SELECT lfs.id, lfs.local_start_date, lfs.local_amount, lfs.local_end_date, lfs.created_by, lf.college_id, lfs.is_active, lf.local_name, lf.local_fee_type, s.semester_name, sy.academic_name, c.college_code
                FROM local_fee_schedule lfs
                JOIN local_fee lf ON lfs.local_fee_id = lf.id
                JOIN colleges c ON lf.college_id = c.id
                JOIN semesters s ON lfs.semester_id = s.id
                JOIN academic_year sy ON lfs.academic_year_id = sy.id
                 WHERE lfs.is_active = 1 AND lf.college_id = :college_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':college_id', $_SESSION['collegeID']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // function showAllDetailsActive() {
    //     $sql = "SELECT lfs.id, lfs.university_start_date, lfs.university_amount, lfs.university_end_date, lfs.created_by, lfs.is_active, lf.university_name, lf.university_fee_type, s.semester_name, sy.academic_name
    //             FROM local_fee_schedule lfs
    //             JOIN local_fee lf ON lfs.university_fee_id = lf.id
    //             JOIN semesters s ON lfs.semester_id = s.id
    //             JOIN academic_year sy ON lfs.academic_year_id = sy.id
    //             WHERE lfs.is_active = 1";
    //     $stmt = $this->db->connect()->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

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

    function createLocalFeeSched() {
        try {

                   // Get the academic year start date
        $academicYearStartDateSql = "SELECT academic_start_date FROM academic_year WHERE id = :academic_year_id";
        $academicYearStartDateStmt = $this->db->connect()->prepare($academicYearStartDateSql);
        $academicYearStartDateStmt->bindParam(':academic_year_id', $this->academicYearID);
        $academicYearStartDateStmt->execute();
        $academicYearStartDate = $academicYearStartDateStmt->fetchColumn();

           // Calculate the start and end dates of the semester based on the academic year start date
           $startDate = $this->calculateStartDate($academicYearStartDate, $this->semesterID);
           $endDate = $this->calculateEndDate($academicYearStartDate, $this->semesterID);

               // Get the ID of the fee with the given fee type
            $localFeeSql = "SELECT id FROM local_fee WHERE id = :local_id";
            $localFeeStmt = $this->db->connect()->prepare($localFeeSql);
            $localFeeStmt->bindParam(':local_id', $this->localFeeID);
            $localFeeStmt->execute();
            $localFeeID = $localFeeStmt->fetchColumn();
    
            // Get the ID of the semester with the given semester name
            $semesterSql = "SELECT id FROM semesters WHERE id = :semester_id";
            $semesterStmt = $this->db->connect()->prepare($semesterSql);
            $semesterStmt->bindParam(':semester_id', $this->semesterID);
            $semesterStmt->execute();
            $semesterID = $semesterStmt->fetchColumn();

            // Get the ID of the semester with the given semester name
            $collegeSql = "SELECT id FROM colleges WHERE id = :college_id";
            $collegeStmt = $this->db->connect()->prepare($collegeSql);
            $collegeStmt->bindParam(':college_id', $this->collegeID);
            $collegeStmt->execute();
            $collegeID = $collegeStmt->fetchColumn();
    
            // Get the ID of the school year with the given school year name
            $academicYearsql = "SELECT id FROM academic_year WHERE id = :academic_year_id";
            $academicYearStmt = $this->db->connect()->prepare($academicYearsql);
            $academicYearStmt->bindParam(':academic_year_id', $this->academicYearID);
            $academicYearStmt->execute();
            $academicYearID = $academicYearStmt->fetchColumn();
    
            // Define the variables for the prepared statement
            $localcreatedby = $this->localcreatedby;
            $collegeID = $this->collegeID;
    
            // Insert a new row into the university_fee_schedule table
            $insertSql = "INSERT INTO local_fee_schedule (local_fee_id, academic_year_id, semester_id, college_id, local_amount, local_start_date, local_end_date, created_by)
                VALUES (:local_fee_id, :academic_year_id, :semester_id, :college_id, :local_amount, :local_start_date, :local_end_date, :created_by)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':local_fee_id', $localFeeID);
            $insertStmt->bindParam(':academic_year_id', $academicYearID);
            $insertStmt->bindParam(':semester_id', $semesterID);
            $insertStmt->bindParam(':college_id', $collegeID);
            $insertStmt->bindParam(':local_amount', $this->localAmount);
            $insertStmt->bindParam(':local_start_date', $startDate);
            $insertStmt->bindParam(':local_end_date', $endDate);
            $insertStmt->bindParam(':created_by', $localcreatedby);
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

    function showAllDetailsByFeeId($fee_id) {
        $sql = "SELECT ufs.local_start_date, ufs.local_amount, ufs.local_end_date, ufs.created_by, ufs.is_active, uf.local_name, uf.local_fee_type, s.semester_name, sy.academic_name, c.college_name
                FROM local_fee_schedule ufs
                JOIN local_fee uf ON ufs.local_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id
                JOIN colleges c ON ufs.college_id = c.id
                WHERE ufs.local_fee_id = :fee_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':fee_id', $fee_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function showAllDetails() {
        $sql = "SELECT ufs.id, ufs.local_start_date, ufs.local_amount, ufs.local_end_date, ufs.created_by, ufs.is_active, uf.local_name, uf.local_fee_type, s.semester_name, sy.academic_name, c.college_name
                FROM local_fee_schedule ufs
                JOIN local_fee uf ON ufs.local_fee_id = uf.id
                JOIN semesters s ON ufs.semester_id = s.id
                JOIN academic_year sy ON ufs.academic_year_id = sy.id
                JOIN colleges c ON ufs.college_id = c.id";
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
        $stmt = $this->db->connect()->prepare("SELECT * FROM local_fee_schedule WHERE local_fee_id = :id");
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
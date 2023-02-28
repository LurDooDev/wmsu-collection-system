<?php

require_once 'database.class.php';

class FeeSchedule {
    //attributes
    public $feeScheduleID;
    public $schoolYearID;
    public $semesterID;
    public $feeID;

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createFeeSchedule() {
        try {
            // Get the ID of the fee with the given fee type
            $feeSql = "SELECT fee_id FROM fee WHERE fee_id = :fee_id";
            $feeStmt = $this->db->connect()->prepare($feeSql);
            $feeStmt->bindParam(':fee_id', $this->feeID);
            $feeStmt->execute();
            $feeId = $feeStmt->fetchColumn();
    
            // Get the ID of the semester with the given semester name
            $semesterSql = "SELECT semester_id FROM semester WHERE semester_id = :semester_id";
            $semesterStmt = $this->db->connect()->prepare($semesterSql);
            $semesterStmt->bindParam(':semester_id', $this->semesterID);
            $semesterStmt->execute();
            $semesterId = $semesterStmt->fetchColumn();
    
            // Get the ID of the school year with the given school year name
            $schoolYearSql = "SELECT school_year_id FROM school_year WHERE school_year_id = :school_year_id";
            $schoolYearStmt = $this->db->connect()->prepare($schoolYearSql);
            $schoolYearStmt->bindParam(':school_year_id', $this->schoolYearID);
            $schoolYearStmt->execute();
            $schoolYearId = $schoolYearStmt->fetchColumn();
    
            // Insert the new row into the fee_schedule table with the retrieved ID values
            $insertSql = "INSERT INTO fee_schedule (fee_id, semester_id, school_year_id) VALUES (:fee_id, :semester_id, :school_year_id)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':fee_id', $feeId);
            $insertStmt->bindParam(':semester_id', $semesterId);
            $insertStmt->bindParam(':school_year_id', $schoolYearId);
            $insertStmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    function showAllDetails() {
        $sql = "SELECT f.fee_name, ft.fee_type, fa.fee_amount, s.semester_name, ssd.semester_start_date, sed.semester_end_date, sy.school_year_name
                FROM fee_schedule fs
                JOIN fee f ON f.fee_id = fs.fee_id
                JOIN fee ft ON ft.fee_id = fs.fee_id
                JOIN fee fa ON fa.fee_id = fs.fee_id
                JOIN semester s ON s.semester_id = fs.semester_id
                JOIN semester ssd ON ssd.semester_id = fs.semester_id
                JOIN semester sed ON sed.semester_id = fs.semester_id
                JOIN school_year sy ON sy.school_year_id = fs.school_year_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

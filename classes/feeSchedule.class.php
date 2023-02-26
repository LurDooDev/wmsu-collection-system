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

    //method to add fee schedule
    function FeeSchedAdd() {
        $sql = "INSERT INTO fee_schedule (school_year_id, semester_id, fee_id) VALUES (:schoolYearID, :semesterID, :feeID)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':schoolYearID', $this->schoolYearID);
        $stmt->bindParam(':semesterID', $this->semesterID);
        $stmt->bindParam(':feeID', $this->feeID);
        var_dump($this->schoolYearID, $this->semesterID, $this->feeID); // Debugging output
        if ($stmt->execute()) {
            return true;
        } else {
            $error = $stmt->errorInfo();
            throw new Exception("Failed to add fee schedule: " . $error[2]);
        }
    }    
    
    //method to get all school years
public function getSchoolYears() {
    //retrieve school year from database
    $sql = "SELECT DISTINCT school_year_name, school_year_id FROM school_year ORDER BY school_year_id DESC";
    //prepare statement then execute tas fetch all to return para query associative array
    $stmt = $this->db->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //arraymap built in function it maps
    return array_map(function($year) {
        return array('value' => $year['school_year_id'], 'label' => $year['school_year_name']);
    }, $result);
}

//method to get all semesters
public function getSemesters() {
    //retrieve semester from database
    $sql = "SELECT DISTINCT semester_name, semester_id FROM semester ORDER BY semester_id ASC";
    $stmt = $this->db->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return array_map(function($semester) {
        return array('value' => $semester['semester_id'], 'label' => $semester['semester_name']);
    }, $result);
}

}

// //method to get all fee schedules
    // public function getAll() {
    //     $sql = "SELECT fee_schedule.*, school_year.school_year, semester.semester
    //             FROM fee_schedule
    //             JOIN school_year ON fee_schedule.school_year_id = school_year.school_year_id
    //             JOIN semester ON fee_schedule.semester_id = semester.semester_id";
    //     $stmt = $this->db->connect()->prepare($sql);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
?>

<?php

require_once 'database.class.php';

class Student {
    public $studentID;
    public $studentPersonalID;
    public $studentFname;
    public $studentMname;
    public $studentLname;
    public $studentYearLevel;
    public $studentEmail;
    public $studentCollege;


    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createStudent() {
        try {

            $studentCollegeSql = "SELECT college_id FROM colleges WHERE college_id = :college_id";
            $studentCollegeStmt = $this->db->connect()->prepare($studentCollegeSql);
            $studentCollegeStmt->bindParam(':college_id', $this->studentCollege);
            $studentCollegeStmt->execute();
            $studentCollegeID = $studentCollegeStmt->fetchColumn();

            $insertSql = "INSERT INTO student (student_personal_id, student_fname, student_mname, student_lname, year_level, student_email, college_id) VALUES (:student_personal_id, :student_fname, :student_mname, :student_lname, :year_level, :student_email, :college_id)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':student_personal_id', $this->studentPersonalID);
            $insertStmt->bindParam(':student_fname', $this->studentFname);
            $insertStmt->bindParam(':student_mname', $this->studentMname);
            $insertStmt->bindParam(':student_lname', $this->studentLname);
            $insertStmt->bindParam(':year_level', $this->studentYearLevel);
            $insertStmt->bindParam(':student_email', $this->studentEmail);
            $insertStmt->bindParam(':college_id', $studentCollegeID);
            $insertStmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function showAllDetails() {
        $sql = "SELECT s.id, s.first_name, s.last_name, s.student_email, s.year_level, s.payment_status, s.outstanding_balance, c.college_name, p.program_name 
                FROM students s
                JOIN colleges c ON s.college_id = c.id
                JOIN programs p ON s.program_id = p.id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function show(){
        $sql = "SELECT * FROM `student` ORDER BY `student`.`student_id` ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function delete(){
        $sql = "DELETE FROM student WHERE student_id=:student_id";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':student_id', $this->studentID);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

   
}

?>
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
        $sql = "SELECT spi.student_personal_id, sfn.student_fname, smn.student_mname, sln.student_lname, syr.year_level, se.student_email, ci.college_code
                FROM student s
                JOIN student spi ON spi.student_id = s.student_id
                JOIN student sfn ON sfn.student_id = s.student_id
                JOIN student smn ON smn.student_id = s.student_id
                JOIN student sln ON sln.student_id = s.student_id
                JOIN student syr ON syr.student_id = s.student_id
                JOIN student se ON se.student_id = s.student_id
                JOIN colleges ci ON ci.college_id = s.college_id";
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
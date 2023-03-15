<?php

require_once 'database.class.php';

class Student {
    public $studentID;
    public $studentFname;
    public $studentLname;
    public $studentYearLevel;
    public $programName;
    public $studentEmail;
    public $studentCollege;
    public $programID;


    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function createStudent() {
        try {

            $studentCollegeSql = "SELECT id FROM colleges WHERE id = :college_id";
            $studentCollegeStmt = $this->db->connect()->prepare($studentCollegeSql);
            $studentCollegeStmt->bindParam(':college_id', $this->studentCollege);
            $studentCollegeStmt->execute();
            $studentCollegeID = $studentCollegeStmt->fetchColumn();

            $programSql = "SELECT id FROM programs WHERE id = :program_id";
            $programStmt = $this->db->connect()->prepare($programSql);
            $programStmt->bindParam(':program_id', $this->programID);
            $programStmt->execute();
            $programID = $programStmt->fetchColumn();

            $insertSql = "INSERT INTO students (id, first_name, last_name, year_level, student_email, college_id, program_id)
                        VALUES (:id, :first_name, :last_name, :year_level, :student_email, :college_id, :program_id)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':id', $this->studentID);
            $insertStmt->bindParam(':first_name', $this->studentFname);
            $insertStmt->bindParam(':last_name', $this->studentLname);
            $insertStmt->bindParam(':year_level', $this->studentYearLevel);
            $insertStmt->bindParam(':student_email', $this->studentEmail);
            $insertStmt->bindParam(':college_id', $studentCollegeID);
            $insertStmt->bindParam(':program_id', $programID);
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
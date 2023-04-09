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
    public $outstandingBalance; 

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function showAllDetailsStudentCollege() {
        $sql = "SELECT s.id, s.first_name, s.last_name, s.student_email, s.year_level, s.payment_status, s.outstanding_balance, c.college_name, p.program_name 
                FROM students s
                JOIN colleges c ON s.college_id = c.id
                JOIN programs p ON s.program_id = p.id
                 WHERE c.college_id = :college_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':college_id', $_SESSION['collegeID']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOutstandingBalance($studentID, $paymentAmount) {
        // I miss you
        $outstandingBalance = $this->getOutstandingBalance();
            
        // sana
        $newOutstandingBalance = $outstandingBalance - $paymentAmount;
    
        // update 
        $stmt = $this->db->connect()->prepare("UPDATE students SET outstanding_balance = :newBalance WHERE id = :studentID");
        $stmt->bindParam(':newBalance', $newOutstandingBalance);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->execute();
    
        // update 
        $this->outstandingBalance = $newOutstandingBalance;
    }
    

    public function getOutstandingBalance() {
        $stmt = $this->db->connect()->prepare("SELECT outstanding_balance FROM students WHERE id = :studentID");
        $stmt->bindParam(':studentID', $this->studentID);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    //this time order by id and limit the result by 10 for less query.
    public function searchStudents($searchValue, $collegeID) {
    
        if(is_numeric($searchValue)) {
            $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.payment_status, s.outstanding_balance, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
                    FROM students s
                    INNER JOIN programs p ON s.program_id = p.id
                    INNER JOIN colleges c ON s.college_id = c.id
                    WHERE s.id = :searchValue AND s.college_id = $collegeID
                    ORDER BY s.id DESC
                    LIMIT 10";
        } else {
            $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
                    FROM students s
                    INNER JOIN programs p ON s.program_id = p.id
                    INNER JOIN colleges c ON s.college_id = c.id
                    WHERE CONCAT(s.first_name, ' ', s.last_name) LIKE :searchTerm AND s.college_id = $collegeID
                    ORDER BY s.id DESC
                    LIMIT 10";
            $searchTerm = "%{$searchValue}%";
        }
    
        $stmt = $this->db->connect()->prepare($sql);
        if(isset($searchTerm)) {
            $stmt->bindParam(':searchTerm', $searchTerm);
        } else {
            $stmt->bindParam(':searchValue', $searchValue);
        }
        $stmt->execute();
        return $stmt->fetchAll();
}



    // public function searchStudents($searchValue, $collegeID) {
    
    //     if(is_numeric($searchValue)) {
    //         $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.payment_status, s.outstanding_balance, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
    //                 FROM students s
    //                 INNER JOIN programs p ON s.program_id = p.id
    //                 INNER JOIN colleges c ON s.college_id = c.id
    //                 WHERE s.id = :searchValue AND s.college_id = $collegeID LIMIT 10";
    //     } else {
    //         $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
    //                 FROM students s
    //                 INNER JOIN programs p ON s.program_id = p.id
    //                 INNER JOIN colleges c ON s.college_id = c.id
    //                 WHERE CONCAT(s.first_name, ' ', s.last_name) LIKE :searchTerm AND s.college_id = $collegeID LIMIT 10";
    //         $searchTerm = "%{$searchValue}%";
    //     }
    
    //     $stmt = $this->db->connect()->prepare($sql);
    //     if(isset($searchTerm)) {
    //         $stmt->bindParam(':searchTerm', $searchTerm);
    //     } else {
    //         $stmt->bindParam(':searchValue', $searchValue);
    //     }
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }

    // public function searchStudents($searchValue, $collegeID) {
    
    //     if(is_numeric($searchValue)) {
    //         $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.payment_status, s.outstanding_balance, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
    //                 FROM students s
    //                 INNER JOIN programs p ON s.program_id = p.id
    //                 INNER JOIN colleges c ON s.college_id = c.id
    //                 WHERE s.id = :searchValue AND s.college_id = $collegeID";
    //     } else {
    //         $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
    //         FROM students s
    //         INNER JOIN programs p ON s.program_id = p.id
    //         INNER JOIN colleges c ON s.college_id = c.id
    //         WHERE CONCAT(s.first_name, ' ', s.last_name) LIKE :searchTerm AND s.college_id = $collegeID";
    //         $searchTerm = "%{$searchValue}%";
    //     }
    
    //     $stmt = $this->db->connect()->prepare($sql);
    //     if(isset($searchTerm)) {
    //         $stmt->bindParam(':searchTerm', $searchTerm);
    //     } else {
    //         $stmt->bindParam(':searchValue', $searchValue);
    //     }
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }
   
    function showAllDetailsBystudentId($student_id) {
        $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.college_id, s.outstanding_balance, p.program_name, s.student_email, c.college_name, c.college_code
        FROM students s
        INNER JOIN programs p ON s.program_id = p.id
        INNER JOIN colleges c ON s.college_id = c.id
                WHERE s.id = :student_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentById($id) {
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getStudents() {
        $sql = "SELECT * FROM students";
        $stmt = $this->db->connect()->query($sql);
        return $stmt->fetchAll();
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
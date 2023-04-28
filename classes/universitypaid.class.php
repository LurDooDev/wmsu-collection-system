<?php

require_once 'database.class.php';

class UniversityPaid {
    public $id;
    public $studentid;
    public $universityfeeid;
    public $pendingAmount;
    public $universityStatus;

    public $db;

    function __construct() {
        $this->db = new Database();
    }

    function showAllPaidBystudentId($student_id) {
        $sql = "SELECT up.id, up.paid_amount, up.university_status, up.payment_date, uf.fee_type, uf.fee_name, ay.academic_name, ss.semester_name
        FROM university_paid up
        INNER JOIN students s ON up.student_id = s.id
        INNER JOIN university_fees uf ON up.university_fee_id = uf.id
        INNER JOIN academic_year ay ON uf.academic_year_id = ay.id
        INNER JOIN semesters ss ON uf.semester_id = ss.id
                WHERE up.student_id = :student_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function showAllFeesBystudentId($student_id) {
        $sql = "SELECT up.id, up.pending_amount, up.university_status, uf.fee_type, s.first_name, s.last_name, uf.fee_name, ay.academic_name, ss.semester_name
        FROM university_pending up
        INNER JOIN students s ON up.student_id = s.id
        INNER JOIN university_fees uf ON up.university_fee_id = uf.id
        INNER JOIN academic_year ay ON uf.academic_year_id = ay.id
        INNER JOIN semesters ss ON uf.semester_id = ss.id
                WHERE up.student_id = :student_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUniversityPendingFees($studentid) {
        try {
            $conn = $this->db->connect();
            $stmt = $conn->prepare("SELECT * FROM university_pending WHERE studentid = :studentid");
            $stmt->bindParam(":studentid", $studentid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    
    
}
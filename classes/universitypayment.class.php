<?php

require_once 'database.class.php';

class UniversityPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function savePayment($studentID, $feeID, $feeamount, $amount, $collectedBy, $paymentDate, $paymentDetails, $receiptNumber) {
        $paymentDetails['receipt_number'] = $receiptNumber;
        $sql = "INSERT INTO university_payment (student_id, fee_schedule_id, payment_fee_amount, payment_amount, collected_by, payment_date, payment_details, receipt_number) 
                VALUES (:studentID, :feeScheduleID, :feeamount, :amount, :collectedBy, :paymentDate, :paymentDetails, :receiptNumber)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeID);
        $stmt->bindParam(':feeamount', $feeamount);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':collectedBy', $collectedBy);
        $stmt->bindParam(':paymentDate', $paymentDate);
        $stmt->bindParam(':paymentDetails', $paymentDetails);
        $stmt->bindParam(':receiptNumber', $receiptNumber);
        $stmt->execute();
        return true;
    }

    public function getPaymentDetails($studentID, $feeID) {
        $sql = "SELECT * FROM university_payment WHERE student_id = :studentID AND fee_schedule_id = :feeScheduleID";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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

    function showAllDetailsBystudentId($student_id) {
        $sql = "SELECT s.id, s.first_name, s.last_name, s.year_level, s.college_id, p.program_name, s.student_email, c.college_name, c.college_code
        FROM students s
        INNER JOIN programs p ON s.program_id = p.id
        INNER JOIN colleges c ON s.college_id = c.id
                WHERE s.id = :student_id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
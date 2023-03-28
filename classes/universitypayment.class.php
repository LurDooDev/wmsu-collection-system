<?php

require_once 'database.class.php';

class UniversityPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function savePayment($studentID, $feeScheduleID, $feeamount, $amount, $collectedBy, $paymentDate, $paymentDetailsJson, $receiptNumber) {
        $paymentDetails = json_decode($paymentDetailsJson, true);
        $sql = "INSERT INTO university_payment (student_id, fee_schedule_id, payment_fee_amount, payment_amount, collected_by, payment_date, payment_details, receipt_number) 
                VALUES (:studentID, :feeScheduleID, :feeamount, :amount, :collectedBy, :paymentDate, :paymentDetails, :receiptNumber)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeScheduleID);
        $stmt->bindParam(':feeamount', $feeamount);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':collectedBy', $collectedBy);
        $stmt->bindParam(':paymentDate', $paymentDate);
        $stmt->bindParam(':paymentDetails', $paymentDetails);
        $stmt->bindParam(':receiptNumber', $receiptNumber);
        $stmt->execute();
        return true;
    }

    public function getPaymentDetails($studentID, $feeScheduleID) {
        $sql = "SELECT * FROM university_payment WHERE student_id = :studentID AND fee_schedule_id = :feeScheduleID";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeScheduleID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
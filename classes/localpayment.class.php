<?php

require_once 'database.class.php';

class LocalPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function savePayment($studentID, $feeScheduleID, $feeamount, $paymentAmount, $collectedBy, $paymentDate, $paymentDetailsJson, $receiptNumber, $paymentImage) {
        $paymentDetails = json_decode($paymentDetailsJson, true);
        $payment_remaining = $feeamount - $paymentAmount;
        $payment_status = ($payment_remaining == 0) ? 1 : 0;
        $sql = "INSERT INTO local_payment (student_id, fee_schedule_id, payment_fee_amount, payment_amount, payment_remaining, payment_status, collected_by, payment_date, payment_details, receipt_number, payment_image) 
                VALUES (:studentID, :feeScheduleID, :feeamount, :amount, :payment_remaining, :payment_status, :collectedBy, :paymentDate, :paymentDetails, :receiptNumber, :paymentImage)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeScheduleID);
        $stmt->bindParam(':feeamount', $feeamount);
        $stmt->bindParam(':amount', $paymentAmount);
        $stmt->bindParam(':payment_remaining', $payment_remaining);
        $stmt->bindParam(':payment_status', $payment_status);
        $stmt->bindParam(':collectedBy', $collectedBy);
        $stmt->bindParam(':paymentDate', $paymentDate);
        $stmt->bindParam(':paymentDetails', $paymentDetails);
        $stmt->bindParam(':receiptNumber', $receiptNumber);
        $stmt->bindParam(':paymentImage', $paymentImage, PDO::PARAM_LOB);
        $stmt->execute();
        return true;
    }


    public function getPaymentDetails($studentID, $feeScheduleID) {
        $sql = "SELECT * FROM local_payment WHERE student_id = :studentID AND fee_schedule_id = :feeScheduleID";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':feeScheduleID', $feeScheduleID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
<?php

require_once 'database.class.php';

class LocalPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPaymentsByStudentId($studentId) {
        $query = " SELECT lp.id, lp.student_id, lf.local_fee_type, lp.fee_schedule_id, lp.receipt_number, lp.payment_amount, lp.payment_status, lp.collected_by, lp.payment_date, lp.payment_fee_amount, lp.payment_remaining, lf.local_name
        FROM local_payment lp
        JOIN students s ON lp.student_id = s.id
        JOIN local_fee_schedule lfs ON lp.fee_schedule_id = lfs.id
        JOIN local_fee lf ON lfs.local_fee_id  = lf.id
        WHERE lp.student_id = :studentId";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $payments;
    }

    public function getPaymentsByStatusAndStudentId($status, $studentId) {
        $query = "SELECT lp.id, lp.student_id, lf.local_fee_type, lp.fee_schedule_id, lp.payment_amount, lp.receipt_number, lp.payment_status, lp.collected_by, lp.payment_date, lp.payment_fee_amount, lp.payment_remaining, lf.local_name
        FROM local_payment lp
        JOIN students s ON lp.student_id = s.id
        JOIN local_fee_schedule lfs ON lp.fee_schedule_id = lfs.id
        JOIN local_fee lf ON lfs.local_fee_id  = lf.id
        WHERE lp.payment_status = :status AND student_id = :studentId";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $payments;
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
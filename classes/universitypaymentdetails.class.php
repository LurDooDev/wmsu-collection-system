<?php

require_once 'database.class.php';

class UniversityPaymentDetails {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function moveFeesToPaid($studentId, $selectedFees) {
        // Retrieve the pending fees by IDs and student ID
        $sql = "SELECT * FROM university_pending WHERE id IN (" . implode(',', $selectedFees) . ") AND student_id = :studentId";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentId', $studentId);
        $stmt->execute();
        $pendingFees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Insert the pending fees into the paid table
        foreach($pendingFees as $fee) {
            $sql = "INSERT INTO university_paid (student_id, university_fee_id, paid_amount) VALUES (:studentId, :university_fee_id, :feeAmount)";
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindParam(':studentId', $studentId);
            $stmt->bindParam(':university_fee_id', $fee['university_fee_id']);
            $stmt->bindParam(':feeAmount', $fee['pending_amount']);
            $stmt->execute();
        }
    
        // Delete the pending fees
        $sql = "DELETE FROM university_pending WHERE id IN (" . implode(',', $selectedFees) . ") AND student_id = :studentId";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentId', $studentId);
        $stmt->execute();
    }
    

    public function processPayment($studentID, $paymentAmount, $paymentDateTime, $paymentReference, $paidItems, $collectedBy) {
        $sql = "INSERT INTO university_payment_details (student_id, payment_amount, payment_datetime, payment_reference, paid_items, collected_by) VALUES (:studentID, :paymentAmount, :paymentDateTime, :paymentReference, :paidItems, :collected_by)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->bindParam(':paymentAmount', $paymentAmount);
        $stmt->bindParam(':paymentDateTime', $paymentDateTime);
        $stmt->bindParam(':paymentReference', $paymentReference);
        $stmt->bindParam(':paidItems', $paidItems);
        $stmt->bindParam(':collected_by', $collectedBy);
        $stmt->execute();
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
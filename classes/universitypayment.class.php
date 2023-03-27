<?php

require_once 'database.class.php';

class UniversityPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveUniversityPayment($studentId, $feeScheduleId, $processBy) {
        $paymentStatus = 'Paid'; // Default payment status

        // Insert payment data into university_payment table
        $stmt = $this->db->connect()->prepare('INSERT INTO university_payment (student_id, fee_schedule_id, payment_status, process_by) VALUES (:student_id, :fee_schedule_id, :payment_status, :process_by)');
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':fee_schedule_id', $feeScheduleId);
        $stmt->bindParam(':payment_status', $paymentStatus);
        $stmt->bindParam(':process_by', $processBy);
        $stmt->execute();

        $paymentId = $this->db->connect()->lastInsertId(); // Get the payment ID of the newly created payment

        if ($paymentId) {
            // Payment was successfully saved, show success message to the user
            echo 'Payment was successfully saved with ID ' . $paymentId;
        } else {
            // Payment was not saved, show error message to the user
            echo 'Payment was not saved';
        }
    }
}
?>
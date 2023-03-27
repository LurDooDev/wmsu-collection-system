<?php

require_once '../classes/database.class.php';

// Get the student_id and fee_schedule_id from the URL
$student_id = $_GET['student_id'];
$fee_schedule_id = $_GET['fee_schedule_id'];

// TODO: validate the input values and make sure they are not empty or invalid

// Save the payment information in the database
$sql = "INSERT INTO university_payment (student_id, fee_schedule_id, payment_status, payment_amount, payment_date, process_by) VALUES (:student_id, :fee_schedule_id, :payment_status, :payment_amount, :payment_date, :process_by)";
$stmt = $this->db->connect()->prepare($sql);
$stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
$stmt->bindValue(':fee_schedule_id', $fee_schedule_id, PDO::PARAM_INT);
$stmt->bindValue(':payment_status', 'paid', PDO::PARAM_STR);
$stmt->bindValue(':payment_amount', $amount, PDO::PARAM_INT);
$stmt->bindValue(':payment_date', date('Y-m-d'), PDO::PARAM_STR);
$stmt->bindValue(':process_by', 'user', PDO::PARAM_STR);
$stmt->execute();

?>
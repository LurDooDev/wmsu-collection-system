<?php
require_once '../classes/database.class.php';

// Retrieve student ID from the form submission
$studentId = $_POST['student_id'];

if(isset($_POST['fees'])){
    $selectedFees = $_POST['fees'];
    foreach($selectedFees as $feeId){
        // process each selected fee
    }
}


// Insert a new row in the payment_details table to record the transaction details
$stmt = $pdo->prepare("INSERT INTO payment_details (student_id, amount_paid, date_time) VALUES (:student_id, :amount_paid, NOW())");
$stmt->bindParam(':student_id', $studentId);
$stmt->bindParam(':amount_paid', $totalAmount);
$stmt->execute();

// Redirect the user to a confirmation page
header('Location: universitypayment_confirmation.php');
exit();

?>

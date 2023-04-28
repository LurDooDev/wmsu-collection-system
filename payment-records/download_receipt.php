<?php

require_once '../classes/database.class.php';

// Create a new database connection
$db = new Database();

// Retrieve the payment details for the given payment ID
$paymentId = $_GET['payment_id'];
$sql = "SELECT * FROM university_payment_details WHERE id = :paymentId";
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':paymentId', $paymentId);
$stmt->execute();
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

// Set the HTTP headers to force a download of the PDF file
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $payment['payment_reference'] . '.pdf"');


<?php
require_once '../classes/database.class.php';
require_once "../classes/universitypending.class.php";
require_once "../classes/universitypaid.class.php";
require_once "../classes/univeristypayment.class.php";
require_once "../classes/universitypaymentdetails.class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fees'])) {
  // Get selected fees from POST request
  $feesIds = $_POST['fees'];

  // Initialize database connection
  $db = new Database();

  // Initialize UniversityPaid and UniversityPending classes
  $paidFees = new UniversityPaid();
  $pendingFees = new UniversityPending();

  // Initialize Payment and PaymentDetails classes
  $payment = new UniversityPayment();
  $paymentDetails = new UniversityPaymentDetails();

  // Get student ID from session or POST request
  $studentId = $_POST['student_id'];

  // Get total amount of selected fees
  $totalAmount = 0;
  foreach ($feesIds as $feeId) {
    $fee = $pendingFees->getFeeById($feeId);
    $totalAmount += $fee['pending_amount'];
  }

  // Insert payment record
  $paymentId = $payment->addPayment($studentId, $totalAmount);

  // Insert payment details record for each selected fee
  foreach ($feesIds as $feeId) {
    $fee = $pendingFees->getFeeById($feeId);

    // Add payment details record
    $paymentDetails->addPaymentDetails($paymentId, $fee['id'], $fee['pending_amount']);

    // Move fee from pending to paid
    $paidFees->addPaidFee($fee['academic_id'], $fee['semester_id'], $fee['fee_id'], $fee['student_id'], $fee['pending_amount']);
    $pendingFees->removePendingFee($fee['id']);
  }

  // Redirect to payment success page
  header("Location: payment_success.php");
  exit();
} else {
  // Redirect to payment failure page
  header("Location: payment_failure.php");
  exit();
}

?>
<?php
require_once '../classes/universitypayment.class.php';
require_once '../classes/student.class.php';
require_once '../classes/universityfeeSched.class.php';
session_start();
require_once '../functions/session.function.php';

if(isset($_POST['payment_amount'])) {
    $paymentAmount = $_POST['payment_amount'];
} else {
    $paymentAmount = 0;
}

$payment = new UniversityPayment();
$studentID = $_GET['studentID'];
$feeScheduleID = $_GET['universityID'];

// Retrieve student name and college from database using student ID
if (isset($_GET['studentID'])) {
    $studentId = $_GET['studentID'];
    $student = new Student();
    $studentData = $student->showAllDetailsBystudentId($studentId); 
    foreach($studentData as $student) {        
        $studentName = $student['first_name'] . ' ' . $student['last_name'];
        $college = $student['college_name'];
        $program = $student['program_name'];
        $year_level = $student['year_level'];
    }
} else {
    echo 'Student not found.';
    exit;
}

// Retrieve fee amount from database using fee schedule ID
if (isset($_GET['universityID'])) {
    $feeId = $_GET['universityID'];
    $FeeSched = new UniversityFeeSched();
    $FeeSchedData = $FeeSched->showAllDetailsByPayId($feeId);
    foreach($FeeSchedData as $FeeSched) { 
        $feeAmount = $FeeSched['university_amount'];
        $description = $FeeSched['university_name'];
        $type = $FeeSched['university_fee_type'];
    }
} else {
    echo 'Fee schedule not found.';
    exit;
}

if ($paymentAmount >= $feeAmount) {
    $paymentStatus = 1; // full payment
    $paymentRemaining = 0;
} else {
    $paymentStatus = 0; // partial payment
    $paymentRemaining = $feeAmount - $paymentAmount;
}

// Get other payment details from POST data
$collectedBy = $UserFullname;
$paymentDate = date('Y-m-d H:i:s');
$receiptNumber = 'WMSU' . date('YmdHis') . rand(1000, 9999);

$paymentDetails = [
    'receipt' => $receiptNumber,
    'student_id' => $studentID,
    'name' => $studentName,
    'college' => $college,
    'program' => $program,
    'yearlevel' => $year_level,
    'type' => $type,
    'feename' => $description,
    'amount' => $feeAmount,
    'totalamount' => $paymentAmount,
    'collected_by' => $collectedBy,
    'payment_date' => $paymentDate,
    'payment_status' => $paymentStatus,
    'payment_remaining' => $paymentRemaining
];

$paymentDetailsJson = json_encode($paymentDetails);
if ($payment->savePayment($studentID, $feeScheduleID, $feeAmount, $paymentAmount, $collectedBy, $paymentDate, $paymentDetailsJson, $receiptNumber)) {
    header('location: university-complete.php');
} else {
    echo "Failed to save payment.";
}
?>

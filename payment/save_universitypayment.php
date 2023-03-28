<?php
  require_once '../classes/universitypayment.class.php';
  require_once '../classes/student.class.php';
  require_once '../classes/universityfeeSched.class.php';
  session_start();
  require_once '../functions/session.function.php';

  if (isset($_POST['paymentAmount']) && isset($_POST['studentID']) && isset($_POST['universityID'])) {
    $paymentAmount = $_POST['paymentAmount'];
    $studentID = $_POST['studentID'];
    $feeScheduleID = $_POST['universityID'];
  
    // Retrieve student name and college from database using student ID
    $student = new Student();
    $studentData = $student->showAllDetailsBystudentId($studentID); 
    foreach($studentData as $student) {        
      $studentName = $student['first_name'] . ' ' . $student['last_name'];
      $college = $student['college_name'];
      $program = $student['program_name'];
      $year_level = $student['year_level'];
    }

    // Retrieve fee amount from database using fee schedule ID
    $FeeSched = new UniversityFeeSched();
    $FeeSchedData = $FeeSched->showAllDetailsByPayId($feeScheduleID);
    foreach($FeeSchedData as $FeeSched) { 
      $feeAmount = $FeeSched['university_amount'];
      $description = $FeeSched['university_name'];
      $type = $FeeSched['university_fee_type'];
    }

    // Calculate remaining payment amount
    $remainingAmount = $feeAmount - $paymentAmount;
    $paymentStatus = $remainingAmount > 0 ? 0 : 1;

    // Get other payment details
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
        'payment_remaining' => $remainingAmount,
        'payment_status' => $paymentStatus,
        'collected_by' => $collectedBy,
        'payment_date' => $paymentDate,
    ];

    $paymentDetailsJson = json_encode($paymentDetails);
    $payment = new UniversityPayment();

    if ($payment->savePayment($studentID, $feeScheduleID, $feeAmount, $paymentAmount, $collectedBy, $paymentDate, $paymentDetailsJson, $receiptNumber, $remainingAmount, $paymentStatus)) {
        header('location: university-complete.php');
    } else {
      echo "Failed to save payment.";
    }
  } else {
    echo "Payment amount, student ID and fee schedule ID are required.";
  }
?>





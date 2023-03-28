<?php

  require_once '../classes/universitypayment.class.php';
  require_once '../classes/student.class.php';
  require_once '../classes/universityFeeSched.class.php';
  session_start();
  require_once '../functions/session.function.php';


  $payment = new UniversityPayment();
  $studentID = $_GET['studentID'];
  $feeScheduleID = $_GET['universityID'];
  
  // Retrieve student name and college from database using student ID
  $studentDetails = $payment->showAllDetailsBystudentId($studentID);
  $studentName = $studentDetails['first_name'] . ' ' . $studentDetails['last_name'];
  $college = $studentDetails['college_name'];
  $program = $studentDetails['program_name'];
  $year_level = $studentDetails['year_level'];

  // Retrieve fee amount from database using fee schedule ID
  $feeScheduleDetails = $payment->showAllDetailsByPayId($feeID);
  $feeamount = $feeScheduleDetails['university_amount'];
  $amount = $feeamount; //since its required then its equavalent.
  $description = $feeScheduleDetails['fee_name'];
  $type = $feeScheduleDetails['university_fee_type'];
 
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
    'amount' => $feeamount,
    'totalamount' => $amount,
    'collected_by' => $collectedBy,
    'payment_date' => $paymentDate,
  ];

    if ($payment->savePayment($studentID, $feeID, $feeamount, $amount, $collectedBy, $paymentDate, $paymentDetails, $receiptNumber)) {
      echo "Payment saved successfully.";
    } else {
      echo "Failed to save payment.";
    }
?>

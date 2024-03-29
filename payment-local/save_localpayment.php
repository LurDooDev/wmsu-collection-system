<?php
  require_once '../classes/localpayment.class.php';
  require_once '../classes/student.class.php';
  require_once '../classes/localfeeSched.class.php';
  session_start();
  require_once '../functions/session.function.php';

  // Check if all required parameters are set
  if (isset($_POST['paymentAmount'], $_POST['studentID'], $_POST['localID'])) {
    $paymentAmount = $_POST['paymentAmount'];
    $studentID = $_POST['studentID'];
    $feeScheduleID = $_POST['localID'];
  
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
    $FeeSched = new LocalFeeSched();
    $FeeSchedData = $FeeSched->showAllDetailsByPayId($feeScheduleID);
    foreach($FeeSchedData as $FeeSched) { 
      $feeAmount = $FeeSched['local_amount'];
      $description = $FeeSched['local_name'];
      $type = $FeeSched['local_fee_type'];
    }

    // Get other payment details
    $collectedBy = $UserFullname; 
    $paymentDate = date('Y-m-d H:i:s');
    $receiptNumber = 'WMSULocal' . date('YmdHis') . rand(1000, 9999);



    if (!empty($_FILES["paymentImage"]["tmp_name"])) {
      $target_dir = "../images/promissory/local/";
      $target_file = $target_dir . basename($_FILES["paymentImage"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $target_file = $target_dir . $studentName . $receiptNumber . '.' . $imageFileType;
      
      // Check if file is a valid image
      $check = getimagesize($_FILES["paymentImage"]["tmp_name"]);
      if($check !== false) {
          // Check file size
          if ($_FILES["paymentImage"]["size"] > 10000000) {
              echo "Sorry, your file is too large.";
              exit;
          }
          // Allow only certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
              echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
              exit;
          }
          
          // Save image file to server
          if (move_uploaded_file($_FILES["paymentImage"]["tmp_name"], $target_file)) {
              $paymentImage = basename($target_file);
          } else {
              echo "Sorry, there was an error uploading your file.";
              exit;
          }
      } else {
          $paymentImage = null;
      }
  } else {
      $paymentImage = null;
  }

    // Create payment details array
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
    ];

   

$remainingBalance = $feeAmount - $paymentAmount;


if ($remainingBalance > 0) {
  $students = new Student();
    $students->updateOutstandingBalance($studentID, $remainingBalance);
}


 
    $paymentDetails = json_encode($paymentDetails);
    $paymentDetailsJson = json_encode($paymentDetails);

    $payment = new LocalPayment();
    if ($payment->savePayment($studentID, $feeScheduleID, $feeAmount, $paymentAmount, $collectedBy, $paymentDate, $paymentDetailsJson, $receiptNumber, $paymentImage)) {
        header('location: local-complete.php');
    } else {
      echo "Failed to save payment.";
    }
  }
  ?>



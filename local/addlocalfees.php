<?php 
require_once '../classes/database.class.php';
require_once "../classes/localfees.class.php";

if (isset($_POST['action']) && $_POST['action'] == 'Save') {
    
    $localName = htmlspecialchars($_POST['name']);
    $localAmount = htmlspecialchars($_POST['amount']);
    $localStartDate = htmlspecialchars($_POST['startdate']);
    $localEndDate = htmlspecialchars($_POST['enddate']);
    $localcreatedby = htmlspecialchars($_POST['created_by']);
    $localSemesterID = htmlspecialchars($_POST['semesterID']);
    $academicYearID = htmlspecialchars($_POST['academicYearID']);
    $collegeID = htmlspecialchars($_POST['college_id']);

    $localFee = new LocalFees();
    $localFee->localName = $localName;
    $localFee->localAmount = $localAmount;
    $localFee->semesterID = $localSemesterID;
    $localFee->academicYearID = $academicYearID;
    $localFee->localStartDate = $localStartDate;
    $localFee->localEndDate = $localEndDate;
    $localFee->localcreatedby = $localcreatedby;
    $localFee->collegeID = $collegeID;

    
    if ($localFee->createLocalFees()) {
        header('location: localfees.php');
    } else {
        echo 'Failed to add fee.';
    }
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $localAmount)) {
        echo 'Invalid amount. Please enter a valid number.';
        exit;
    }
    
}


?>
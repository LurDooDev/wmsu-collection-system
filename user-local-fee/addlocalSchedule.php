<?php 
require_once '../classes/database.class.php';
require_once "../classes/localfeeSched.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $localFeeID = htmlspecialchars($_POST['localID']);
    $SemesterID = htmlspecialchars($_POST['semesterID']);
    $academicYearID = htmlspecialchars($_POST['academicYearID']);
    $Amount = htmlspecialchars($_POST['amount']);
    $collegeID = htmlspecialchars($_POST['collegeID']);
    $createdby = htmlspecialchars($_POST['created_by']);
    
    $LocalFee = new LocalFeeSched();
    $LocalFee->localFeeID = $localFeeID;
    $LocalFee->semesterID = $SemesterID;
    $LocalFee->academicYearID = $academicYearID;
    $LocalFee->localAmount = $Amount;
    $LocalFee->collegeID = $collegeID;
    $LocalFee->localcreatedby = $createdby;
    
    if ($LocalFee->createLocalFeeSched()) {
        header('location: local-fee.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
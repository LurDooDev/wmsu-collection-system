<?php 
require_once '../classes/database.class.php';
require_once "../classes/universityfeeSched.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $universityFeeID = htmlspecialchars($_POST['universityID']);
    $universitySemesterID = htmlspecialchars($_POST['semesterID']);
    $academicYearID = htmlspecialchars($_POST['academicYearID']);
    $universityAmount = htmlspecialchars($_POST['amount']);
    // $universityStartDate = htmlspecialchars($_POST['startdate']);
    // $universityEndDate = htmlspecialchars($_POST['enddate']);
    $universitycreatedby = htmlspecialchars($_POST['created_by']);
    
    $universityFee = new UniversityFeeSched();
    $universityFee->universityFeeID = $universityFeeID;
    $universityFee->semesterID = $universitySemesterID;
    $universityFee->universityAmount = $universityAmount;
    $universityFee->academicYearID = $academicYearID;
    // $universityFee->universityStartDate = $universityStartDate;
    // $universityFee->universityEndDate = $universityEndDate;
    $universityFee->universitycreatedby = $universitycreatedby;
    
    if ($universityFee->createUniversityFeeSched()) {
        header('location: university.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
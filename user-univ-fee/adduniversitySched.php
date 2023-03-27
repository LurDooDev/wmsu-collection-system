<?php 
require_once '../classes/database.class.php';
require_once "../classes/universityfeeSched.class.php";

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $universityFeeID = htmlspecialchars($_POST['universityID']);
    $universitySemesterID = htmlspecialchars($_POST['semesterID']);
    $academicYearID = htmlspecialchars($_POST['academicYearID']);
    $universityAmount = htmlspecialchars($_POST['amount']);
    $universitycreatedby = htmlspecialchars($_POST['created_by']);
    
    $universityFee = new UniversityFeeSched();
    $universityFee->universityFeeID = $universityFeeID;
    $universityFee->semesterID = $universitySemesterID;
    $universityFee->universityAmount = $universityAmount;
    $universityFee->academicYearID = $academicYearID;
    $universityFee->universitycreatedby = $universitycreatedby;
    
    if ($universityFee->createUniversityFeeSched()) {
        header('location: univer-fee.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
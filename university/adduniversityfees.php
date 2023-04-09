<?php 
require_once '../classes/database.class.php';
require_once "../classes/universityfees.class.php";

if (isset($_POST['action']) && $_POST['action'] == 'Save') {
    
    $universityName = htmlspecialchars($_POST['name']);
    $universityAmount = htmlspecialchars($_POST['amount']);
    $universitySemesterID = htmlspecialchars($_POST['semesterID']);
    $academicYearID = htmlspecialchars($_POST['academicYearID']);
    $universityStartDate = htmlspecialchars($_POST['startdate']);
    $universityEndDate = htmlspecialchars($_POST['enddate']);
    $universitycreatedby = htmlspecialchars($_POST['created_by']);
    
    $universityFee = new UniversityFees();
    $universityFee->universityName = $universityName;
    $universityFee->universityAmount = $universityAmount;
    $universityFee->semesterID = $universitySemesterID;
    $universityFee->academicYearID = $academicYearID;
    $universityFee->universityStartDate = $universityStartDate;
    $universityFee->universityEndDate = $universityEndDate;
    $universityFee->universitycreatedby = $universitycreatedby;
    
    if ($universityFee->createUniversityFees()) {
        header('location: university.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
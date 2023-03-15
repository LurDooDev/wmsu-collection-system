<?php 
require_once '../classes/database.class.php';
require_once "../classes/universityfeeSched.class.php";

if (!isset($_SESSION['logged_id'])) {
    header('location: ../public/logout.php');
} else if ($_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'officer') {
        header('location: officer.php');
    } else if ($_SESSION['role'] == 'collector') {
        header('location: collector.php');
    }
}
// Check if the form has been submitted
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
        header('location: university.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
<?php 
require_once '../classes/database.class.php';
require_once "../classes/academicyear.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $AcademicYear = new AcademicYear();
    $AcademicYear->academicYearName = htmlspecialchars($_POST['name']);
    $AcademicYear->academicStartDate = htmlspecialchars($_POST['startdate']);
    $AcademicYear->academicEndDate = htmlspecialchars($_POST['enddate']);

    if ($AcademicYear->create()) {
        header('location: admin-settings-user.php');
        exit();
    } 
}


?>
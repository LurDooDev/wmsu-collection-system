<?php 
require_once '../classes/database.class.php';
require_once "../classes/academicyear.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    
    $AcademicYear = new AcademicYear();
    $AcademicYear->academicStartDate = htmlspecialchars($_POST['startdate']);
    $AcademicYear->academicEndDate = htmlspecialchars($_POST['enddate']);
    $AcademicYear->isActive = htmlspecialchars($_POST['status']);
    $AcademicYear->academicYearID = htmlspecialchars($_POST['id']);
    
    if ($AcademicYear->update()) {
        header('Location: admin-settings-user.php');
        exit();
    }
    else {
        echo "noob";
    }
}


?>
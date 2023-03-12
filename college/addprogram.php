<?php 
require_once '../classes/database.class.php';
require_once "../classes/program.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $collegeID = htmlspecialchars($_POST['collegeID']);
    $programName = htmlspecialchars($_POST['program']);
    
    $Program = new Program();
    $Program->collegeID = $collegeID;
    $Program->programName = $programName;
    
    if ($Program->createProgram()) {
        header('location: college.php');
    } else {
        echo 'Failed to add program.';
    }
    
}


?>
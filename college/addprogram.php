<?php 
require_once '../classes/database.class.php';
require_once "../classes/program.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $collegeID = htmlspecialchars($_POST['collegeID']);
    $name = htmlspecialchars($_POST['name']);
    
    $Program = new Program();
    $Program->collegeID = $collegeID;
    $Program->programName = $name;
    
    if ($Program->createProgram()) {
        header('location: college.php');
    } else {
        echo 'Failed to add program.';
    }
    
}


?>
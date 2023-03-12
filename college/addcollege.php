<?php 
require_once '../classes/database.class.php';
require_once "../classes/college.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $code = htmlspecialchars($_POST['code']);
    $name = htmlspecialchars($_POST['name']);
    
    $College = new College();
    $College->collegeCode = $code;
    $College->collegeName = $name;
    
    if ($College->createCollege()) {
        header('location: college.php');
    } else {
        echo 'Failed to add program.';
    }
    
}


?>
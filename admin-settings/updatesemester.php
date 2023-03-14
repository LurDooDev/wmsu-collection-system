<?php 
require_once '../classes/database.class.php';
require_once "../classes/semester.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    
    $semester = new Semester();
    $semester->semesterName = htmlspecialchars($_POST['name']);
    $semester->semesterDuration = htmlspecialchars($_POST['duration']);
    $semester->isActive = htmlspecialchars($_POST['status']);
    $semester->semesterID = htmlspecialchars($_POST['id']);
    

      
    if ($semester->update()) {
        header('Location: overview_settings.php');
        exit();
    }
    else {
        echo "noob";
    }
}


?>
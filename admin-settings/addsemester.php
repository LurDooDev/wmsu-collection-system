<?php 
require_once '../classes/database.class.php';
require_once "../classes/semester.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $semester = new Semester();
    $semester->semesterName = htmlspecialchars($_POST['name']);
    $semester->semesterDuration = htmlspecialchars($_POST['duration']);

      
    if ($semester->create()) {
        header('location: overview_settings.php');
        exit();
    } 
}


?>
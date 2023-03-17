<?php 
require_once '../classes/database.class.php';
require_once '../classes/universityfees.class.php';

if (isset($_POST['action']) && $_POST['action'] == 'add') {

    $universityFee = new UniversityFee();
    $universityFee->universityName = htmlspecialchars($_POST['name']);
    $universityFee->universitycreatedby = htmlspecialchars($_POST['created_by']);
    
    if ($universityFee->createUniversityFee()) {
        header('location: university.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
<?php 
require_once '../classes/database.class.php';
require_once "../classes/universityfees.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $universityName = htmlspecialchars($_POST['name']);
    $universityAmount = htmlspecialchars($_POST['amount']);
    $universitycreatedby = htmlspecialchars($_POST['created_by']);
    
    $universityFee = new UniversityFee();
    $universityFee->universityName = $universityName;
    $universityFee->universityAmount = $universityAmount;
    $universityFee->universitycreatedby = $universitycreatedby;
    
    if ($universityFee->createUniversityFee()) {
        header('location: universitysched.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
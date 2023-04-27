<?php 
require_once '../classes/database.class.php';
require_once "../classes/localfees.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {

    $LocalFee = new LocalFees();
    $LocalFee->localName = htmlspecialchars($_POST['name']);
    $LocalFee->collegeID = htmlspecialchars($_POST['collegeID']);
    $LocalFee->createdBy = htmlspecialchars($_POST['created_by']);
    
    if ($LocalFee->createLocalFees()) {
        header('location: local-fee.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
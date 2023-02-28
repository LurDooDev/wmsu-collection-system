<?php 
require_once '../classes/database.class.php';
require_once "../classes/fee.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $feeType = htmlspecialchars($_POST['feeType']);
    $feeName = htmlspecialchars($_POST['feeName']);
    $feeAmount = htmlspecialchars($_POST['feeAmount']);
    
    $fee = new Fee();
    $fee->feeType = $feeType;
    $fee->feeName = $feeName;
    $fee->feeAmount = $feeAmount;
    
    if ($fee->createFee()) {
        header('location: feeschedpage.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}


?>
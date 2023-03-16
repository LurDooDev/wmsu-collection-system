<?php 
require_once '../classes/database.class.php';
require_once "../classes/fee.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    // Sanitize input data
    $feeType = htmlspecialchars($_POST['feeType']);
    $feeName = htmlspecialchars($_POST['feeName']);
    $feeAmount = htmlspecialchars($_POST['feeAmount']);
    
    // Check if any of the form fields are empty
    if (empty($feeType) || empty($feeName) || empty($feeAmount)) {
        echo 'All fields are required';
        exit();
    }

    // Validate fee amount: must be a positive number
    if (!is_numeric($feeAmount) || $feeAmount <= 0) {
        echo 'Invalid fee amount';
        exit();
    }

    // Create a new Fee object and set its properties
    $fee = new Fee();
    $fee->feeType = $feeType;
    $fee->feeName = $feeName;
    $fee->feeAmount = $feeAmount;
    
    // Add the fee to the database
    if ($fee->createFee()) {
        header('location: feeschedpage.php');
    } else {
        echo 'Failed to add fee.';
    }
    
}

?>

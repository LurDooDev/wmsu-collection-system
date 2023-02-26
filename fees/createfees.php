<?php 
require_once '../classes/database.class.php';
require_once "../classes/createfee.class.php";
require_once "../classes/feeSchedule.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {

    // Create a new Fee object and set its properties from the form input
    $fee = new Fee();
    $fee->feeType = htmlspecialchars($_POST['feeType']);
    $fee->feeAmount = htmlspecialchars($_POST['feeAmount']);
    $fee->feeName = htmlspecialchars($_POST['feeName']);
}
?>
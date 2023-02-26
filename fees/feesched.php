<?php 
require_once '../classes/database.class.php';
require_once '../classes/fee.class.php';
require_once '../classes/feeSchedule.class.php';

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'feeSchedAdd') {
    $fee = new Fee();
    $feeSchedule = new FeeSchedule();

    // Get the form data
    $feeID = $_POST['fee_id'];
    $schoolYearID = $_POST['schoolYear'];
    $semesterID = $_POST['semester'];

    // Get the fee data
    $feeData = $fee->get($feeID);

    // Insert the new fee schedule record
    $feeSchedule->add($feeID, $schoolYearID, $semesterID);

    // Redirect to the previous page
    header('Location: fees.php');
    exit();
}
?>
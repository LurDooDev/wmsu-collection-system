<?php 
require_once '../classes/database.class.php';
require_once "../classes/feeSchedule.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'save') {
    // Create a new FeeSchedule object
    $feeSchedule = new FeeSchedule();

    // Set the attribute values using the form data
    $feeSchedule->feeID = $_POST['fee'];
    $feeSchedule->schoolYearID = $_POST['schoolYear'];
    $feeSchedule->semesterID = $_POST['semester'];

    // Call the createFeeSchedule method to insert the new row into the fee_schedule table
    if ($feeSchedule->createFeeSchedule()) {
        // Redirect to a success page or display a success message
        header("Location: fees.php");
    } else {
        // Redirect to an error page or display an error message
        echo 'error';
    }
}

?>
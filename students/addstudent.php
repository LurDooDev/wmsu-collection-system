<?php 
require_once '../classes/database.class.php';
require_once "../classes/student.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // Create a new FeeSchedule object
    $students = new Student();

    $students->studentPersonalID = $_POST['studentID'];
    $students->studentFname = $_POST['firstname'];
    $students->studentMname = $_POST['middlename'];
    $students->studentLname = $_POST['lastname'];
    $students->studentYearLevel = $_POST['yearlevel'];
    $students->studentEmail = $_POST['email'];
    $students->studentCollege = $_POST['collegeCode'];

    // Call the createFeeSchedule method to insert the new row into the fee_schedule table
    if ($students->createStudent()) {
        // Redirect to a success page or display a success message
        header("Location: students.php");
    } else {
        // Redirect to an error page or display an error message
        echo 'error';
    }
}

?>
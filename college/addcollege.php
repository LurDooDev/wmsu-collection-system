<?php 
require_once '../classes/database.class.php';
require_once "../classes/college.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    // Sanitize input data
    $code = htmlspecialchars($_POST['code']);
    $name = htmlspecialchars($_POST['name']);

    // Check if any of the form fields are empty
    if (empty($code) || empty($name)) {
        echo '<script>alert("Please fill in all the required fields");</script>';
        echo '<script>window.location.href = "college.php";</script>';
        exit();
    }

    $College = new College();

    // // Check if the code
    // $existingCollege = $College->getCollegeByCode($code);
    // if ($existingCollege) {
    //     echo 'Error: College code "' . $code . '" is already in use by "' . $existingCollege->collegeName . '".';
    //     exit();
    // }

    $College->collegeCode = $code;
    $College->collegeName = $name;

    if ($College->createCollege()) {
        header('location: college.php');
    } else {
        echo 'Failed to add program.';
    }
    
}

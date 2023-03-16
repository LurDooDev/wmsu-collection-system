<?php 
require_once '../classes/database.class.php';
require_once "../classes/college.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    // Sanitize input data
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    // Check if any of the form fields are empty
    if (empty($code) || empty($name)) {
        echo 'Error: Please fill in all required fields.';
        exit();
    }

    // Validate the college code format (should be alphanumeric with length between 1 and 10 characters)
    if (!preg_match('/^[a-zA-Z0-9]{1,10}$/', $code)) {
        echo 'Error: College code must be alphanumeric and between 1 and 10 characters.';
        exit();
    }

    $College = new College();

    // Check if the code is already in use
    $existingCollege = $college->getCollegeByCode($code);
    if ($existingCollege) {
        echo 'Error: College code "' . $code . '" is already in use by "' . $existingCollege->collegeName . '".';
        exit();
    }

    $College->collegeCode = $code;
    $College->collegeName = $name;

    if ($College->createCollege()) {
        header('location: college.php');
    } else {
        echo 'Failed to add program.';
    }
    
}

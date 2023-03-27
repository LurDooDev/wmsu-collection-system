<?php 

require_once '../classes/database.class.php';
require_once "../classes/users.class.php";

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $users = new Users();
    $users->username = htmlspecialchars(trim($_POST['username']));
    $users->userfullname = htmlspecialchars($_POST['userfullname']);
    $users->userposition = htmlspecialchars($_POST['userposition']);
    $users->roleID = htmlspecialchars($_POST['role']);
    $users->collegeID = htmlspecialchars($_POST['college']);

    $password = htmlspecialchars($_POST['userpassword']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $users->userpassword = $hashed_password;

    // Validate form fields
    $error = array();
    
    if (empty($users->username) || empty($users->userfullname) || empty($users->userposition) || empty($users->roleID) || empty($users->collegeID) || empty($password)) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Please fill in all the required fields");</script>';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        return;
    }
    
    else if (strlen($users->username) > 50 || strlen($users->userfullname) > 100 || strlen($users->userposition) > 50 || strlen($password) > 50) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Field length exceeds the limit");</script>';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        return;
    }
    
    else if (!is_numeric($users->roleID) || !is_numeric($users->collegeID)) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid input");</script>';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        return;
    }

    else if (strlen($password) < 6) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Password must be at least 6 characters long");</script>';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        return;
    }
    
    else if (!empty($error)) {
        echo 'Error: ' . implode(', ', $error);
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        exit;
    }

    // Add user to database
    if ($users->addUser()) {
        echo 'Success';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        exit;
    } else {
        echo 'Error: Unable to add user';
        echo '<script>window.location.href = "user.php";</script>'; // Redirect to user.php after displaying the error message
        exit;
    }
}


?>

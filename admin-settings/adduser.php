<?php 
require_once '../classes/database.class.php';
require_once "../classes/users.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $users = new Users();
    $users->username = htmlspecialchars($_POST['username']);
    $users->userfullname = htmlspecialchars($_POST['userfullname']);
    $users->userposition = htmlspecialchars($_POST['userposition']);
    $users->userroles = htmlspecialchars($_POST['userroles']);
    $users->usercollege = htmlspecialchars($_POST['usercollege']);
    $users->userpassword = htmlspecialchars($_POST['userpassword']);
    $users->email = htmlspecialchars($_POST['email']);
    
      
    if ($users->add()) {
        header('location: User-management.php');
    } else {
        echo 'Failed to add fee.';
    }
    if (strlen($username) > 20) {
        echo "Username is too long.";
    } else {
        echo "Username is valid.";
    }
    if (preg_match('/^[A-Za-z0-9._%+-]+@wmsu\.edu\.ph$/', $email)) {
        echo "Email is valid";
    } else {
        echo "Email is invalid";
    } 
        

    
}


?>
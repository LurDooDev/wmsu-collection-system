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
    
}


?>
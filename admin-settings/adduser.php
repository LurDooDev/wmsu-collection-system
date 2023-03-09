<?php 
require_once '../classes/database.class.php';
require_once "../classes/users.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $users = new Users();
    $users->username = htmlspecialchars($_POST['username']);
    $users->userfullname = htmlspecialchars($_POST['userfullname']);
    $users->userposition = htmlspecialchars($_POST['userposition']);
    $users->roleID = htmlspecialchars($_POST['role']);
    $users->collegeID = htmlspecialchars($_POST['college']);

    // Hash the password
    $password = htmlspecialchars($_POST['userpassword']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $users->userpassword = $hashed_password;
    
      
    if ($users->addUser()) {
        echo 'success';
    } 
    
    
}


?>
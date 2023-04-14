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
    $users->userpassword = htmlspecialchars($_POST['userpassword']);

    // Validate form fields
    $errors = array();

    if (empty($users->username) || empty($users->userfullname) || empty($users->userposition) || empty($users->roleID) || empty($users->collegeID) || empty($users->userpassword)) {
        $errors['all'] = 'Please fill in all the required fields';
    } else {
        if (strlen($users->username) > 50) {
            $errors['username'] = 'Field length exceeds the limit';
        }
        if (strlen($users->userfullname) > 100) {
            $errors['userfullname'] = 'Field length exceeds the limit';
        }
        if (strlen($users->userposition) > 50) {
            $errors['userposition'] = 'Field length exceeds the limit';
        }
        if (!ctype_alpha($users->userfullname)) {
            $errors['userfullname'] = 'Name must not contain numerical values';
        }
        if (!is_numeric($users->roleID)) {
            $errors['role'] = 'Invalid input';
        }
        if (!is_numeric($users->collegeID)) {
            $errors['college'] = 'Invalid input';
        }
        if (strlen($users->userpassword) < 6) {
            $errors['userpassword'] = 'Password must be at least 6 characters long';
        }
        }
        // If there are errors, return them to the user
if (!empty($errors)) {
    $response = array(
        'status' => 'error',
        'message' => $errors
    );
} else {
    // If there are no errors, add the user to the database
    $database = new Database();
    $conn = $database->getConnection();

    $query = "INSERT INTO users (username, userfullname, userposition, roleID, collegeID, userpassword) VALUES (:username, :userfullname, :userposition, :roleID, :collegeID, :userpassword)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $users->username);
    $stmt->bindParam(':userfullname', $users->userfullname);
    $stmt->bindParam(':userposition', $users->userposition);
    $stmt->bindParam(':roleID', $users->roleID);
    $stmt->bindParam(':collegeID', $users->collegeID);
    $stmt->bindParam(':userpassword', password_hash($users->userpassword, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'User added successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Unable to add user'
        );
    }
}

echo json_encode($response);
} else {
    header('Location: ../index.php');
    }

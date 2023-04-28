<?php

    //resume session
    session_start();
    require_once '../classes/database.class.php';

  $db = new Database();

    // Retrieve the login time for the current session from the audit trail table
$fullName = $_SESSION['fullname'];
$sql = "SELECT login_time FROM audit_trail WHERE full_name = :fullName ORDER BY id DESC LIMIT 1";
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':fullName', $fullName);
$stmt->execute();
$loginTime = $stmt->fetchColumn();

// Store the logout time in the audit trail table
$logoutTime = date('Y-m-d H:i:s');
$sql = "UPDATE audit_trail SET logout_time = :logoutTime WHERE full_name = :fullName AND login_time = :loginTime";
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':fullName', $fullName);
$stmt->bindParam(':loginTime', $loginTime);
$stmt->bindParam(':logoutTime', $logoutTime);
$stmt->execute();

    //destroy session
    session_destroy();
    //then send user to login page
    header('location: ../login/login.php');

?>
<?php

require_once '../classes/database.class.php';
require '../classes/login.class.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    //sanitize stripgs remove yung html tags and trim sa whitespace and yung isa self explanatory na beshies
    $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
    $password = htmlspecialchars(strip_tags(trim($_POST['password'])));

    $login = new Login($username, $password);
    if($login->checkCredentials()){
        header("location: ../public/usermanagement.php");
    }else{
        echo "Access denied. Incorrect username or password.";
    }
}else{
    echo "Access denied. Missing required fields.";
}
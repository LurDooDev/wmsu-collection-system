<?php
 session_start();
    //prevent horny people
 if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
    // Redirect the user to the login page if they are not logged in
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $_SESSION['fullname']; ?></h1>
    <h1><?php echo $_SESSION['college_name']; ?></h1>
</body>
</html>
<?php
    require_once '../classes/database.class.php';
    require_once '../classes/users.class.php';
    session_start();
    //prevent horny people
    if (!isset($_SESSION['logged_id'])){
        header('location: ../public/logout.php');
    }

    require_once '../includes/sidebar.php'
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
    <!--testing-->
<table border="1">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Role ID</th>
            <th>College ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $users = new Users();
        $data = $users->get_all_users();
        
        foreach($data as $user) {
        ?>
        <tr>
            <td><?php echo $user['user_id']; ?></td>
            <td><?php echo $user['user_name']; ?></td>
            <td><?php echo $user['user_email']; ?></td>
            <td><?php echo $user['type']; ?></td>
            <td>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<a class="logout-link" href="../public/logout.php" title="Logout">
                <i class='bx bx-log-out'></i>
                <span class="links-name">Logout</span>
            </a>
</body>
</html>
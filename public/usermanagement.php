<?php
    require_once '../classes/database.class.php';
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
        $database = new Database;
        $conn = $database->connect();
        $stmt = $conn->prepare("SELECT wmsu_users.*, colleges.college_name AS college_name, roles.role_name AS role_name, students.first_name AS first_name, students.last_name AS last_name FROM wmsu_users 
                                LEFT JOIN colleges ON wmsu_users.college_id = colleges.college_id
                                LEFT JOIN roles ON wmsu_users.role_id = roles.role_id 
                                LEFT JOIN students ON wmsu_users.student_id = students.student_id");
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        foreach($results as $row) {
        ?>
        <tr>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['role_name']; ?></td>
            <td><?php echo $row['college_name']; ?></td>
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
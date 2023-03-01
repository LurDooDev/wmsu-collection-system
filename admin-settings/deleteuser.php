<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/users.class.php";
    
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $users = new Users();
        $users->userID = $_POST['user_id'];
            if($users->delete()){
                header('location: User-management.php');
            }
            else{
                echo 'Error deleting college';
            }
    }
?>
<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/program.class.php";
    
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $Programs = new Program();
        $Programs->programID = $_POST['id'];
            if($Programs->delete()){
                header('location: college.php');
            }
            else{
                echo 'Error deleting fees';
            }
    }
?>
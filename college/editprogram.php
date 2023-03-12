<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/program.class.php";
    
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $Programs = new Program();
        $Programs->programName = $_POST['name'];
        $Programs->programID = $_POST['id'];
            if($Programs->update()){
                header('location: college.php');
            }
            else{
                echo 'Error';
            }
    }
?>
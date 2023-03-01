<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/college.class.php";
    
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $college = new College();
        $college->collegeID = $_POST['college_id'];
        $college->collegeCode = htmlspecialchars($_POST['collegeCode']);
        $college->collegeName = htmlspecialchars($_POST['collegeName']);
    
        if ($college->update()) {
            header("location: college.php");
        } else {
            echo 'fail update';
        }
    }
?>
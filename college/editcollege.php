<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/college.class.php";
    
    if(isset($_POST['action'])){
        if($_POST['action'] == 'update'){
            $college = new College();
            $result = $college->update($_POST['collegeCode'], $_POST['collegeName'], $_POST['collegeCodeTarget']);;
    
            if($result){
                echo "College updated successfully.";
            }
            else{
                echo "Failed to update college.";
            }
        }
    }
?>
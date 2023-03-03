<?php 
    require_once '../classes/database.class.php';
    require_once "../classes/feeSchedule.class.php";
    
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $feeSchedule = new FeeSchedule();
        $feeSchedule->feeScheduleID = $_POST['fee_schedule_id'];
            if($feeSchedule->delete()){
                header('location: fees.php');
            }
            else{
                echo 'Error deleting fees';
            }
    }
?>
<?php
require_once '../classes/database.class.php';
require_once '../classes/universitypaymentdetails.class.php';

// Retrieve student ID from the form submission
$studentId = $_POST['student_id'];
$collectedBy = htmlspecialchars($_POST['collected_by']);


$db = new Database();

if(isset($_POST['fees'])){
    $selectedFees = $_POST['fees'];
    
  
    $totalAmount = 0;
    foreach($selectedFees as $feeId){
  
        $sql = "SELECT pending_amount FROM university_pending WHERE id = :feeId AND student_id = :studentId";
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':feeId', $feeId);
$stmt->bindParam(':studentId', $studentId);
$stmt->execute();
$fee = $stmt->fetch(PDO::FETCH_ASSOC);
if ($fee) {
    $amount = $fee['pending_amount'];
    $totalAmount += $amount;
}

    }

    $paymentDateTime = date('Y-m-d H:i:s');
    

    $paymentReference = uniqid('USC');
    
    $paidItems = array();
foreach($selectedFees as $feeId){

    $sql = "SELECT up.pending_amount, uf.fee_name, uf.fee_amount, uf.fee_type, ay.academic_name, s.semester_name
        FROM university_pending up 
        INNER JOIN university_fees uf ON up.university_fee_id = uf.id
        INNER JOIN academic_year ay ON uf.academic_year_id = ay.id 
        INNER JOIN semesters s ON uf.semester_id = s.id 
        WHERE up.id = :feeId";
$stmt = $db->connect()->prepare($sql);
$stmt->bindParam(':feeId', $feeId);
$stmt->execute();
$fee = $stmt->fetch(PDO::FETCH_ASSOC);

    
    $paidItems[] = array(
        'id' => $feeId,
        'name' => $fee['fee_name'],
        'amount' => $fee['fee_amount'],
        'paid_amount' => $fee['pending_amount']
    );
    

}


$paidItemsJson = json_encode($paidItems);
    
    
    $paymentDetails = new UniversityPaymentDetails();
    $paymentDetails->processPayment($studentId, $totalAmount, $paymentDateTime, $paymentReference, $paidItems, $collectedBy);
    $paymentDetails->moveFeesToPaid($studentId,$selectedFees);
}

// Redirect the user to a confirmation page
header('Location: done.php');
exit();
?>

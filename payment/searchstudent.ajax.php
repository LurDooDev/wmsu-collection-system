<?php
require_once '../classes/student.class.php';
session_start();
require_once '../functions/session.function.php';

if(isset($_GET['searchValue'])) {
    $searchValue = $_GET['searchValue'];

    $student = new Student();
    $collegeID = $UserCollegeID;
    $students = $student->searchStudents($searchValue, $collegeID);

    if(count($students) > 0) {
        foreach($students as $s) {
            echo "<tr>";
            echo "<td>" . $s['first_name'] . " " . $s['last_name'] . "</td>";
            echo "<td>" . $s['id'] . "</td>";
            echo "<td>" . $s['college_code'] . "</td>";
            echo "<td>" . $s['program_name'] . "</td>";
            echo "<td><a href='universitypayment_fees.php?studentID=" . $s['id'] . "' class='edit'><i class='material-icons' title='Select'>&#xe147;</i></a>";
echo "<a href='view_univtransaction.php?studentID=" . $s['id'] . "";
echo "</td>";   
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='text-align:center'>No results found.</td></tr>";
    }
}
?>

<?php
// Assuming that you have a College class that can retrieve college data
$college = new College();
$collegeData = $college->getById($_POST['college_id']);

// Return the college data as JSON
echo json_encode($collegeData);

?>
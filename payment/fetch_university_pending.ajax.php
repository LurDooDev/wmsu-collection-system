<?php

$studentid = $_GET['studentid'];
$universityPending = new UniversityPending();
$fees = $universityPending->getUniversityPendingFees($studentid);

?>
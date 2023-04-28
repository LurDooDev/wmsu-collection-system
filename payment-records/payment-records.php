<?php

    // resume session here to fetch session values
    session_start();

	//prevent horny people
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../payments-records/payment-records.php');
	} else if ($_SESSION['role'] != 'officer') {
		if ($_SESSION['role'] == 'admin') {
			header('location: officer.php');
		} else if ($_SESSION['role'] == 'collector') {
			header('location: collector.php');
		}
	}	
	require_once '../classes/database.class.php';
	require_once '../classes/fee.class.php';
?>
<!doctype html>
<html lang="en" class="no-js">
  <html>
    <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--- links for bootstrap and css  --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/payment-records.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="icon" type="image/jpg" href="../images/usc.png"/>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <title>Wmsu Collection System</title>
    </head>

      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
       <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                  <?php
                  if($_SESSION['role'] == 'officer'){?>
                <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
                    <?php } ?>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <!-- <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a> -->
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
    </div>                
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>               
        <div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Payment Records</h2>
        </div>
    </nav>
    <div class="container">
    <div class="row">
  <div class="col-sm-3 col-12" style="margin-top: 20px; padding-bottom: 20px;">
    <input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
  </div>
  <div class="col-sm-3 col-12" style="margin-top: 20px; padding-bottom: 20px;">
    <button class="btn btn-primary dropdown-toggle" id="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Status</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Paid</a>
      <a class="dropdown-item" href="#">Unpaid</a>
      <a class="dropdown-item" href="#">Partial</a>
    </div>
  </div>
</div>

<?php

$db = new Database();

// Retrieve all university payment details
$sql = "SELECT * FROM university_payment_details";
$stmt = $db->connect()->prepare($sql);
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the payment details in a table
echo '<table>';
echo '<thead><tr><th>Student ID</th><th>Total Amount</th><th>Payment DateTime</th><th>Payment Reference</th><th>Collected By</th><th>Action</th></tr></thead>';
echo '<tbody>';
foreach ($payments as $payment) {
    echo '<tr>';
    echo '<td>' . $payment['student_id'] . '</td>';
    echo '<td>' . $payment['total_amount'] . '</td>';
    echo '<td>' . $payment['payment_datetime'] . '</td>';
    echo '<td>' . $payment['payment_reference'] . '</td>';
    echo '<td>' . $payment['collected_by'] . '</td>';
    echo '<td><a href="download_receipt.php?payment_id=' . $payment['id'] . '">Download Receipt</a></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>


</body>       
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>
			<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>
            <script>function setActiveLink(link) {
  var links = document.querySelectorAll('.list-group-item');
  for (var i = 0; i < links.length; i++) {
    links[i].classList.remove('active');
  }
  link.classList.add('active');
}

var links = document.querySelectorAll('.list-group-item');
for (var i = 0; i < links.length; i++) {
  links[i].addEventListener('click', function() {
    setActiveLink(this);
  });
}</script>

</html>

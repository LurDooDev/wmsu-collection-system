<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])) {
  header('location: ../public/logout.php');
} else if ($_SESSION['role'] != 'officer') {
  if ($_SESSION['role'] == 'admin') {
      header('location: dashboard.php');
  } else if ($_SESSION['role'] == 'collector') {
      header('location: dashboard-user.php');
  }
}

require_once '../classes/database.class.php';
require_once '../classes/universityfeeSched.class.php';


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
    <!-- Unicons CSS -->
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/paymentfees.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <!--Jquery NEED-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--Jquery NEED-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Wmsu Collection System</title>
      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Payments</a>
                <i class="fa fa-caret-down" style = "margin-left:70px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../payment/universitypayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <a href="../payment-local/localpayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Local Payment</a>
                </div>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../user-univ-fee/univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a>
                    <a href="../user-local-fee/local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
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
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Payments</h2>
        </div>
    </nav>
<div class="container">
		<div class="row justify-content-center">
			<div class="justify-content-center">
				<div class="">
					<form id="form">
						<ul id="progressbar">
							<li class="" id="step1">
								<strong>Search User</strong>
							</li>
							<li class ="active" id="step2"><strong>University Fees</strong></li>
							<li class ="" id="step3"><strong>University Payment Details</strong></li>
							<li id="step4"><strong>Transaction Complete</strong></li>
						</ul>
						<div class="">
</div>
<div class="table-responsive" id="bilat">
  <div class="row my-2 mx-1 justify-content-center" style="display: block;">
    <form id="feeForm" method="post">
      <input type="hidden" name="studentID" value="<?php echo $_GET['studentID']; ?>">
      <table class="table table-striped table-borderless">
        <thead style="background-color:#95BDFE ;" class="text-white">
          <tr>
            <th scope="col" style="color: #000000;">Select Fees</th>
            <th scope="col" style="color: #000000;">Description</th>
            <th scope="col" style="color: #000000;">Amount</th>
            <th scope="col" style="color: #000000;">Semester</th>
            <th scope="col" style="color: #000000;">School Year</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $FeeSched = new UniversityFeeSched();
            $FeeSchedData = $FeeSched->showAllDetailsActive();  
            foreach($FeeSchedData as $FeeSched) {        
          ?>             
          <tr>
            <td> 
              <div class="checkbox">
                <label class="checkbox-inline">
                  <input type="checkbox" name="fee[]" value="<?php echo $FeeSched['id']; ?>">
                </label>
              </div>
            </td>
            <td><?php echo $FeeSched['university_name']; ?></td>
            <td><?php echo $FeeSched['university_amount']; ?></td>
            <td><?php echo $FeeSched['semester_name']; ?></td>
            <td><?php echo $FeeSched['academic_name']; ?></td>
          </tr>
          <?php 
            }
          ?>  
        </tbody>
      </table>
      <div>
        <div class="d-flex">
          <div class="mr-auto">
            <a href="universitypayment.php" class="btn btn-success" style="border-radius: 40px; padding: 10 10 10 10;">
              <span>Previous</span>
            </a>
          </div>
          <div class="ml-auto p-auto">
            <?php if (isset($_POST['fee'])): ?>
              <a href="<?php echo 'universitypayment_review.php?studentID='.$_GET['studentID'].'&fees='.implode(',',$_POST['fee']); ?>" class="btn btn-success" style="border-radius: 40px; padding: 10 10 10 10;">
                <span>Proceed To Payment</span>
              </a>
            <?php else: ?>
              <button type="button" class="btn btn-success disabled" style="border-radius: 40px; padding: 10 10 10 10;">
                <span>Select at least one fee to proceed</span>
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

</fieldset>

  
</body>



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

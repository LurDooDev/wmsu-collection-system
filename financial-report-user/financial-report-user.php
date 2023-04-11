<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])) {
  header('location: ../admin/dashboard-user.php');
} else if ($_SESSION['role'] != 'officer') {
  if ($_SESSION['role'] == 'admin') {
      header('location: dashboard.php');
  } else if ($_SESSION['role'] == 'collector') {
      header('location: dashboard-user.php');
  }
}

require_once '../classes/database.class.php';
require_once '../classes/college.class.php';
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/financial.css" />
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
              <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <?php } ?>
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                <a href="../new-payment/search-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../user-univ-fee/new-univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../user-local-fee/new-local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>                </div>            
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>                
        <div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Financial Report</h2>
        </div>
    </nav>
	</nav>
    <div class="container">
	<div class =" table-responsive" id="inner">
                <table class="table">
				<div class="row">
        <?php
                    if($_SESSION['role'] == 'admin'){?>
                <div class="ml-auto p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
                <a href="report.php" class="btn btn-success"> <i class="material-icons">&#xE147;</i> <span>Generated Report</span></a>
                        <div class="ml-7 p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
						<a href="#addReport" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Report</span></a>
</div>
					</div>
          <?php } ?>
				</div>
			</div>

            <thead style="background-color:#95BDFE ;" class="text-white">
            <table class="table table-striped table-hover">
				<tbody>
                <tr>
      <td>WMSU PALARO</td>
      <td><a href="#detailsModal" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="details"></> VIEW</a></td>
              </tr>
              <tr>
      <td>Bahay Kubo</td>
      <td><a href="#detailsModal1" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="details"></> VIEW</a></td>
              </tr>
              <tr>
      <td>Project A</td>
      <td><a href="#detailsModal2" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="details"></> VIEW</a></td>
              </tr>
              <tr>
      <td>Project B</td>
      <td><a href="#detailsModal3" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="details"></> VIEW</a></td>
              </tr>
              <tr>
      <td>Project C</td>
      <td><a href="#detailsModal4" class="details" data-toggle="modal" style="color:gray;" data-toggle="tooltip" title="details"></> VIEW</a></td>
              </tr>

            </thead>
<!-- New content here  -->
<div id="detailsModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Details</h4>
				</div>
				<div class="modal-body">					
          <ul style="list-style-type: none;">
          <li><label>Expense Details: Wmsu Palaro</label></li>
						<li><label>Fund: Php 500.00</label></li>
            <li><label>Total Cost: 200.00</label></li>
            <li><label>Date: August 25,2020</label></li>
            <li><label>Time: 6:58AM</label></li>
            <li><label>Semester: 1st Semester</label></li>
            <li><label>School Year: 2020-2021</label></li>
            &nbsp;</li>&nbsp;
            <li><label>Summary Report:</label></li>
            <form action="" method="post">
<div>
<textarea  class = "comment" name="comments" id="comments"  placeholder = "Enter your comments here">
</textarea>
</div>
</form>
        </ul>
				</div>
				<div class="modal-footer" style="justify-content: center">
					<input type="button" class="btn btn-danger" style="width: 60%; border-radius: 25px;" data-dismiss="modal"value="Exit">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="addReport" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="createfees.php" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Financial Report </h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="expense">Expense Details:</label>
                <input type="text" name="expense" id="expense" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="funds">Funds:</label>
                <input type="text" name="funds" id="funds" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="cost">Total Cost:</label>
                <input type="number" name="cost" id="cost" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" name="time" id="time" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="sem">Semester:</label>
                <input type="text" name="sem" id="sem" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="schoolYear">School Year:</label>
                <input type="date" name="schoolYear" id="schoolYear" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="comments">Summary Report:</label>
                <textarea class="form-control" name="comments" id="comments" placeholder="Enter your comments here"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="hidden" name="action" value="Save">
          <input type="submit" class="btn btn-success" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>
</body>       
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>

</html>
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

        </body>       


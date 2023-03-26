<?php

    // resume session here to fetch session values
    session_start();
    require_once '../functions/session.function.php';
	//prevent horny people
    if (!isset($_SESSION['logged_id'])) {
        header('location: ../user-univ-fee/universitysched.php');
    } else if ($_SESSION['role'] != 'officer') {
        if ($_SESSION['role'] == 'admin') {
            header('location: officer.php');
        } else if ($_SESSION['role'] == 'collector') {
            header('location: collector.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/fees.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <title>University Fee Schedule</title>
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
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Payments
               <i class="fa fa-caret-down" style = "margin-left:70px;"></i>
              </button>             
                <div class="dropdown-container">
                    <a href="../payment/universitypayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <a href="../payment-local/localpayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Local Payment</a>
                </div>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <?php
                if($_SESSION['role'] == 'officer'){?>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../user-univ-fee/univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Fee</a>
                    <a href="../user-local-fee/local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
                </div>            
                <?php } ?>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Fee Schedule</h2>
        </div>
    </nav>
		<div class="table-wrapper">
		<div class="table-title">
				<div class="row">
					<div class="col-sm-4 pr-auto">
					<input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
					<button class="btn btn-primary dropdown-toggle" id ="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">Ascending</a>
    					<a class="dropdown-item" href="#">Descending</a>
					</div>
					</div>
          <div class="col-sm-8 p-auto mr-auto">
						<a href="univer-fee.php" class="btn btn-success" id="backstreet" style = " padding: 13px; margin-top: 19px; border-radius:6px;"> <span>Back To University Fee</span></a>
						<div class="col-sm-10 p-auto mb-auto">
						<!-- <a href="#addFeesModal" class="btn btn-success" id = "add-fees" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fees</span></a> -->
					</div>
					</div>
				</div>
			</div>
			<div class="table-title">
				<div class="row">
					<div class="col-sm-3">
					</div>
				</div>
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Category</th>
						<th>Amount</th>
                        <th>Semester</th>
                        <th>School Year</th>
                        <th>Begin</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Created By</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $FeeSched = new UniversityFeeSched();
                    $FeeSchedData = $FeeSched->showAllDetails();
    $i = 1;
    foreach($FeeSchedData as $FeeSched) {        
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $FeeSched['university_name']; ?></td>
				<td><?php echo $FeeSched['university_fee_type']; ?></td>
                <td><?php echo $FeeSched['university_amount']; ?></td>
                <td><?php echo $FeeSched['semester_name']; ?></td>
                <td><?php echo $FeeSched['academic_name']; ?></td>
                <td><?php echo date('F j, Y', strtotime($FeeSched['university_start_date'])); ?></td>
                <td><?php echo date('F j, Y', strtotime($FeeSched['university_end_date'])); ?></td>
                <td><?php echo ($FeeSched['is_active'] == 1) ? "Active" : "Not Active"; ?></td>
                <td><?php echo $FeeSched['created_by']; ?></td>
                <td>
                <a href="univer-fee.php" class="edit"><i class="material-icons" title="Edit">&#xE254;</i></a>
                </td>
            </tr>
<?php 
            $i++;
        }
?>

<!-- Create Fee Modal HTML -->
<div id="addFeesModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adduniversityfees.php" method="POST" id="adduniversityfees">
                <div class="modal-header">
                    <h4 class="modal-title">Create University Fees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                    <input type="hidden" name="created_by" value="<?php echo $UserFullname; ?>">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="action" value="Add">
                    <input type="submit" class="btn btn-success" value="Create">
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
<script>
	$(document).ready(function() {
		// Hide the dropdown on page load
		$('.dropdown-container').hide();

		// Toggle the dropdown on click
		$('.dropdown-btn').click(function() {
			var containerId = $(this).attr('data-container');
			$('#'+containerId).toggle();
		});

		// Add the active class on click
		$('.list-group-item-action').click(function() {
			$('.list-group-item-action').removeClass('active');
			$(this).addClass('active');
		});
	});
</script>
</html>
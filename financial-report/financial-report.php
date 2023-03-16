<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])) {
    header('location: ../public/logout.php');
} else if ($_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'officer') {
        header('location: officer.php');
    } else if ($_SESSION['role'] == 'collector') {
        header('location: collector.php');
    }
}

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
    <link rel="stylesheet" href="../css/payment.css" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/payments.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/financial.css" />
    <link rel="stylesheet" href="../css/user-college.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/4caf6a2b18.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/4caf6a2b18.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Wmsu Collection System</title>
    </head>
      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
			<div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <a href="../funds/funds-sub.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Funds</a>
                <a href="../financial-report-admin/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Admin Settings</a>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
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
                <div class="ml-auto p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
                <a href="report.php" class="btn btn-success"> <i class="material-icons">&#xE147;</i> <span>Generated Report</span></a>
                        <div class="ml-7 p-auto" style="display: flex; align-items: center; justify-content: flex-end; padding: 15px;">
						<a href="#addReport" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Report</span></a>
</div>
					</div>
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
                <div class="form-group">
                        <label for="">Expense Details: </label>
                        <input type="text" name="expense" id="expense" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Funds: </label>
                        <input type="text" name="funds" id="funds" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Total Cost: </label>
                        <input type="number" name="cost" id="cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Date: </label>
                        <input type="date" name="" id="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Time: </label>
                        <input type="time" name="" id="time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Semester: </label>
                        <input type="text" name="sem" id="sem" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">School Year: </label>
                        <input type="date" name="sem" id="sem" class="form-control" required>
                    </div>
                    <label>Summary Report:</label></li>
                        <form action="" method="post">
                        <div>
                        <textarea  class = "comment" name="comments" id="comments"  placeholder = "Enter your comments here">
</textarea>
</div>
</form>
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

<!-- Script for dashboard hamburger         -->
        </body>       
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>


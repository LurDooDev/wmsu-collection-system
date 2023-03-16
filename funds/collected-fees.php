<?php
    session_start();
	require_once '../functions/session.function.php';

	//prevent unauthorized access
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../admin/dasboard-main.php');
		exit(); // stop execution after redirect
	} else if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'officer') {
		header('location: ../admin/dashboard-main.php');
		exit(); // stop execution after redirect
	}

	require_once '../classes/database.class.php';
	require_once '../classes/college.class.php';
	require_once '../classes/program.class.php';
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
    <link rel="stylesheet" href="../css/funds.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
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
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <i class="fa fa-caret-down" style="margin-left: 115px;"></i>
                </button>                
                <div class="">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">Collected Fees</a></ul>
                </div>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                <i class="fa fa-caret-down" style="margin-left: 44px;"></i>
                </button>
                <div class="">
                    <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                    <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Colleges</a></ul>
                </div>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
</div>
        </div>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Funds</h2>
        </div>
    </nav>
    <div class="container">
		<div class="row justify-content-center">
    <div class="graphBox">
                    <a href="../funds/funds-sub.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="background-color: white; color:#000000; border:inset; border-color:black;" id="funds">Funds</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active"style="border:solid; border-color:black;" id="funds">Collected fees</a>
				</div>
                <div class ="boxing">
                <div class="box">
                &nbsp; <h2>Total Fees to be Collected</h2>&nbsp;
                    <h3>Php 13,000,000</h3>
                    <hr style="color: red; height:5px;">
                </div>
                <div class="box">
                &nbsp;<h4>Total Fees Collected</h4>&nbsp;
                    <h5>Php 13,000,000</h5>
                    <hr style="color: green; height: 5px;">
                </div>
                </div>
                <div class="table-responsive" id="lonely">
        <div class="row my-auto mx-auto">
        <div class="col-sm-auto">
        <input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
        </div>
        <div class="col-sm-4" style="padding-bottom: 5px;">
        <button class="btn btn-primary dropdown-toggle" id ="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">Ascending</a>
    					<a class="dropdown-item" href="#">Descending</a>
					</div>
        </div>
        <div class="col-sm-4">
        <button class="btn btn-primary dropdown-toggle" id ="school-year" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">School Year </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">2021-2022</a>
    					<a class="dropdown-item" href="#">2022-2023</a>
					</div>
        </div>
          <table class="table table-striped table-borderless">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >ID</th>
                <th scope="col" style = " color: #000000;" >College</th>
                <th scope="col" style = " color: #000000;" >Total</th>
                <th scope="col" style = " color: #000000;" >USC Share</th>
                <th scope="col" style = " color: #000000;" >School Year</th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>CCS</td>
                <td>Php 1,000,000</td>
                <td>Php 300,000</td>
                <td>2022-2023</td>
                <td><a href="#detailsModal" class="details" data-toggle="modal"><i class="fa-solid fa-circle-info fa-xl" style="color:gray;" data-toggle="tooltip" title="details"></i></a></td>
              </tr>

              <tr>
                <th scope="row">2</th>
                <td>CCS</td>
                <td>Php 1,500,000</td>
                <td>Php 600,000</td>
                <td>2022-2023</td>
                <td><a href="#detailsModal" class="details" data-toggle="modal"><i class="fa-solid fa-circle-info fa-xl" style="color:gray;" data-toggle="tooltip" title="details"></i></a></td>
              </tr>

              <tr>
                <th scope="row">3</th>
                <td>CCS</td>
                <td>Php 2,000,000</td>
                <td>Php 450,000</td>
                <td>2022-2023</td>
                <td><a href="#detailsModal" class="details" data-toggle="modal"><i class="fa-solid fa-circle-info fa-xl" style="color:gray;" data-toggle="tooltip" title="details"></i></a></td>
              </tr>
            </tbody>
          </table>
             </div>
			</div>
		</div>
	</div>
    
<!-- Details Modal -->
  <div id="detailsModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Details</h4>
				</div>
				<div class="modal-body">					
          <ul style="list-style-type: none;">
          <li><label>Boracay</label></li>
						<li><label>Fund Size: Php 215,000</label></li>
            <li><label>Semester: 1</label></li>
            <li><label>School Year: 2022-2023</label></li>
            <li><label>Status: Pending</label></li>
            <li><label>Date Created: 12/15/23</label></li>
            &nbsp;<li><label>Download Proposal Files: Finding ways for this function</label></li>&nbsp;
        </ul>
				</div>
				<div class="modal-footer" style="justify-content: center; margin-right: 35px;">
					<input type="button" class="btn btn-danger" style="width: 60%; border-radius: 25px;" data-dismiss="modal"value="Exit">
				</div>
			</form>
		</div>
	</div>
</div>
  
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
</html>

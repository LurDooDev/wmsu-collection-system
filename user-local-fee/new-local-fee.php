<?php
  // resume session here to fetch session values
  session_start();
  require_once '../functions/session.function.php';
  
if (!isset($_SESSION['logged_id'])) {
    header('location: ../university/new-univ.php');
} else if ($_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'officer') {
        header('location: officer.php');
    } else if ($_SESSION['role'] == 'collector') {
        header('location: collector.php');
    }
}

require_once '../classes/database.class.php';
require_once '../classes/universityfees.class.php';
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/new-univ.css" />
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
                <!-- <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a> -->
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <i class="fa fa-caret-down" style="margin-left: 115px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
                </div>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../university/new-univ.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/new-local.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold active"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <?php
                    if($_SESSION['role'] == 'officer'){?>
                    <a href="../admin-settings/user-new.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                    <?php } ?>
                    <!-- <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Colleges</a></ul> -->
                </div>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
</div>
        </div>
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Local Fee</h2>
        </div>
    </nav>
    <div class="container">
                <div class="row" style="padding-top:  21px;">
				<div class="col-sm-4" style="border-color: #000000;">
        			<input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
       			 </div>
        <div class="col-sm-4">
        <button class="btn btn-primary dropdown-toggle" id ="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">Ascending</a>
    					<a class="dropdown-item" href="#">Descending</a>
					  </div>
          </div>
					<div class="col-sm-4 " style="display: flex; align-items: center; justify-content: flex-end;">
						<a href="#addCollectorModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fees</span></a>
					</div>
				</div>
             <div class =" table-responsive" style="margin-top: 10px;">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >#</th>
                <th scope="col" style = " color: #000000;" >Name</th>	
                <th scope="col" style = " color: #000000; text-align:center;" >Amount</th></th>
				        <th scope="col" style = " color: #000000; text-align:center;" >Semester</th></th>
                <th scope="col" style = " color: #000000; text-align:center;" >School Year</th></th>
                <th scope="col" style = " color: #000000; text-align:center;" >Start Date</th></th>
                <th scope="col" style = " color: #000000; text-align:center;" >End Date</th></th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
            <tr>
			          <td>1</td>
                <td>Palaro Fee</td>
               
			        	<td style="text-align:center;">200</td>
                <td style="text-align:center;">1st Semester</td>
                <td style="text-align:center;">2022-2023</td>
                <td style="text-align: center;">May 06,2022</td>
                <td style="text-align: center;">May 06,2023</td>
                <td>
                <a href="#editFeesModal" class="edit" data-toggle="modal">
										<i class="material-symbols-outlined" title="Edit">edit</i>
									</a>
                    <a href="#deleteFeesModal" class="delete" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </td>
            </tr>
            <!-- Edit Fees Modal -->
            <div id="editFeesModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="adduser.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<h5>Fee Details</h5>
							<div class="form-group">
								<label for="feeName">Name</label>
								<input type="text" name="feeName" id="feeName" class="form-control" placeholder="CSC Fee" required>
							</div>
							
							<div class="form-group">
								<label for="amount" class="form-label" >Amount</label>
								<div class="input-group">
									<input type="number" class="form-control" id="amount" name="amount" min="0" step="1" placeholder="200" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<h5>Fee Scheduling</h5>
							<div class="form-group">
								<label for="semester">Semester</label>
								<select name="semester" id="semester" class="form-control" required>
									<option value="" selected>1st Semester</option>
									<option value="1st Semester">1st Semester</option>
									<option value="2nd Semester">2nd Semester</option>
									<option value="Summer">Summer</option>
								</select>
							</div>
							<div class="form-group">
								<label for="schoolyear">School Year</label>
								<select name="schoolyear" id="schoolyear" class="form-control" required>
									<option value="" selected>2022-2023</option>
									<option value="2022-2023">2022-2023</option>
									<option value="2023-2024">2023-204</option>
								</select>
							</div>
							<div class="form-group">
								<label>Start Date</label>
								<input type="date" name="startdate" class="form-control" value="2022-05-06" required>
							</div>
							<div class="form-group">
								<label>End Date</label>
								<input type="date" name="enddate" class="form-control" value="2022-05-06" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="action" value="add">
					<input type="submit" class="btn btn-success" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>


            <!-- Delete Fees Modal -->
            <div id="deleteFeesModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="deleteuser.php" method="POST">
                            <div class="modal-header">						
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                            </div>
                            <div class="modal-body">					
                                <p>Are you sure you want to delete this record?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="hidden" name="action" value="delete">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
				</tbody>
			</table>
		</div>
	</div>        
</div>
</div>  
<!-- Add Modal HTML -->
<div id="addCollectorModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="adduser.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<h5>Fee Details</h5>
							<div class="form-group">
								<label for="feeName">Name</label>
								<input type="text" name="feeName" id="feeName" class="form-control" required>
							</div>
							
              <div class="form-group">
    <label for="paymentType" class="form-label">Payment Type</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentType" id="cashPayment" value="cash" >
        <label class="form-check-label" for="cashPayment">
            Required
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentType" id="noPayment" value="">
        <label class="form-check-label" for="noPayment">
            Not required
        </label>
    </div>
</div>
							<div class="form-group">
								<label for="amount" class="form-label">Amount</label>
								<div class="input-group">
									<input type="number" class="form-control" id="amount" name="amount" min="0" step="1" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<h5>Fee Scheduling</h5>
							<div class="form-group">
								<label for="semester">Semester</label>
								<select name="semester" id="semester" class="form-control" required>
									<option value="" disabled selected>Select your option</option>
									<option value="1st Semester">1st Semester</option>
									<option value="2nd Semester">2nd Semester</option>
									<option value="Summer">Summer</option>
								</select>
							</div>
							<div class="form-group">
								<label for="schoolyear">School Year</label>
								<select name="schoolyear" id="schoolyear" class="form-control" required>
									<option value="" disabled selected>Select your option</option>
									<option value="2022-2023">2022-2023</option>
									<option value="2023-2024">2023-204</option>
								</select>
							</div>
							<div class="form-group">
								<label>Start Date</label>
								<input type="date" name="startdate" class="form-control" required>
							</div>
							<div class="form-group">
								<label>End Date</label>
								<input type="date" name="enddate" class="form-control" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="action" value="add">
					<input type="submit" class="btn btn-success" value="Add">
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
var listgroup = document.getElementsByClassName("list-group-item")
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
</html>

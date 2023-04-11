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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new-user2.css" />
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
              <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <?php } ?>
                <a href="../new-payment/search-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
				<div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../user-univ-fee/new-univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../user-local-fee/new-local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>                
				</div>            
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>                
		<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">User Management</h2>
        </div>
    </nav>
    <div class="container">
                <div class="row" style="padding-top:  21px;">
				<div class="col-sm-4" style="border-color: #000000;">
        			<input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
       			 </div>
              <?php
                    if($_SESSION['role'] == 'admin'){?>
					<div class="col-sm-8 " style="display: flex; align-items: center; justify-content: flex-end;">
						<a href="#addCollectorModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add User</span></a>
				</div>
            <?php } ?>
             <div class =" table-responsive" style="margin-top: 10px;">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >ID</th>
                <th scope="col" style = " color: #000000;" >Name</th>
				<th scope="col" style = " color: #000000; text-align:center;">Position</th></th>
                <th scope="col" style = " color: #000000;" >Role</th></th>
				<th scope="col" style = " color: #000000;" >Year Lvl</th></th>
                <th scope="col" style = " color: #000000; text-align:center;" >Start of Term</th></th>
                <th scope="col" style = " color: #000000; text-align:center;" >End of Term</th></th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
            <tr>
			          <td>1</td>
                <td>Dummy 1</td>
                <td style="text-align: center;">President</td>
			        	<td>Officer</td>
                <td>4th Year</td>
                <td style="text-align: center;">August 06,2022</td>
                <td style="text-align: center;">August 06,2023</td>
                <td>
                <a href="#editFeesModal" class="edit" data-toggle="modal">
										<i class="material-symbols-outlined" title="Edit">edit</i>
									</a>
                    <a href="#deleteFeesModal" class="delete" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </td>
            </tr>


	
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
		</div>
	</div>        
</div>

      <!-- Edit Fees Modal -->
<div id="editFeesModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Dummy 1" required>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" required>
                                    <option value="" selected>President</option>
                                    <option value="Manager">Vice-President</option>
                                    <option value="Supervisor">Secretary</option>
                                    <option value="Staff">Mayor</option>
                                    <option value="Staff">Vice-Mayor</option>
                                    <option value="Staff">Assistant</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" required>
                                    <option value="" disabled selected>Officer</option>
                                    <option value="Supervisor">Officer</option>
                                    <option value="Coordinator">Collector</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start of Term</label>
                                <input type="date" class="form-control" value="2022-08-06" required>
                            </div>
                            <div class="form-group">
                                <label>End of Term</label>
                                <input type="date" class="form-control" value="2023-08-06" required>
                            </div>
                        </div>
                    </div>
                </div>

<div class="modal-footer">
  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
  <input type="submit" class="btn btn-success" value="Save">
</div>
			</form>
			  </div>
	</div>
  
</div>

	<!-- Add Modal HTML -->
	<div id="addCollectorModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="adduser.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
  <div class="form-group">
    <label for="userfullname">Name</label>
    <input type="text" name="userfullname" id="userfullname" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Position</label>
    <select class="form-control" required>
      <option value="" disable selected>Select your Options</option>
      <option value="Manager">Vice-President</option>
      <option value="Supervisor">Secretary</option>
      <option value="Staff">Mayor</option>
      <option value="Staff">Vice-Mayor</option>
      <option value="Staff">Assistant</option>
    </select>
  </div>
  <div class="form-group">
    <label>Role</label>
    <select class="form-control" required>
      <option value="" disabled selected>Select your Options</option>
      <option value="Supervisor">Officer</option>
      <option value="Coordinator">Collector</option>
    </select>
  </div>
  <div class="form-group">
    <label>Term Start</label>
    <input type="date" name="startdate" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Term End</label>
    <input type="date" name="enddate" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="userpassword">Password</label>
    <input type="password" name="userpassword" id="userpassword" class="form-control" required>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
    <input type="hidden" name="action" value="add">
    <input type="submit" class="btn btn-success" value="Add">
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
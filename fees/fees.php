<?php

    // resume session here to fetch session values
    session_start();

	//prevent horny people
    if (!isset($_SESSION['logged_id'])){
        header('location: ../public/logout.php');
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
    <link rel="stylesheet" href="../css/fees.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://kit.fontawesome.com/30ff5f2a0c.js" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://datatables.net/extensions/fixedheader/examples/integration/responsive-bootstrap.html"></script>
    <title>Wmsu Collection System</title>
    </head>

      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard.php" class="list-group-item list-group-item-action bg-hover first-text fw">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text active">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw">Colleges</a>
                <a href="../funds/funds.php" class="list-group-item list-group-item-action bg-hover first-text fw">Funds</a>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw">Audit Log</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw">Admin Settings</a>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw">Logout</a>
            </div>
        </div>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Fees</h2>
        </div>
    </nav>
	<div class="table-responsive">
	<div id="page-content-wrapper">
	<div class="col-sm-6">
<div class="table-wrapper">
    <div class="form-outline">
        <label for="keyword">Search</label>
        <input type="text" name="keyword" id="keyword" placeholder="Enter Type of Fees Here" class="form-control form-control-sm">
    </div>
	<div class="row">
    <div class="col-sm-6">
	<div class ="sticky-md-top">
        <a href="#addFeesModal" class="btn btn-success btn-primary position-relative" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Fees</span></a>	
</div>
</div>
<table class="table table-hover col-12" id="table-fees">
    <thead>
        <tr>
            <th scope="col">Action</th>
            <th scope="col">ID</th>
            <th scope="col">Duration</th>
            <th scope="col">Type of Fees</th>
            <th scope="col">Amount</th>
            <th scope="col">School Year</th>
            <th scope="col">Description</th>
            </tr>
    </thead>
    <tbody>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>1</td>
            <td>1st Semester</td>
            <td>University</td>
            <td>200</td>
            <td>05/19/2022</td>
            <td>University Fees</td>

        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>2</td>
			<td>1st Semester</td>
            <td>Wmsu Palaro</td>
            <td>300</td>
			<td>05/19/2022</td>
            <td>Fees</td>

        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>3</td>
			<td>1st Semester</td>
            <td>Laptop</td>
            <td>200</td>
			<td>05/19/2022</td>
            <td>Fees</td>

        </tr>
        <tr>
        <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>4</td>
            <td>1st Semester</td>
            <td>University</td>
            <td>150</td>
            <td>05/19/2022</td>
            <td>Fees</td>

            <tr>
            <td>
							<a href="#editFeesModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteFeesModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            <a href="" class="status" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Status">&#xE872;</i></a>
						</td>
            <td>5</td>
			<td>1st Semester</td>
            <td>Bahay Kubo</td>
            <td>599</td>
            <td>05/19/2022-</td>
            <td>Fees</td>
        </tr>
        </tr>
    </tbody>
</table>
<div>
</div>
<div id="addFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Type of Fee</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="number" class="form-control" required>
					</div>			
					<div class="form-group">
						<label>School Year</label> 
						<input type="text" class="form-control" required> <!-- text muna kasi automatically default - mark -->
					</div>				
					<div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required><!-- text muna kasi automatically default - mark -->
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="editFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
                <div class="modal-body">					
					<div class="form-group">
						<label>Type of Fee</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="number" class="form-control" required>
					</div>			
					<div class="form-group">
						<label>School Year</label> 
						<input type="text" class="form-control" required> <!-- text muna kasi automatically default - mark -->
					</div>				
					<div class="form-group">
						<label>Semester</label>
						<input type="text" class="form-control" required><!-- text muna kasi automatically default - mark -->
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="deleteFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
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
			  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>
</html>

<?php
    session_start();
	require_once '../functions/session.function.php';

	//prevent unauthorized access
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../fees/fees.php');
	} else if ($_SESSION['role'] != 'admin') {
		if ($_SESSION['role'] == 'collector') {
			header('location: ../admin/dashboard-main.php');
		} else if ($_SESSION['role'] == 'officer') {
			header('location: ../admin/dashboard-main.php');
		}
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/fees.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <title>Fees</title>
    </head>

      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
			<div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <a href="../funds/funds-sub.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Funds</a>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <?php
                if($_SESSION['role'] == 'officer'){ ?>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Admin Settings</a>
                <?php } ?>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
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
						<a href="feeschedpage.php" class="btn btn-success" style = " padding: 13px; margin-top: 19px; border-radius:6px;"><i class="material-icons">&#xE147;</i> <span>Fee Sched</span></a>
						<div class="col-sm-10 p-auto mb-auto">
						<a href="#addFeesModal" class="btn btn-success" id = "add-fees" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fees</span></a>
						<!-- <a href="#deleteFeesModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>		
									 -->
					</div>
						<!-- <a href="#deleteFeesModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
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
						<!-- <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th> -->
						<th>#</th>
						<th>Type of Fee</th>
						<th>Description</th>
						<th>Amount</th>
            <th>Semester</th>
						<th>Start Date</th>
            <th>End Date</th>
						<th>School Year</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                if($_SESSION['user_type'] == 'admin'){ 
                    $feeSched = new FeeSchedule();
                    $feeSchedData = $feeSched->showAllDetails();
    $i = 1;
    foreach($feeSchedData as $feeSched) {
        if ($feeSched['fee_type'] == 'University') {         
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $feeSched['fee_type']; ?></td>
								<td><?php echo $feeSched['fee_name']; ?></td>
                <td><?php echo $feeSched['fee_amount']; ?></td>
                <td><?php echo $feeSched['semester_name']; ?></td>
								<td><?php echo $feeSched['semester_start_date']; ?></td>
                <td><?php echo $feeSched['semester_end_date']; ?></td>
                <td><?php echo $feeSched['school_year_name']; ?></td>
                <td>
                    <a href="#deleteFeesModal<?php echo $i; ?>" class="delete" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </td>
            </tr>
            <!-- Delete Fees Modal -->
            <div id="deleteFeesModal<?php echo $i; ?>" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="deletefeesched.php" method="POST">
                            <div class="modal-header">						
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Fees</h4>
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
                                <input type="hidden" name="fee_schedule_id" value="<?php echo $feeSched['fee_schedule_id']; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php 
            $i++;
        }
    }
} 
?>

				 <!--Officer-->
				 <?php
                if($_SESSION['user_type'] == 'officer'){ 
                    $feeSched = new FeeSchedule();
                    $feeSchedData = $feeSched->showAllDetails();
    $li = 1;
    foreach($feeSchedData as $feeSched) {
        if ($feeSched['fee_type'] == 'local') {         
?>
            <tr>
                <td><?php echo $li; ?></td>
                <td><?php echo $feeSched['fee_type']; ?></td>
								<td><?php echo $feeSched['fee_name']; ?></td>
                <td><?php echo $feeSched['fee_amount']; ?></td>
                <td><?php echo $feeSched['semester_name']; ?></td>
								<td><?php echo $feeSched['semester_start_date']; ?></td>
                <td><?php echo $feeSched['semester_end_date']; ?></td>
                <td><?php echo $feeSched['school_year_name']; ?></td>
                <td>
                    <a href="#deleteFeesModal<?php echo $li; ?>" class="delete" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </td>
            </tr>
            <!-- Delete Fees Modal -->
            <div id="deleteFeesModal<?php echo $li; ?>" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="deletefeesched.php" method="POST">
                            <div class="modal-header">						
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Fees</h4>
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
                                <input type="hidden" name="fee_schedule_id" value="<?php echo $feeSched['fee_schedule_id']; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php 
            $i++;
        }
    }
} 
?>

<!-- Create Fee Modal HTML -->
<div id="addFeesModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="createfees.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Fees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="feeType">Type of Fee</label>
                        <select name="feeType" id="feeType" class="form-control" required>
                            <option value="" disabled selected>Select your option</option>
                            <option value="University">University</option>
                            <option value="Local">Local</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="feeName">Description</label>
                        <input type="text" name="feeName" id="feeName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="feeAmount">Amount</label>
                        <input type="number" name="feeAmount" id="feeAmount" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="action" value="add">
                    <input type="submit" class="btn btn-success" value="add">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Create Fee Modal HTML -->
<div id="addFeesModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="createfees.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Fees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="feeType">Type of Fee</label>
                        <select name="feeType" id="feeType" class="form-control" required>
                            <option value="" disabled selected>Select your option</option>
                            <option value="University">University</option>
                            <option value="Local">Local</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="feeName">Description</label>
                        <input type="text" name="feeName" id="feeName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="feeAmount">Amount</label>
                        <input type="number" name="feeAmount" id="feeAmount" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="action" value="add">
                    <input type="submit" class="btn btn-success" value="add">
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

<?php

    // resume session here to fetch session values
    session_start();
    require_once '../functions/session.function.php';
	//prevent horny people
    if (!isset($_SESSION['logged_id'])){
        header('location: ../public/logout.php');
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
    <title>University Fees</title>
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
            <h2 class="fs-2 m-0">University Fees</h2>
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
						<a href="universitysched.php" class="btn btn-success" style = " padding: 13px; margin-top: 19px; border-radius:6px;"> <span>View Fee Schedules</span></a>
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
            <?php
if (isset($_GET['fee_id'])) {
    $feeId = $_GET['fee_id'];
    $FeeSched = new UniversityFeeSched();
    $FeeSchedData = $FeeSched->showAllDetailsByFeeId($feeId);
?>
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
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $i = 1;
                foreach($FeeSchedData as $FeeSched) {        
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $FeeSched['university_name']; ?></td>
                    <td><?php echo $FeeSched['university_type']; ?></td>
                    <td><?php echo $FeeSched['university_amount']; ?></td>
                    <td><?php echo $FeeSched['semester_name']; ?></td>
                    <td><?php echo $FeeSched['school_year_name']; ?></td>
                    <td><?php echo date('F j, Y', strtotime($FeeSched['university_start_date'])); ?></td>
                    <td><?php echo date('F j, Y', strtotime($FeeSched['university_end_date'])); ?></td>
                    <td><?php echo $FeeSched['created_by']; ?></td>
                </tr>
            <?php 
                    $i++;
                }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "Fee ID: $feeId";
    echo "No fee ID specified.";
}
?>

</tbody>
</table>
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
                    <input type="hidden" name="action" value="add">
                    <input type="submit" class="btn btn-success" value="create">
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
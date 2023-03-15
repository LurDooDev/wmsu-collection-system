<?php

    // resume session here to fetch session values
    session_start();
    require_once '../functions/session.function.php';
	//prevent horny people
    if (!isset($_SESSION['logged_id'])){
        header('location: ../public/logout.php');
    }
	require_once '../classes/database.class.php';
	require_once '../classes/localfees.class.php';
    require_once '../classes/semester.class.php';
    require_once '../classes/academicyear.class.php';
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
    <title>Wmsu Collection System</title>
    </head>

      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
			<div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold fw-bold">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Remit Records</a>
                <a href="../college/Oldcollege.php" class="list-group-item list-group-item-action bg-hover first-text active">Colleges</a>
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
            <h2 class="fs-2 m-0">Add Scheduling Fees</h2>
        </div>
    </nav>
		<div class="table-wrapper">
		<div class="table-title">
				<div class="row">
					<div class="col-sm-10 ml-auto">
						<a href="university.php" class="btn btn-success"><span>Back To University Fees </span></a>
					</div>
				</div>
                <?php
    // check if college_id is set in GET parameter
    if (isset($_GET['id'])) {
        // fetch college data from database
        $fee = new LocalFee();
        $feeData = $fee->get($_GET['id']);
        // check if college data is found
        if ($feeData) {
?>
    <?php
        } else {
            echo "fees not found.";
        }
    } else {
        echo "Invalid request.";
    }
?>
			</div>
            </br>
            <form action="addlocalSchedule.php" method="post">
            <input type="hidden" name="localID" value="<?php echo $feeData['id']; ?>">
            <!--University Fee-->
            <h3>Category: <span><?php echo $feeData['local_fee_type']; ?></span></h3>
            <h3>Name: <span><?php echo $feeData['local_name']; ?></span></h3>
            <h3><span><?php echo $UserCollege; ?></span></h3>
            <!--University Fee-->
</br></br>
                <div class="form-group">
		  <label for="academicYearID" class="form-label">School Year</label>
            <select class="form-control" id="academicYearID" name="academicYearID" required>
              <option value="">Select your option</option>
			  <?php
			  $AcademicYear = new AcademicYear();
			  $AcademicYearData = $AcademicYear->show();
            	 foreach ($AcademicYearData as $AcademicYear) {
                 ?>
                <option value="<?php echo $AcademicYear['id']; ?>"><?php echo $AcademicYear['academic_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
		  <label for="semesterID" class="form-label">Semester</label>
            <select class="form-control" id="semesterID" name="semesterID" required>
              <option value="">Select your option</option>
			  <?php
			  $semester = new Semester();
			  $semesterData = $semester->show();
            	 foreach ($semesterData as $semester) {
                 ?>
                <option value="<?php echo $semester['id']; ?>"><?php echo $semester['semester_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
            <input type="hidden" name="created_by" value="<?php echo $UserFullname; ?>">
            <input type="hidden" name="collegeID" value="<?php echo $UserCollegeID; ?>">
                <div class="modal-footer">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="btn btn-success" name="action" value="add">Save</button>
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
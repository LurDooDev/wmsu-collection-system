<?php

    // resume session here to fetch session values
    session_start();

	//prevent horny people
    if (!isset($_SESSION['logged_id'])){
        header('location: ../public/logout.php');
    }
	require_once '../classes/database.class.php';
	require_once '../classes/fee.class.php';
	require_once '../classes/semester.class.php';
	require_once '../classes/schoolyear.class.php';
    require_once '../classes/feeSchedule.class.php';


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
                <a href="../admin/dashboard.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Remit Records</a>
                <a href="../college/Oldcollege.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
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
            <h2 class="fs-2 m-0">Fees Scheduling</h2>
        </div>
    </nav>
		<div class="table-wrapper">
		<div class="table-title">
				<div class="row">
					<div class="col-sm-8">
						<a href="fees.php" class="btn btn-success"><span>Back To Fees</span></a>
						<!-- <a href="#deleteFeesModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
					</div>
				</div>
			</div>
            <form action="feesched.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Fees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
		  <label for="fee" class="form-label">Fees</label>
            <select class="form-control" id="fee" name="fee" required>
				
              <option value="">-- Fees --</option>
              <!--Admin Fees-->
              <?php
                            if($_SESSION['user_type'] == 'admin'){ 
                        ?>
			  <?php
			  $fee = new Fee();
			  $feeData = $fee->show();
            	 foreach ($feeData as $fee) {
                    if ($fee['fee_type'] == 'University') {
                 ?>
                <option value="<?php echo $fee['fee_id']; ?>"><?php echo $fee['fee_name']; ?></option>
              <?php } }?>
              <?php }; ?>
            </select>

            <!--Local Fees-->
            <?php
                            if($_SESSION['user_type'] == 'officer'){ 
                        ?>
			  <?php
			  $fee = new Fee();
			  $feeData = $fee->show();
            	 foreach ($feeData as $fee) {
                    if ($fee['fee_type'] == 'Local') {
                 ?>
                <option value="<?php echo $fee['fee_id']; ?>"><?php echo $fee['fee_name']; ?></option>
              <?php } }?>
              <?php }; ?>
            </select>
            <!--End Fees-->

          </div>
                    <div class="form-group">
		  <label for="schoolYear" class="form-label">School Year</label>
            <select class="form-control" id="schoolYear" name="schoolYear" required>
				
              <option value="">-- School Years --</option>
			  <?php
			  $schoolYear = new SchoolYear();
			  $schoolYearData = $schoolYear->show();
            	 foreach ($schoolYearData as $schoolYear) {
                 ?>
                <option value="<?php echo $schoolYear['school_year_id']; ?>"><?php echo $schoolYear['school_year_name']; ?></option>
              <?php } ?>
            </select>

          </div>
          <div class="form-group">
		  <label for="semester" class="form-label">Semester</label>
            <select class="form-control" id="semester" name="semester" required>
				
              <option value="">-- Semester --</option>
			  <?php
			  $semester = new Semester();
			  $semesterData = $semester->show();
            	 foreach ($semesterData as $semester) {
                 ?>
                <option value="<?php echo $semester['semester_id']; ?>"><?php echo $semester['semester_name']; ?></option>
              <?php } ?>
            </select>

          </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="action" value="save">
                    <input type="submit" class="btn btn-success" value="save">
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
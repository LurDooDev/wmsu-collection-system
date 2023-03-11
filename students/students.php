<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])){
    header('location: ../public/logout.php');
}

require_once '../classes/student.class.php';
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
    <link rel="stylesheet" href="../css/students.css" />
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
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a>
                <a href="../payment/payment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment</a>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Admin Settings</a>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>
		<div class="table-responsive" >
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Students</h2>
        </div>
    </nav>
		<div class="table-wrapper">
		<div class="table-title">
				<div class="row">
					<div class="col-sm-4">
					<input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
					<button class="btn btn-primary dropdown-toggle" id ="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Year </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">1st Year</a>
    					<a class="dropdown-item" href="#">2nd Year</a>
                        <a class="dropdown-item" href="#">3rd Year</a>
                        <a class="dropdown-item" href="#">4th Year</a>
					</div>
					</div>
					<div class="col-sm-8">
						<a href="#addStudentModal" class="btn btn-success" id = "add-student" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Student</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover" style="width: 100%;">
				<thead style="text-align: center;">
					<tr>
						<th>#</th>
						<th>Student ID</th>
						<th>Student Name</th>
						<th>College</th>
						<th>Year Level</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody style="text-align: center;">

				<?php
					$students = new Student();
					$studentData = $students->showAllDetails();
					$i = 1;
				foreach($studentData as $students) {
        ?>
					<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $students['student_personal_id']; ?></td>
						<td><?php echo $students['student_fname'], ' ', $students['student_mname'], ' ', $students['student_lname']; ?></td>
						<td><?php echo $students['college_code']; ?></td>
						<td><?php echo $students['year_level']; ?></td>
						<td><?php echo $students['student_email']; ?></td>
						<td>
				</tr>
			<?php $i++; } ?>
					</tbody>
			</table>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addStudentModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="addstudent.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Student</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
                <br>
                <!-- <label for="fileSelect" style = "font-size:15px; margin-left: 20px">Student CSV file Upload</label>
                 <input id="fileSelect" type="file" accept=".csv" style ="margin-left: 30px;"/>
            </label> -->
				<div class="modal-body">
				<div class="form-group">
						<label for="studentID">Student ID</label>
						<input type="text" name="studentID" id="studentID" class="form-control" required>
					</div>					
					<div class="form-group">
						<label for="firstname">First name</label>
						<input type="text" name="firstname" id="firstname" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="middlename">Middle initial</label>
						<input type="text" name="middlename" id="middle" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="lastname">Last name</label>
						<input type="text" name="lastname" id="lastname" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" required>
					</div>
		<div class="form-group">
		  <label for="collegeCode" class="form-label">Colleges</label>
            <select class="form-control" id="collegeCode" name="collegeCode" required>
				
              <option value="">Select your option</option>
			  <?php
			  $colleges = new College();
			  $collegeData = $colleges->show();
            	 foreach ($collegeData as $colleges) {
                 ?>
                <option value="<?php echo $colleges['college_id']; ?>"><?php echo $colleges['college_name']; ?></option>
              <?php } ?>
            </select>

          </div>
             
					<div class="form-group">
                        <label for="yearlevel">Year Level</label>
                        <select name="yearlevel" id="yearlevel" class="form-control" required>
                            <option value="" disabled selected>Select your option</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
							<option value="3rd Year">3rd Year</option>
                            <option value="4rth Year">4rth Year</option>
                        </select>
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
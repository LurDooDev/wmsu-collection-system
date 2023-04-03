<?php
// resume session here to fetch session values
session_start();

if (!isset($_SESSION['logged_id'])) {
    header('location: ..admin-settings/overview_settings.php');
} else if ($_SESSION['role'] != 'admin') {
    if ($_SESSION['role'] == 'officer') {
        header('location: officer.php');
    } else if ($_SESSION['role'] == 'collector') {
        header('location: collector.php');
    }
}

// //prevent horny people
// if (!isset($_SESSION['logged_id'])){
//     header('location: ../public/logout.php');
// }

require_once "../classes/semester.class.php";
require_once "../classes/academicyear.class.php";

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
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/admin-settings.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
                <a href="../college/new-college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
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
                <div class="">
                <?php
                if($_SESSION['role'] == 'admin'){?>
                    <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <?php } ?>
                    <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user-new.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                    <!-- <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Colleges</a></ul> -->
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
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Overview Settings</h2>
        </div>
    </nav>
    <div class="container">
    <div class="d-flex">
                <div class=" ml-auto pl-auto" style="padding-top: 20px; margin-right:-20px;">
                <a href="#addSemesterModal" class="btn btn-success"  style= "margin-right:-100px;" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Semester</span></a>
</div>
<div class="d-flex" style="margin-left:30px">
                <div class=" mr-auto pr-auto ml-4"  style="padding-top: 20px;">
						<a href="#addYearModal" class="btn btn-success" style= "margin-left:100px;" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add School Year</span></a>
					</div>
</div>
</div>

<h style="font-size: 20px;"><b>Semester</b></h>
          <div class =" table-responsive">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >#</th>
                <th scope="col" style = " color: #000000;" >Semester</th>
                <th scope="col" style = " color: #000000;" >Duration</th></th>
                <th scope="col" style = " color: #000000;" >Status</th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                    $Semester = new Semester();
					$data = $Semester->show();
					$i = 1;
					
					foreach($data as $Semester) {
						// Convert both values to lowercase and compare them
							?>
              <tr>
              <td><?php echo $i; ?></td>
								<td><?php echo $Semester['semester_name']; ?></td>
								<td><?php echo $Semester['semester_duration']; ?> months</td>
                <td><?php echo ($Semester['is_active'] == 1) ? "Active" : "Not Active"; ?></td>
                <td>
                    <a href="#updateSemesterModal<?php echo $i; ?>" class="edit" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
</td>

<!--Update-->
<div id="updateSemesterModal<?php echo $i; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="updatesemester.php" method="POST">
                    <div class="modal-header">
                    <h4 class="modal-title"><?php echo $Semester['semester_name']; ?> Settings</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
        <label>Semester Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $Semester['semester_name']; ?>">
    </div>
    <div class="form-group">
        <label>Semester Name</label>
        <input type="number" class="form-control" name="duration" value="<?php echo $Semester['semester_duration']; ?>">
    </div>
    <div class="form-group">
        <label>Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="activeRadio<?php echo $i; ?>" value="1"<?php if($Semester['is_active'] == 1) { echo ' checked'; } ?>>
            <label class="form-check-label" for="activeRadio<?php echo $i; ?>">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="inactiveRadio<?php echo $i; ?>" value="0"<?php if($Semester['is_active'] == 0) { echo ' checked'; } ?>>
            <label class="form-check-label" for="inactiveRadio<?php echo $i; ?>">
                Inactive
            </label>
        </div>
    </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $Semester['id']; ?>">
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
              </tr>
              <?php 
							$i++;
						}
?>
    
        </tbody>
          </table>
</div>



<!--School Year-->

<h style="font-size: 20px;"><b>Academic Year</b></h>
          <div class =" table-responsive">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >#</th>
                <th scope="col" style = " color: #000000;" >Academic Year</th>
                <th scope="col" style = " color: #000000;" >Start Date</th></th>
                <th scope="col" style = " color: #000000;" >End Date</th>
                <th scope="col" style = " color: #000000;" >Status</th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                    $AcademicYear = new AcademicYear();
					$data = $AcademicYear->show();
					$i = 1;
					
					foreach($data as $AcademicYear) {
						// Convert both values to lowercase and compare them
							?>
              <tr>
              <td><?php echo $i; ?></td>
								<td><?php echo $AcademicYear['academic_name']; ?></td>
								<td><?php echo date('F j, Y', strtotime($AcademicYear['academic_start_date'])); ?></td>
                <td><?php echo date('F j, Y', strtotime($AcademicYear['academic_end_date'])); ?></td>
                <td><?php echo ($AcademicYear['is_active'] == 1) ? "Active" : "Not Active"; ?></td>
                <td>
                    <a href="#updateYearModal<?php echo $i; ?>" class="edit" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                </a>
</td>

<!--Update-->
<div id="updateYearModal<?php echo $i; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="updateacademicyear.php" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo $AcademicYear['academic_name']; ?> Year Settings</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
    <div class="form-group">
        <label> Start Date</label>
        <input type="date" class="form-control" name="startdate" value="<?php echo $AcademicYear['academic_start_date']; ?>">
    </div>


    <div class="form-group">
        <label>End Date</label>
        <input type="date" class="form-control" name="enddate" value="<?php echo $AcademicYear['academic_end_date']; ?>">
    </div>
    <div class="form-group">
        <label>Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="activeRadio<?php echo $i; ?>" value="1"<?php if($AcademicYear['is_active'] == 1) { echo ' checked'; } ?>>
            <label class="form-check-label" for="activeRadio<?php echo $i; ?>">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="inactiveRadio<?php echo $i; ?>" value="0"<?php if($AcademicYear['is_active'] == 0) { echo ' checked'; } ?>>
            <label class="form-check-label" for="inactiveRadio<?php echo $i; ?>">
                Inactive
            </label>
        </div>
    </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $AcademicYear['id']; ?>">
                        <input type="submit" class="btn btn-info" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
              </tr>
              <?php 
							$i++;
						}
?>
    
        </tbody>
          </table>
</div>



</div>
<!--Semester add here  -->

<div id="addSemesterModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="addsemester.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Semester</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Semester Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Duration</label>
						<input type="number" name="duration" class="form-control" required>
					</div>	
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="hidden" name="action" value="add">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<!--Year add here  -->
<div id="addYearModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="addacademicyear.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">add Academic Year</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Academic Year</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>academic start at</label>
						<input type="date" name="startdate" class="form-control" required>
					</div>
          <div class="form-group">
						<label>academic end at</label>
						<input type="date" name="enddate" class="form-control" required>
					</div>	
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="hidden" name="action" value="add">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Script for dashboard hamburger         -->
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

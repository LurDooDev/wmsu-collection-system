<?php
// resume session here to fetch session values
session_start();

if (!isset($_SESSION['logged_id'])) {
    header('location: ../public/logout.php');
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
    <link rel="stylesheet" href="../css/admin-settings.css"/>
    <link rel="stylesheet" href="../css/dashboard.css"/>
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
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Remit Records</a>
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
                    <a href="../admin-settings/new-overview.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../university/new-univ.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/new-local.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
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
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Remit Records</h2>
        </div>
    </nav>
    <div class="container">
    <div class="row">
  <div class="col-sm-3 col-12" style="margin-top: 20px; padding-bottom: 20px;">
    <input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
  </div>
  <div class="col-sm-3 col-12" style="margin-top: 20px; padding-bottom: 20px;">
    <button class="btn btn-primary dropdown-toggle" id="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Status</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Paid</a>
      <a class="dropdown-item" href="#">Unpaid</a>
      <a class="dropdown-item" href="#">Partial</a>
    </div>
  </div>
</div>

            <div class =" table-responsive">
                  <table class="table" id="myTable">
              <thead style="background-color:#95BDFE ;" class="text-white">
                <tr>
                  <th scope="col" style = " color: #000000;" >ID</th>
                  <th scope="col" style = " color: #000000;text-align:center;" >Payment Description</th>
                  <th scope="col" style = " color: #000000; text-align:center;" >College</th></th>
                  <th scope="col" style = " color: #000000; text-align:center" >Date</th>
                  <th scope="col" style = " color: #000000;" >Time</th>
                  <th scope="col" style = " color: #000000;" >School Year</th>
                  <th scope="col" style = " color: #000000;" >Semester</th>
                  <th scope="col" style = " color: #000000;" >Amount</th>
                  <th scope="col" style = " color: #000000;text-align:center" >Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
              <td>1</td>
          <td style="text-align:center;">CSB Fee</td>
        <td style="text-align:center;">CCS</td>
              <td>01-01-2022</td>
              <td>10:11</td>
              <td>2022-2023</td>
              <td>1st Semester</td>
              <td>P 120,000</td>
              <td style="text-align:center">Paid</td>


              <?php if(isset($_GET['error'])): ?>
      <input type="hidden" name="error" value="true">
  <?php endif; ?>


  <div id="addStudentModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="addstudent.php<?php if(isset($_GET['error'])) echo '?error=true'; ?>" method="POST">
        <form action="addstudent.php" method="POST">
          <div class="modal-header">						
            <h4 class="modal-title">Add Student</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
                  <br>
          <div class="modal-body">
          <?php if(isset($_GET['error'])): ?>
              <div class="alert alert-danger" role="alert">
                  Error adding student. Please try again.
              </div>
          <?php endif; ?>
          <div class="form-group">
              <label for="studentID">Student ID</label>
              <input type="number" name="studentID" id="studentID" class="form-control" required>
            </div>					
            <div class="form-group">
              <label for="firstname">First name</label>
              <input type="text" name="firstname" id="firstname" class="form-control" required>
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
        <label for="college" class="form-label">Colleges</label>
              <select class="form-control" id="college" name="college" required>
                <option value="">Select your option</option>
          <?php
          $colleges = new College();
          $collegeData = $colleges->show();
                foreach ($collegeData as $colleges) {
                  ?>
                  <option value="<?php echo $colleges['id']; ?>"><?php echo $colleges['college_name']; ?></option>
                <?php } ?>
              </select>

            </div>

        <div class="form-group">
        <label for="program" class="form-label">Programs</label>
              <select class="form-control" id="program" name="program" required>
                <option value="">Select your option</option>
          <?php
          $Program = new Program();
          $ProgramData = $Program->show();
                foreach ($ProgramData as $Program) {
                  ?>
                  <option value="<?php echo $Program['id']; ?>"><?php echo $Program['program_name']; ?></option>
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
<div class="modal fade" id="addCSV" data-backdrop="static">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Student CSV</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body-md">
        <div class="drop-zone">
    <span class="drop-zone__prompt" style="margin-left: 20px;"> Drop file here or click to upload</span>
    <input  type="file" name="myFile" class="drop-zone__input" style="margin-left: 20px;">
  </div>

  <script src="./src/main.js"></script>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary">Upload This File</a>
        </div>
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

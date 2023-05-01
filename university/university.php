<?php
  // resume session here to fetch session values
  session_start();
  require_once '../functions/session.function.php';
  
  if (!isset($_SESSION['logged_id'])) {
    header('location: ../admin/dashboard-user.php');
} else if ($_SESSION['role'] != 'officer' && $_SESSION['role'] != 'admin') {
    header('location: dashboard-user.php');
}


require_once '../classes/semester.class.php';
require_once '../classes/academicyear.class.php';
require_once '../classes/universityfees.class.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
            
              if($_SESSION['role'] == 'admin'){?>
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <?php } ?>
                <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <?php } ?>
                <!-- <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a> -->
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <?php } ?>
                <?php
                if($_SESSION['role'] == 'officer'){?>
                <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
                <?php } ?>
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <?php } ?>
                <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <?php } ?>
                
                <!-- <?php
                if($_SESSION['role'] == 'admin'){?>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <?php } ?> -->
                <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <?php } ?>
                
                <!-- </button> 
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <div class="dropdown-container">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
                </div>
                <?php } ?> -->
                <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <?php } ?>
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <?php } ?>
                <?php
                if($_SESSION['role'] == 'officer'){?>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <?php } ?>
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <?php } ?>
                <div class="dropdown-container">
                
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                
                
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                
                </button>
                
                <?php
                    if($_SESSION['role'] == 'admin'){?>
                <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                <?php }?>
                <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <?php }?>
                <?php
                if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'officer'){?>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
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
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">University Fee</h2>
        </div>
    </nav>
	
    <div class="container">
                <div class="row" style="padding-top:  21px;">
				<div class="col-sm-4" style="border-color: #000000;">
        			<!-- <input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name"> -->
                    
       			 </div>
        <div class="col-sm-4">
        <!-- <button class="btn btn-primary dropdown-toggle" id ="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By </button>
						<div class="dropdown-menu">
    					<a class="dropdown-item" href="#">Ascending</a>
    					<a class="dropdown-item" href="#">Descending</a>
					  </div> -->
          </div>
          <?php
                    if($_SESSION['role'] == 'admin'){?>
					<div class="col-sm-4 " style="display: flex; align-items: center; justify-content: flex-end;">
						<a href="#addCollectorModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fees</span></a>
					</div>
          <?php } ?>
				</div>
             <div class =" table-responsive" style="margin-top: 10px;">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >#</th>
                <th scope="col" style = " color: #000000;" >Academic Year</th>
			        	
                <th scope="col" style = " color: #000000;" >Name</th></th>
				<th scope="col" style = " color: #000000;" >Amount</th></th>
                <th scope="col" style = " color: #000000;" >Start Date</th></th>
                <th scope="col" style = " color: #000000;" >End Date</th></th>
                <th scope="col" style = " color: #000000; text-align:center" >Created By</th></th>
                <th scope="col" style = " color: #000000; text-align:center" >Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
// Create an instance of the UniversityFee class
$Fee = new UniversityFees();

// Get all the fees from the database
$FeeData = $Fee->showAllDetails();

$i = 1;
foreach($FeeData as $Fee) {        
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $Fee['academic_name']; ?></td>
        <td><?php echo $Fee['fee_name']; ?></td>
        <td>Php <?php echo $Fee['fee_amount']; ?></td>
        <td><?php echo date('F j, Y', strtotime($Fee['start_date'])); ?></td>
        <td><?php echo date('F j, Y', strtotime($Fee['end_date'])); ?></td>
        <td style="text-align:center"><?php echo $Fee['created_by']; ?></td>
        <td style="text-align:center">
            <!-- <a href=".php?id=<?php echo $Fee['id']; ?>" class="edit"> -->
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
        </td>
    </tr>
    <?php 
    $i++;
}
?>
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
    <label for="amount" class="form-label">Amount</label>
    <div class="input-group">
        <input type="number" class="form-control" id="amount" name="amount" min="0" step="any" placeholder="200" required pattern="\d+(\.\d{1,2})?">
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
			<form action="adduniversityfees.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Fees</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
    <div class="row">
        <div class="col-sm-6">
            <h5>Details</h5>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control sm" required aria-describedby="name-description" placeholder="CSB FEE">
                <div id="name-description" class="form-text">Enter the name of the fee.</div>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required aria-describedby="amount-description" placeholder="PHP 200">
                </div>
                <div id="amount-description" class="form-text">Enter the amount of the fee.</div>
            </div>
        </div>
        <div class="col-sm-6">
            <h5>Scheduling</h5>
            <div class="form-group">
                <label for="academicYearID" class="form-label">Academic Year</label>
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
                <label for="startdate">Start Date</label>
                <input type="date" name="startdate" id="startdate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="enddate">End Date</label>
                <input type="date" name="enddate" id="enddate" class="form-control" required>
            </div>
        </div>
    </div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="action" value="Save">
          <input type="hidden" name="created_by" value="<?php echo $UserFullname; ?>">
					<input type="submit" class="btn btn-success" value="Save">
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

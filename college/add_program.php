<?php
    session_start();
	require_once '../functions/session.function.php';

	//prevent unauthorized access
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../audit-log/audit-log.php');
	} else if ($_SESSION['role'] != 'admin') {
		if ($_SESSION['role'] == 'officer') {
			header('location: admin.php');
		} else if ($_SESSION['role'] == 'collector') {
			header('location: collector.php');
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
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/college1.css" />
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
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <!-- <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a> -->
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <a href="../college/new-college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Colleges</a>
                <!-- <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <i class="fa fa-caret-down" style="margin-left: 115px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
                </div> -->
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <?php
                if($_SESSION['role'] == 'admin'){?>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Audit Log</a>
                <?php } ?>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="">
                    <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
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
            <h2 class="fs-2 m-0"  style="color:#000000; font-weight: 500;">Add Program</h2>
        </div>
    </nav>
    <div class="container-fluid"> 
    <div class="row">
        <div class="col-12">
        <div class="table-wrapper">
                <?php
    // check if college_id is set in GET parameter
    if (isset($_GET['id'])) {
        // fetch college data from database
        $College = new College();
        $CollegeData = $College->get($_GET['id']);
        // check if college data is found
        if ($CollegeData) {
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
           <form action="addprogram.php" method="post">
  <input type="hidden" name="collegeID" value="<?php echo $CollegeData['id']; ?>">
  <div class="row">
    <div class="col-6">
    <!--College -->
    <h3 style="text-align:left;">College Name: <span><?php echo $CollegeData['college_name']; ?></span></h3>
    <h3 style="text-align: left;">College Code: <span><?php echo $CollegeData['college_code']; ?></span></h3>
    </div>
    <!--College-->
  </div>

</br></br>
<div class="form-group" style="margin-top: -50px;">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="row">
    <div class="modal-footer">
        <form>
            <input type="hidden" name="action" value="add">
            <div class="d-flex justify-content-between w-100">
                <div>
                    <a href="new-college.php" class="btn btn-success" id="back-fee"><span>Back To College</span></a>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="action" id="save" value="add">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>



</div>

<!-- Create Fee Modal HTML -->
<div id="addCollege" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="addcollege.php" method="POST" id="add-college">
                <div class="modal-header">
                    <h4 class="modal-title">College</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
					<div class="form-group">
                        <label for="code">Enter Code</label>
                        <input type="text" name="code" id="code" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" name="action" value="add">
                    <input type="submit" class="btn btn-success" value="Create">
                </div>
            </form>  
        </div>
        
</body>       

<!-- Script for dashboard hamburger         -->
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

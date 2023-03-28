<?php
// resume session here to fetch session values
session_start();
require_once '../functions/session.function.php';
//prevent horny people
if (!isset($_SESSION['logged_id'])) {
  header('location: ../public/logout.php');
} else if ($_SESSION['role'] != 'officer') {
  if ($_SESSION['role'] == 'admin') {
      header('location: dashboard.php');
  } else if ($_SESSION['role'] == 'collector') {
      header('location: dashboard-user.php');
  }
}


require_once '../classes/student.class.php';
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
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/payments.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <!--Jquery NEED-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--Jquery NEED-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Wmsu Collection System</title>
    </head>
      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
            <div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Payments</a>
                <i class="fa fa-caret-down" style = "margin-left:70px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../payment/universitypayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <a href="../payment-local/localpayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Local Payment</a>
                </div>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../user-univ-fee/univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a>
                    <a href="../user-local-fee/local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
                </div>            
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>               
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Payments</h2>
        </div>
    </nav>
<div class="container">
		<div class="row justify-content-center">
			<div class="justify-content-center">
				<div class="">

        <ul id="progressbar" class="justify-content-center">
  <li class="" id="step1">
    <strong>Search User</strong>
  </li>
  <li class="" id="step2">
    <strong>University Fees</strong>
  </li>
  <li class="active" id="step3">
    <strong>University Payment Details</strong>
  </li>
  <li id="step4">
    <strong>Transaction Complete</strong>
  </li>
</ul>

						<div class="">
</div>
						</div> <br>
<fieldset>
          <!-- content here -->
    <div class="page-header text-blue-d2">
      <?php
    if (isset($_GET['studentID'])) {
  $studentId = $_GET['studentID'];
  $student = new Student();
  $studentData = $student->showAllDetailsBystudentId($studentId);

?>
        <div class="page-tools">
            <div class="action-buttons">
            </div>
        </div>
    </div>
    <?php
    
                foreach($studentData as $student) {        
            ?>
    <hr class="row brc-default-l1 mx-n1 mb-4" />
    <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <h2 class="text-600 text-110 text-black align-middle"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h2>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                University Fee Payment
                            </div>
                            <div class="my-1">
                               Western Mindanao State University
                         </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="my-2"> <span class="text-600 text-90">ID:</span> <?php echo $student['id']; ?></div>
                            <div class="my-2"> <span class="text-600 text-90">College:</span> <?php echo $student['college_name']; ?></div>
                            <div class="my-2"> <span class="text-600 text-90">Course:</span> <?php echo $student['program_name']; ?></div>
                        </div>
                    </div>
                    <?php 
          
                };
            ?>
                    <!-- /.col -->
                </div>
                <?php
} else {
    echo "student ID: $studentId";
}
?>
                <div class="table-responsive" id="yati">
                <table class="table table-bordered">
                <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" >#</th>
                <th scope="col">Description</th>
                <th scope="col" style = " text-align:center;" >Amount</th>
                <th scope="col">Semester</th>
                <th scope="col">School Year</th>
              </tr>
            </thead>
            <?php
            if (isset($_GET['universityID'])) {
    $feeId = $_GET['universityID'];
    $FeeSched = new UniversityFeeSched();
    $FeeSchedData = $FeeSched->showAllDetailsByPayId($feeId);
?>
            <tbody>
            <?php
                $i = 1;
                foreach($FeeSchedData as $FeeSched) {        
            ?>
              <tr>
              <td><?php echo $i; ?></td>
                <td><?php echo $FeeSched['university_name']; ?></td>
                <td>₱ <?php echo $FeeSched['university_amount']; ?></td>
                    <td><?php echo $FeeSched['semester_name']; ?></td>
                    <td><?php echo $FeeSched['academic_name']; ?></td>
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
</div>
<hr />
<div class="ml-auto p-auto">
    <div class="d-flex">
                <div class="mr-auto">
                <a href="universitypayment_fees.php?studentID=<?php echo $_GET['studentID']; ?>" class="btn btn-success" style="border-radius: 40px; padding: 5px 40px; font-size: 18px;"><span>Previous </span></a>
</div>
<form action="save_universitypayment.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="hidden" name="studentID" value="<?php echo $_GET['studentID']; ?>">
    <input type="hidden" name="universityID" value="<?php echo $_GET['universityID']; ?>">
    <label for="paymentAmount" style="text-align:right; font-weight:bold;">Payment Amount:</label>
    <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" required>
  </div>
  <div class="form-group">
    <label for="paymentImage">If, Partial Upload Promisorry image:</label>
    <input type="file" class="form-control-file" id="paymentImage" name="paymentImage">
  </div>
  <div class="d-flex">
  <input type="submit" class="btn btn-success" value="Pay" id="backstreet" style="border-radius: 40px; padding: 5px 40px; font-size: 18px;" name="submit">
</div>

</form>


</fieldset>
  
</body>   
</html>    
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

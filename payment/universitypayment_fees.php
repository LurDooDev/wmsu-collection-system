<?php

    // resume session here to fetch session values
    session_start();

	//prevent horny people
	if (!isset($_SESSION['logged_id'])) {
		header('location: ../new-payment/payment.php');
	} else if ($_SESSION['role'] != 'officer') {
		if ($_SESSION['role'] == 'admin') {
			header('location: officer.php');
		} else if ($_SESSION['role'] == 'collector') {
			header('location: collector.php');
		}
	}	
	require_once '../classes/database.class.php';
  require_once '../classes/universitypending.class.php';
	require_once '../classes/student.class.php';
  
  $name = '';
  $academicYear = '';
  $college = '';
  $studentPersonalID = '';

  
  
  if (isset($_GET['studentID'])) {
  $studentId = $_GET['studentID'];
  $student = new Student();
  $studentData = $student->showAllDetailsBystudentId($studentId);
  foreach($studentData as $student) {
    $studentPersonalID = $student['id'];
    $name = $student['first_name'] . ' ' . $student['last_name'];
    $academicYear = $student['academic_name'];
    $college = $student['college_name'];
  };
} else {
  echo "student ID: $studentId";
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/smartwizard/4.5.1/css/smart_wizard.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/payments.css" />

	<link rel="icon" type="image/jpg" href="../images/usc.png"/>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smartwizard/4.5.1/js/jquery.smartWizard.min.js"></script>
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
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                  <?php
                  if($_SESSION['role'] == 'officer'){?>
                <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active ">Payments</a>
                    <?php } ?>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../user-univ-fee/new-univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a>\
                  <?php  if($_SESSION['role'] == 'officer'){?>
                    <a href="../user-local-fee/new-local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
                    <?php } ?>
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
          <!-- content here -->
    <div class="page-header text-blue-d2">

        <div class="page-tools">
            <div class="action-buttons">
            </div>
        </div>
    </div>
    <hr class="row brc-default-l1 mx-n1 mb-4" />
    <div class="row">
                    <div class="col-sm-6">
                        <div class = "text-black-m5" style = "font-size :20px;">
                            <h2 class="text-600 text-120 text-black align-middle "></h2>
                            <?php echo $name; ?>
                        </div>
                        <div class="text-black-m5">
                            <div class="my-1" style = "font-size:20px;">
                            Western Mindanao State University
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-105 col-sm-6 align-self-start d-sm-flex justify-content-end">
  <hr class="d-sm-none" />
  <div class="text-black-m5" style = "margin-right:60px;">
    <div class="my-2 text-bigger"> <span class="text-600 text-100">Student ID : <?php echo $studentPersonalID; ?></span> </div>
    <div class="my-2 text-bigger"> <span class="text-600 text-100"><?php echo $college; ?></span> </div>
    <div class="my-2 text-bigger"> <span class="text-600 text-100">Enrolled in <?php echo $academicYear; ?></span> </div>

</div>
                  </div>

                    <!-- /.col -->
                </div>
                <div class="my-1" style = "font-size:20px;">
                               Pending Fees
                               <div class="d-flex" style="color:#000000;">
</div>
                         </div>
                <div class ="col-sm-12" style="padding-bottom: 10px;">
  <!-- <a href="#" class="btn btn-primary" id="all-btn">
      <span>All</span>
    </a> -->
  
<!-- University and Local Buttons -->
<div class="row mb-4">
  <div class="col-sm-12">
  </div>
                <div class ="col-sm-12" style="padding-bottom: 10px;">
    <a href="#" class="btn btn-primary" id="university-btn">
      <span>University</span>
    </a>
    <a href="#" class="btn btn-primary" id="local-btn">
      <span>Local</span>
    </a>
  </div>
</div>

<form method="post" action="process_payment.php" >
<input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
  <table id="university-table" class="table">
    <thead style="background-color:#95BDFE;" class="text-white">
      <tr>
        <th></th>
        <th>Academic year</th>
        <th>Semester</th>
        <th>Title</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $Fees = new UniversityPending();
        $FeesData = $Fees->showAllFeesBystudentId($studentId);

        foreach ($FeesData as $Fees) {
      ?>
          <tr>
            <td><input type="checkbox" name="fees[]" value="<?php echo $Fees['id']; ?>" class="fee-checkbox"></td>
            <td><?php echo $Fees['academic_name']; ?></td>
            <td><?php echo $Fees['semester_name']; ?></td>
            <td><?php echo $Fees['fee_name']; ?></td>
            <td><?php echo $Fees['pending_amount']; ?></td>
            <td><?php echo $Fees['university_status']; ?></td>
          </tr>
      <?php
          }
      ?>
    </tbody>
  </table>
  
  <div class="d-flex">
    <div class="mr-auto p-auto" style="border-radius: 6px;">
      <a href="../new-payment/search-user.php" class="btn btn-success">
        <span>Back to Search</span>
      </a>
    </div>

    <div class="ml-auto p-auto" style="border-radius: 6px;">
      <div>Total amount: <span id="total-amount">0</span></div>
      <button type="submit" class="btn btn-success" id="pay-now-btn">
        <span>Pay Now!</span>
      </button>
    </div>
  </div>
</form>

<!-- Local Table -->
<form method="post" action="process_local_payment.php" id="local-form" style="display: none;">
<input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
  <table id="local-table" class="table">
    <thead style="background-color:#95BDFE;" class="text-white">
      <tr>
        <th></th>
        <th>Title</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $LocalFees = new LocalPending();
        $LocalFeesData = $LocalFees->showAllFeesBystudentId($studentId);
        foreach ($LocalFeesData as $LocalFee) {
          ?>
              <tr>
                <td><input type="checkbox" name="fees[]" value="<?php echo $LocalFee['id']; ?>" class="fee-checkbox"></td>
                <td><?php echo $LocalFee['fee_name']; ?></td>
                <td><?php echo $LocalFee['pending_amount']; ?></td>
                <td><?php echo $LocalFee['local_status']; ?></td>
              </tr>
          <?php
              }
          ?>
        </tbody>
        </table>
  <div class="d-flex">
    <div class="mr-auto p-auto" style="border-radius: 6px;">
      <a href="../new-payment/search-user.php" class="btn btn-success">
        <span>Back to Search</span>
      </a>
    </div>
    <div class="ml-auto p-auto" style="border-radius: 6px;">
  <div>Total amount: <span id="local-total-amount">0</span></div>
  <button type="submit" class="btn btn-success" id="local-pay-now-btn">
    <span>Pay Now!</span>
  </button>
</div>
</div>
</form>




    </body>
</html>
<script>
$(document).ready(function() {
  // Show university table and hide local table on university button click
  $("#university-btn").click(function() {
    $("#university-table").show();
    $("#local-table").hide();
    $("#all-table").hide();
  });

  // Show local table and hide university table on local button click
  $("#local-btn").click(function() {
    $("#local-table").show();
    $("#university-table").hide();
    $("#all-table").hide();
  });

 // Calculate and display total amount on checkbox change
$("input[type='checkbox']").change(function() {
  var total = 0;
  $("input[type='checkbox']:checked").each(function() {
    var amount = parseFloat($(this).closest("tr").find("td:eq(4)").text());
    total += amount;
  });
  $("#total-amount").text(total);
  
});


  // Submit form on pay button click
  $("#pay-btn").click(function() {
    $("form").submit();
  });
});


</script>



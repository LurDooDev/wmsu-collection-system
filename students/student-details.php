<?php
// resume session here to fetch session values
session_start();

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
require_once '../classes/localpayment.class.php';

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
                  <?php
                  if($_SESSION['role'] == 'officer'){?>
                <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Payments</a>
                    <?php } ?>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <!-- <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a> -->
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a>
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
            <h2 class="fs-2 m-0" style="color: black;">Student Details</h2>
        </div>
    </nav>
<div class="container" id="">
<div class="table-responsive">
          <!-- content here -->
          <?php
    if (isset($_GET['studentID'])) {
  $studentId = $_GET['studentID'];
  $student = new Student();
  $studentData = $student->showAllDetailsBystudentId($studentId);

  foreach($studentData as $student) {  

?>
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d" style="font-size: 35px; font-weight: bold;">Student ID: <?php echo $student['id']; ?></h1>
        <a href="students.php" class="arrow-icon" ><i class="fas fa-arrow-left"></i></a>  
        </div>
    </div>
    <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Name:</span>
                            <span class="text-600 text-110 text-black align-middle"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></span>
                        </div>
                        <div class="my-1">
                            <span class="text-sm text-black text-black align-middle"><?php echo $student['college_name']; ?></span>
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Course: </span>
                            <span class="text-sm text-grey text-black align-middle"><?php echo $student['program_name']; ?></span>
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Year Level: </span>
                            <span class="text-sm text-grey text-black align-middle"><?php echo $student['year_level']; ?></span>
                         </div>
                       
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Email: </span>
                            <span class="text-sm text-grey text-black align-middle"><?php echo $student['student_email']; ?></span>
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Balance: </span>
                            <span class="text-sm text-grey text-black align-middle"><?php echo $student['outstanding_balance']; ?></span>
                         </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                        <img src="../images/ccs.jpg" width ="100" alt="CCS COLLECTION FEE" style="margin-top: -15px; padding-bottom: 10px;">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <?php
  };
} else {
    echo "student ID: $studentId";
}
?>
    <div class="table-responsive" id="yati">
  <table class="table">
    <thead style="background-color:#95BDFE ;" class="text-white">
      <tr>
      <th scope="col" style="text-align:center;">Payment Type</th>
        <th scope="col" style="text-align:center;">Title</th>
        <th scope="col" style="text-align:center;">Payment Status</th>
        <th scope="col" style="text-align:center;">Fee Amount</th>
        <th scope="col" style="text-align:center;">Amount Paid</th>
        <th scope="col" style="text-align:center;">Collected By</th>
        <th scope="col" style="text-align:center;">Date</th>
        <th scope="col" style="text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
        // Retrieve payment data from the database
        $payment = new LocalPayment();

        // Check if a filter button was clicked
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $paymentData = $payment->getPaymentsByStatusAndStudentId($status, $studentId);
        } else {
            $paymentData = $payment->getPaymentsByStudentId($studentId);
        }

        // Loop through each payment and display it in a row of the table
        foreach ($paymentData as $payment) {
    ?>
    <tr>
    <td class="text-center"><?php echo $payment['local_fee_type']; ?></td>
<td class="text-center"><?php echo $payment['local_name']; ?></td>
<td class="text-center"><?php echo $payment['payment_status'] ? 'Paid' : 'Partial'; ?></td>
<td class="text-center"><?php echo $payment['payment_fee_amount']; ?></td>
<td class="text-center"><?php echo $payment['payment_amount']; ?></td>
<td class="text-center"><?php echo $payment['collected_by']; ?></td>
<td class="text-center"><?php echo date('F j, Y g:i A', strtotime($payment['payment_date'])); ?></td>
<td class="text-center">Coming Soon </td>
    </tr>
    <?php
        }
    ?>
    </tbody>
  </table>
</div>

<!-- Filter buttons -->
<div class="btn-group" role="group">
    <a href="?studentID=<?php echo $studentId ?>&status=1" class="btn btn-primary">Paid</a>
    <a href="?studentID=<?php echo $studentId ?>&status=0" class="btn btn-primary">Partial</a>
</div>


<script>

  $(document).ready(function() {
    // Add click event listener to filter buttons
    $('.filter-btn').click(function() {
      var status = $(this).data('status');
      var url = window.location.href.split('?')[0] + '?studentID=<?php echo $studentId ?>&status=' + status;
      window.location.href = url;
    });

    // Check for status parameter in URL and set active filter button
    var status = getUrlParameter('status');
    if (status) {
      $('.filter-btn').removeClass('active');
      $('.filter-btn[data-status="' + status + '"]').addClass('active');
    }
  });

  // Function to get URL parameters
  function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
  };
</script>


   <!--Edit-->
   <div id="editDetails" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="student-details.php" method="POST">
      <div class="modal-header">
  <h4 class="modal-title">Edit Details</h4>
  <a href="student-details.php" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> </a>
</div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Payment Details</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Receipt Number</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Student ID</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Student Name</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>College</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Program</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Year Level</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Fee Amount</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" name="name" value="">
              </div>
              <div class="form-group">
                <label>Collected By:</label>
                <input type="text" class="form-control" name="name" placeholder="Eljen Augusto" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="btn btn-default" data-dismiss="modal">Cancel</a>
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" value="edit">
          <input type="submit" class="btn btn-info" id="save" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>

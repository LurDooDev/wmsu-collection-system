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
                  <?php
                  if($_SESSION['role'] == 'officer'){?>
                    <a href="../payment/universitypayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <?php } ?>
                    <a href="../payment-local/localpayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Local Payment</a>
                </div>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
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
        <th scope="col" style="text-align:center;">Payment Details</th>
        <th scope="col" style="text-align:center;">Receipt Number</th>
        <th scope="col" style="text-align:center;">Student ID</th>
        <th scope="col" style="text-align:center;">Student Name</th>
        <th scope="col" style="text-align:center;">College</th>
        <th scope="col" style="text-align:center;">Program</th>
        <th scope="col" style="text-align:center;">Year Level</th>
        <th scope="col" style="text-align:center;">Description</th>
        <th scope="col" style="text-align:center;">Fee Amount</th>
        <th scope="col" style="text-align:center;">Amount</th>
        <th scope="col" style="text-align:center;">Collected By</th>
        <th scope="col" style="text-align:center;">Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td style="text-align: center; padding: 5px; ">University Fee</td>
      <td style="text-align: center; padding: 5px; ">111111</td>
      <td style="text-align: center; padding: 5px; ">201503664</td>
      <td style="text-align: center; padding: 5px; ">Bryan Christian Sevilla</td>
      <td style="text-align: center; padding: 5px;">CCS</td>
      <td style="text-align: center; padding: 5px;">BSCS</td>
      <td style="text-align: center; padding: 5px;">3rd Year</td>
      <td style="text-align: center; padding: 5px;">CSB Fee</td>
      <td style="text-align: center; padding: 5px;">₱ 200
      <td style="text-align: center; padding: 5px;">₱ 200</td>
      <td style="text-align: center; padding: 5px;">Eljen Augusto</td>
      <td style="text-align: center; padding: 5px;"> 
  <div class="d-flex justify-content-center">
    <button class="view btn btn-outline-dark btn-sm me-2" data-bs-toggle="modal" data-bs-target="#paymentdetails">
      <i class="material-icons">receipt</i>
    </button>
    <button class="view btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editDetails">
      <span class="material-symbols-outlined">edit</span>
    </button>
  </div>
      </td>
      </tr>
      <tr>
      <td style="text-align: center; padding: 5px; ">University Fee</td>
      <td style="text-align: center; padding: 5px; ">111121</td>
      <td style="text-align: center; padding: 5px;">201503664</td>
      <td style="text-align: center; padding: 5px; ">Bryan Christian Sevilla</td>
      <td style="text-align: center; padding: 5px;">CCS</td>
      <td style="text-align: center; padding: 5px;">BSCS</td>
      <td style="text-align: center; padding: 5px;">3rd Year</td>
      <td style="text-align: center; padding: 5px;">CSV Fee</td>
      <td style="text-align: center; padding: 5px;">₱ 200</td>
      <td style="text-align: center; padding: 5px;">₱ 200</td>
      <td style="text-align: center; padding: 5px;">Eljen Augusto</td>
      <td style="text-align: center; padding: 5px;">
  <div class="d-flex justify-content-center">
    <button class="view btn btn-outline-dark btn-sm me-2" data-bs-toggle="modal" data-bs-target="#paymentdetails">
      <i class="material-icons">receipt</i>
    </button>
    <button class="view btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editDetails">
      <span class="material-symbols-outlined">edit</span>
    </button>
  </div>
      </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="modal fade modal-fullscreen" id="paymentdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="text-center">
<h5 class="modal-title" id="exampleModalLabel" style="font-size: 30px; margin-top: 20px">College of Computing Studies(CCS)</h5>
</div>
        <div class="modal-body">
        <div class="table-responsive">
          <!-- content here -->
    <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Name:</span>
                            <span class="text-600 text-110 text-black align-middle">Bryan Christian Sevilla</span>
                        </div>
                        <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Email:</span>
                            <span class="text-sm text-grey text-black align-middle">sl201503664@wmsu.edu.ph</span>
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Date:</span>
                            <span class="text-sm text-grey text-black align-middle">11-02-2022</span>
                         </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                        <img src="../images/ccs.jpg" width ="100" alt="CCS COLLECTION FEE" style="margin-top: 0px; padding-bottom: 10px;">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="table-responsive" id="yati">
                <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
  <thead style="color: grey; background-color: black;">
      <th style="text-align: center; padding: 5px; border-right: 2px;">Payment Details</th>
      <th style="text-align: center; padding: 5px; border-right: 2px;">Receipt Number</th>
      <th style="text-align: center; padding: 5px; border-right: 2px;">Student ID</th>
      <th style="text-align: right; padding: 5px;">Student Name</th>
      <th style="text-align: center; padding: 5px;">College</th>
      <th style="text-align: center; padding: 5px;">Program</th>
      <th style="text-align: center; padding: 5px;">Year Level</th>
      <th style="text-align: center; padding: 5px;">Description</th>
      <th style="text-align: center; padding: 5px;">Fee Amount</th>
      <th style="text-align: center; padding: 5px;">Amount</th>
      <th style="text-align: center; padding: 5px;">Collected By</th>
  </thead>
  <tbody>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">University Fee</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">111111</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">201503664</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">Bryan Christian Sevilla</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">CCS</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">BSCS</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">3rd Year</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">CSV Fee</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">PHP 200</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">PHP 200</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">Eljen Augusto</td>
  </tbody>
</table>
</table>
</div>
<br>
<br>
  <div class="row">
    <div class="col-sm-6">
      <div>
        <span class="text-sm text-110 text-black align-middle">Payment Method:</span>
        <span class="text-600 text-110 text-black align-middle">Cash</span>
      </div>
      <br>
    </div>
    <div class="col-sm-6 d-flex flex-column align-items-end align-content-stretch" style="flex: 0 0 48%;">
    <div class="d-flex justify-content-end align-items-center">
    <button class="btn bg-white btn-light mx-1px text-95" style="border: 1px solid black;" href="#" data-title="Print">
      <i class="ml-auto fa fa-print text-primary-m1 text-120 w-2"></i> Print
    </button>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade modal-fullscreen" id="#" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="text-center">
<h5 class="modal-title" id="exampleModalLabel" style="font-size: 30px; margin-top: 20px">College of Computing Studies(CCS)</h5>
</div>
        <div class="modal-body">
        <div class="table-responsive">
    <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Name:</span>
                            <span class="text-600 text-110 text-black align-middle">Bryan Christian Sevilla</span>
                        </div>
                        <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Email:</span>
                            <span class="text-sm text-grey text-black align-middle">sl201503664@wmsu.edu.ph</span>
                         </div>
                        <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Date:</span>
                            <span class="text-sm text-grey text-black align-middle">11-02-2022</span>
                         </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                        <img src="../images/ccs.jpg" width ="100" alt="CCS COLLECTION FEE" style="margin-top: 0px; padding-bottom: 10px;">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="table-responsive" id="yati">
                <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
  <thead style="color: grey; background-color: black;">
      <th style="text-align: center; padding: 5px; border-right: 2px;">Payment Details</th>
      <th style="text-align: center; padding: 5px; border-right: 2px;">Receipt Number</th>
      <th style="text-align: center; padding: 5px; border-right: 2px;">Student ID</th>
      <th style="text-align: right; padding: 5px;">Student Name</th>
      <th style="text-align: center; padding: 5px;">College</th>
      <th style="text-align: center; padding: 5px;">Program</th>
      <th style="text-align: center; padding: 5px;">Year Level</th>
      <th style="text-align: center; padding: 5px;">Description</th>
      <th style="text-align: center; padding: 5px;">Fee Amount</th>
      <th style="text-align: center; padding: 5px;">Amount</th>
      <th style="text-align: center; padding: 5px;">Collected By</th>
  </thead>
  <tbody>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">University Fee</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">111111</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">201503664</td>
      <td style="text-align: right; padding: 5px; border-right: 1px solid black;">Bryan Christian Sevilla</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">CCS</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">BSCS</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">3rd Year</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">CSV Fee</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">PHP 200</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">PHP 200</td>
      <td style="text-align: center; padding: 5px;border-right: 1px solid black;">Eljen Augusto</td>
  </tbody>
</table>
</div>
<br>
<br>
  <div class="row">
    <div class="col-sm-6">
      <div>
        <span class="text-sm text-110 text-black align-middle">Payment Method:</span>
        <span class="text-600 text-110 text-black align-middle">Cash</span>
      </div>
      <br>
    </div>
    <div class="col-sm-6 d-flex flex-column align-items-end align-content-stretch" style="flex: 0 0 48%;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>

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

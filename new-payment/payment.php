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
	require_once '../classes/fee.class.php';
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
                <a href="../new-payment/payment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active ">Payments</a>
                    <?php } ?>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Payment Records</a>
                <a href="../students/new-students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../user-univ-fee/new-univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a>
                    <a href="../user-local-fee/new-local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
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
    <div class="col-sm-4 col-lg-4 ml-5 d-flex justify-content-end" style="padding-top: 21px; padding-bottom: 10px;">
      <button class="btn btn-primary dropdown-toggle text-left" id="sort-by" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">University</a>
        <a class="dropdown-item" href="#">Local</a>
      </div>
    </div>
    <div class="col-sm-12 col-lg-12 mx-auto">
      <div class="table-responsive">
        <table class="table">
          <thead style="background-color:#95BDFE;" class="text-white">
            <tr>
              <th scope="col" style="color:#000000;"><input type="checkbox" id="checkAll"></th>
              <th scope="col" style="color:#000000;">#</th>
              <th scope="col" style="color:#000000;text-align:center;">Name</th>
              <th scope="col" style="color:#000000; text-align:center">Type of Fees</th>
              <th scope="col" style="color:#000000;text-align:center;">Amount</th>
              <th scope="col" style="color:#000000;text-align:center;">Paid Amount</th>
              <th scope="col" style="color:#000000;text-align:center;">Balance</th>
              <th scope="col" style="color:#000000;text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td>1</td>
              <td style="text-align:center;">CSB</td>
              <td style="text-align: center;">University Fees</td>
              <td style="text-align:center;">200</td>
              <td style="text-align:center;">0</td>
              <td style="text-align:center;">200</td>
              <td style="text-align:center;">
                <a href="#editFeesModal" class="edit" data-toggle="modal">
                  <span class="material-symbols-outlined" title="Partial">
                    order_approve
                  </span>
                </a>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td>2</td>
              <td style="text-align:center;">PSIT</td>
              <td style="text-align: center" >Local Fees</td>
              <td style="text-align:center;">150</td>
              <td style="text-align:center;">0</td>
              <td style="text-align:center;">150</td>
              <td style="text-align:center;">
                <a href="#editFeesModal" class="edit" data-toggle="modal">
                  <span class="material-symbols-outlined" title="Partial">
                    order_approve
                  </span>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  <div class="row mt-3">
    <div class="col-sm-12">
      <div class="d-flex justify-content-end">
		<a href="payment.php" class="btn btn-success" style="border-radius: 40px; padding: 5px 40px; font-size: 18px;">
			<span>Next</span>
            </a>
          </div>
        </div>
        </div>
      </div>

 <!-- Edit Fees Modal -->
 <div id="editFeesModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Enter Partial Amount</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Partial Amount:</label>
                                <input type="number" class="form-control"required>
                            </div>
                            <div class="form-group">
                               <label for="paymentImage">Upload Promisorry image:</label>
                               <input type="file" class="form-control-file" id="paymentImage" name="paymentImage">
                           </div>
                        </div>
                    </div>
                </div>

<div class="modal-footer">
  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"> 
  <input type="submit" class="btn btn-success" value="Submit">
</div>
			</form>
			  </div>
	</div>
</div>



    </body>
</html>


<script>
  const checkAll = document.getElementById('checkAll');
  const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
  checkAll.addEventListener('click', function() {
    for (let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = this.checked;
    }
  });
</script>
<script>
		$(document).ready(function(){
			$('#checkAll').click(function(){
				$('input[type="checkbox"]').prop('checked', this.checked);
			});
		});
	</script>
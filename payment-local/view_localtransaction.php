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
    <link rel="stylesheet" href="../css/payments.css" />
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
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Payments</a>
                <i class="fa fa-caret-down" style = "margin-left:70px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../payment/universitypayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <a href="../payment-local/localpayment.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">Local Payment</a>
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
                    <a href="../admin-settings-user/univer-fee.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">University Fee</a>
                    <a href="../admin-settings-user/local-fee.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fees</a>
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
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Payment Status</h2>
        </div>
    </nav>
<div class="container">
<div class="table-responsive">
          <!-- content here -->
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d" style="font-size: 35px; font-weight: bold;">sl202201111</h1>
        <a href="../payment-local/localpayment.php" class="arrow-icon" ><i class="fas fa-arrow-left"></i></a>  
        </div>
    </div>
    <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Name:</span>
                            <span class="text-600 text-110 text-black align-middle">Gregory Roblox</span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                Local Fee Payment
                            </div>
                            <div class="my-1">
                               Status: Enrolled
                         </div>
                            <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">Name:</span>
                            <span class="text-sm text-grey text-black align-middle">Bachelor Of Science in Computer Science</span>
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">College:</span>
                            <span class="text-sm text-grey text-black align-middle">College of Computing Studies</span>
                         </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                        <img src="../images/ccs.jpg" width ="100" alt="CCS COLLECTION FEE" style="margin-top: 15px; padding-bottom: 10px;">
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="table-responsive" id="yati">
                <table class="table table-bordered">
                <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" >#</th>
                <th scope="col">Description</th>
                <th scope="col">School Year</th>
                <th scope="col">Semester</th>
                <th scope="col" style = " text-align:center; " >Status</th>
                <th scope="col" style = " text-align:center;">Unpaid Balance</th>
                <th scope="col" style = " text-align:center; " >Quantity</th>
                <th scope="col" style = "text-align:center ;" >Unit Price</th>
                <th scope="col" style = " text-align:center;" >Amount</th>                
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> 1</td>
                <td> Bahay Kubo</td>
                <td> 2021-2022</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:center"> Unpaid</td>
                <td style="text-align:right">₱ 30</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:right">₱ 30</td>
                <td style="text-align:right">₱ 30</td>
      <tr>
                <td> 2</td>
                <td> Gardening</td>
                <td> 2021-2022</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:center"> Unpaid</td>
                <td style="text-align:right">₱ 100</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:right">₱ 100</td>
                <td style="text-align:right">₱ 100</td>
      </tr>
      <tr>
                <td> 3</td>
                <td> Aircon</td>
                <td> 2021-2022</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:center"> Unpaid</td>
                <td style="text-align:right">₱ 150</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:right">₱ 150</td>
                <td style="text-align:right">₱ 150</td>
                </tr>
    </tbody>
  </table>
</div>
<div class="d-flex">
          <div class="ml-auto p-auto">
            <a href="../payment-local/localpayment.php" class="btn btn-success" id="backstreet" style="border-radius: 40px; padding: 10 10 10 10;"> <span>Pay Balance Now</span></a>

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
<script src="script.js"></script>
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

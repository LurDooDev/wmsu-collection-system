<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])){
    header('location: ../public/logout.php');
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
    <link rel="stylesheet" href="../css/dashboard.css"/>
    <link rel="stylesheet" href="../css/report.css" />
    <link rel="icon" type="image/jpg" href="../images/usc.png"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
                <!-- <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
                <i class="fa fa-caret-down" style="margin-left: 115px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                    <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
                </div> -->
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="">
                <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
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
            <h2 class="fs-2 m-0">Receipt</h2>
        </div>
    </nav>
    <div class="container">
  <div class="row">
    <div class="receipt">
      <div class="receipt-header">
        <h5>Date: 08/25/2022</h5>
        <h5>Receipt Number: 696969</h5>
      </div>
      <table class="table" id="receiptTable">
        <thead>
          <tr>
            <th>Item Number</th>
            <th>Description</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>CSS Fest</td>
            <td>PHP 100.00</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Palaro</td>
            <td>PHP 300.00</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Bahay Kubo</td>
            <td>PHP 500.00</td>
        </tr>
          <tr>
            <td>4</td>
            <td>Others</td>
            <td>PHP 500.00</td>
          </tr>
          <tr>
            <td></td>
            <th>Total:</th>
            <td>PHP 1400.00</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="d-flex">
      <div class="mr-auto p-auto mr-6">
        <a href="report.php" class="btn btn-danger" style="border-radius:18px;"><span>Back To Report</span></a>
      </div>
      <div class="ml-auto p-auto ml-6" id="invoice">
        <button class="btn btn-success" style="border-radius:18px;" onclick="printTable()">Download Receipt</button>
      </div>
    </div>
  </div>
</div>

<script>
  function printTable() {
    const table = document.getElementById("receiptTable");
    const tableHTML = table.outerHTML;
    const printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<html><head><title>Receipt Table</title>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(tableHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  }

  document.getElementById("downloadPdf").addEventListener("click", function () {
    const element = document.getElementById("invoice");
    html2pdf().from(element).save();
  });
</script>

<!-- 
<script>
  document.getElementById("downloadPdf").addEventListener("click", function () {
    const element = document.getElementById("invoice");
    html2pdf().from(element).save();
  });
</script> -->

      </div>

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

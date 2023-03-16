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
    <link rel="stylesheet" href="../css/payment.css" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css"/>
    <link rel="stylesheet" href="../css/report.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/4caf6a2b18.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/4caf6a2b18.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Wmsu Collection System</title>
    </head>
      <body>
      <div class="d-flex" id="wrapper">
        <!-- Sidebar with bootstrap -->
        <div class="bg-white" id="sidebar-wrapper">
            <img src="../images/logo.jpg" width ="200" alt="CCS COLLECTION FEE">
			<div class="list-group list-group-flush my-3">
                <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <a href="../funds/funds-sub.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Funds</a>
                <a href="../financial-report-admin/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Admin Settings</a>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
            </div>
        </div>
	
<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
<nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
    <div class="mx-auto">
            <h3 style = "font-size:30px;">University Student Council</h3>
        </div>
</div>
</nav>
<div class="container">
    <div class="row">
<div class ="table-responsive">
                <table class="table">
                <div class="col-xs-3 col-sm-3 col-md-3 text-left ml-auto">
                    <p>
                        <h5>Date: 08/25/2022</h5>
                    </p>
</div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-left">
                    <p>
                        <h5>Receipt Number:696969</h5>
                    </p>
                </div>
            </div>
</div>
            <thead>
              <tr>
                <th scope="col" style = " color: #000000;" >Item Number</th></th>
                <th scope="col" style = " color: #000000;" >Description</th>
                <th scope="col" style = " color: #000000;" >Amount</th>
              </tr>
            </thead>
<tbody>
<tr>
						<td>1</td>
						<td>Bahay Kubo</td>
                        <td>PHP 100.00</td>
					</tr>	
                    <td>2</td>
						<td>Palaro</td>
                        <td>PHP 200.00</td>
					</tr>	
                    <td>3</td>
						<td>Others</td>
                        <td>PHP 500.00</td>
					</tr>	
                    <td></td>
                    <th style = " color: #000000;" >Total:</th>
                    <td></td>
                    </tbody>
			</table>
</body>
      <div class="d-flex">
                <div class="ml-auto p-auto mr-3">
                <a href="report.php" class="btn btn-danger" style="padding:15px; background-color:#AD2020; margin-bottom:12px"><span>Back to CCS Generated Report </span></a>
					</div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var el = document.getElementById("wrapper");
                var toggleButton = document.getElementById("menu-toggle");
        
                toggleButton.onclick = function () {
                    el.classList.toggle("toggled");
                };
            </script>


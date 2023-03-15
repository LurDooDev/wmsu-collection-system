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
<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <h2 class="fs-2 m-0">CCS Generated Report</h2>
        </div>
    </nav>
    <div class="d-flex">
                <div class="ml-auto p-auto mr-3">
                <a href="financial-report.php" class="btn btn-success" style="padding:15px; margin-bottom:12px"><span>Back To Financial Report </span></a>
					</div>
				</div>
    <div class =" table-responsive">
                <table class="table">
            <thead>
              <tr>
                <th scope="col" style = " color: #000000;" >Types of Expenses</th></th>
                <th scope="col" style = " color: #000000;" >Total</th>
              </tr>
            </thead>
            <tbody>
            <tr>
						<td>CCS Fest</td>
						<td>PHP 100.00</td>
					</tr>	
                    <tr>
						<td>Palaro</td>
						<td>PHP 300.00</td>
					</tr>	
                    <tr>
						<td>Others</td>
						<td>PHP 400.00</td>
					</tr>	
                    <tr>
                    <td></td>
                    <td></td>
</tr>
<thead>
              <tr>
                <th></th></th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <tr>
						<td>Current Assets</td>
                        <td>PHP 500.00</td>
                        </tr>
                        <tr>
                    <td></td>
                    <td></td>
</tr>
<thead>
              <tr>
                <th></th></th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <tr>
						<td>Remaining Assets</td>
                        <td>PHP 500.00</td>
                        </tr>
                        <tr>
                    <td></td>
                    <td></td>
</tr>
</body> 


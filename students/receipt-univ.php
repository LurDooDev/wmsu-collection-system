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
  <script src="https://kit.fontawesome.com/6023332cf2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/paymentlocal.css" />
    </head>
      <body>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
    </nav>
<div class="container" id="myidol">
<div class="table-responsive">
          <!-- content here -->
    <div class="page-header text-blue-d1" style="justify-content: center;">
        <h1 class="page-title text-secondary-d" style="font-size: 35px; font-weight: 550;  margin-top: 10px;">College Of Computing Studies</h1>
    </div>
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
                            <span class="text-sm text-grey-m2 align-middle">Year Level:</span>
                            <span class="text-sm text-grey text-black align-middle">3rd Year</span>
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
                <div class="table-responsive" id="yati">
                <table style="width: 100%; border: 2px solid black; border-collapse: collapse;">
  <thead style="color: grey; background-color: black;">
    <tr>
      <th style="text-align: center; padding: 5px; border-right: 2px solid white;">No.</th>
      <th style="text-align: center; padding: 5px; border-right: 2px solid white;">Description</th>
      <th style="text-align: center; padding: 5px; border-right: 2px solid white;">Date</th>
      <th style="text-align: center; padding: 5px;">Amount</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">1</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">CSB Fee</td>
      <td style="text-align: center; padding: 5px; border-right: 1px solid black;">10-02-222</td>
      <td style="text-align: center; padding: 5px;">₱ 200</td>
    </tr>
  </tbody>
</table>

<br>
<br>
<div class="row">
  <div class="col-sm-6">
    <div>
      <span class="text-sm text-110 text-black align-middle">Payment Method:</span>
      <span class="text-600 text-110 text-black align-middle">Cash</span>
    </div>
    <br>
    <span class="text-sm text-110 text-black align-middle">Collected By:</span>
    <span class="text-600 text-110 text-black align-middle">Eljen Mae Augusto</span>
  </div>
  <div class="col-sm-6 d-flex flex-column align-items-end align-content-stretch" style="flex: 0 0 48%;">
    <div class="d-flex justify-content-end align-items-center">
      <a class="btn bg-white btn-light mx-1px text-95" style="border: 1px solid black;" href="#" data-title="Edit">
        <i class="ml-auto fa-solid fa-pen-to-square text-primary-m1 text-120 w-2"></i> Edit
      </a>
      <a class="btn bg-white btn-light mx-1px text-95" style="border: 1px solid black;" href="#" data-title="Print">
        <i class="ml-auto fa fa-print text-primary-m1 text-120 w-2"></i> Print
      </a>
    </div>
  </div>
</div>
</body>       

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </head>
      <body>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
    </nav>
<div class="container" id="kent">
<div class="table-responsive">
          <!-- content here -->
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d" style="font-size: 35px; font-weight: bold;">201503664</h1>
        <a href="students.php" class="arrow-icon" ><i class="fas fa-arrow-left"></i></a>  
        </div>
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
                        <div class="text-grey-m2">
                            <div class="my-1" >
                            <span class="">Type of Payment:</span>
                            <span class="">University</span>
                            </div>
                            <div class="my-1">
                               Status: Enrolled
                         </div>
                         <div class="my-1">
                            <span class="text-sm text-grey-m2 align-middle">College: </span>
                            <span class="text-sm text-grey text-black align-middle ">College of Computing Studies</span>
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
                <table class="table">
                <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " text-align:center; ">Description</th>
                <th scope="col" style = " text-align:center; ">Date</th>
                <th scope="col" style = " text-align:center; ">School Year</th>
                <th scope="col" style = " text-align:center; " >Semester</th>
                <th scope="col" style = " text-align:center; " >Status</th>
                <th scope="col" style = " text-align:center;" >Total Payment</th>        
                <th scope="col" style = " text-align:center;" >Paid</th>      
                <th scope="col" style = " text-align:center;" >Details</th>         
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align:center">University Fees</td>
                <td style="text-align:center">11/2/2022</td>
                <td style="text-align:center"> 2021-2022</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:center; color: red;"> Unpaid</td>
                <td style="text-align:center">₱ 200</td>
                <td style="text-align:center">PHP 0.00</td>
                <td style="text-align:center"><button  class="view btn btn-outiline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#paymentdetails"><i class="material-icons" ></i></button></td>
              </tr>
              <tr>
                <td style="text-align:center"> Local Fees</td>
                <td style="text-align:center">11/2/2022</td>
                <td style="text-align:center"> 2021-2022</td>
                <td style="text-align:center"> 1</td>
                <td style="text-align:center; color: red;"> Paid</td>
                <td style="text-align:center">₱ 200</td>
                <td style="text-align:center">PHP 200.00</td>
                <td style="text-align:center"> <a href="#receipt" class="view-schedules" data-toggle="modal">
                    <i class="material-icons" data-toggle="tooltip" title="View Receipt">receipt</i>
                </a>
        </td>
              </tr>
    
    </tbody>
  </table>
  </div>
<div class="modal fade modal-fullscreen" id="paymentdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">College of Computing Studies(CCS)</h5>
        <div>
        <a data-toggle="modal" href="#AddCSV" class="btn btn-primary">Add CSV</a>
</div>
</div>
        <div class="modal-body">
      <table class="table table-striped">
            <thead style="background-color:#95BDFE ;" class="text-white">
            <tr>
                <th scope="col" style = " color: #000000;" >Student ID</th>
                <th scope="col" style = " color: #000000;" >Student Name</th>
                <th scope="col" style = " color: #000000;" >Student Email</th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2020-1311</td>
                <td>Joy Cubile</td>
                <td>xt202001311@wmsu.edu.ph</td>
              </tr>

              <tr>
                <td>2020-1294</td>
                <td>John Kent Tingkasan</td>
                <td>xt202001311@wmsu.edu.ph</td>
              </tr>
  </tbody>
</table>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>       


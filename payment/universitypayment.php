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
                <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Payments</a>
                <i class="fa fa-caret-down" style = "margin-left:18px;"></i>
                </button>                
                <div class="dropdown-container">
                    <a href="" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">University Payment</a>
                    <a href="" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Local Payment</a>
                </div>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Admin Settings</a>
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
		<div class="row justify-content-center">
			<div class="justify-content-center">
				<div class="">
					<form id="form">
						<ul id="progressbar">
							<li class="active" id="step1">
								<strong>Search User</strong>
							</li>
							<li id="step2"><strong>Balance</strong></li>
							<li id="step3"><strong>Payment Details</strong></li>
							<li id="step4"><strong>Transaction Complete</strong></li>
						</ul>
						<div class="">
							
						</div> <br>
						
						<!-- <div class ="row justify-content-center"> -->
						<fieldset>
            <div class="row mt-5" id="idolo">
						<div class="col-md-8 mx-auto">
           				 <div class="input-group">
                		<input class="form-control" type="search" id="example-search-input" placeholder ="Search Name or ID">
                		<span class="input-group-append">
                   		 <button class="btn btn-outline-secondary bg-white ms-n5" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="table-responsive" id="bilat">
        <div class="row my-2 mx-1 justify-content-center" style="display: block;">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >Id</th>
                <th scope="col" style = " color: #000000;" >Name</th>
                <th scope="col" style = " color: #000000;" >ID Number</th>
                <th scope="col" style = " color: #000000;" >Colleges</th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Gregory Roblox</td>
                <td>sl202203664</td>
                <td>College of Computing Studies</td>
                <td>
            <a href="" class="edit">
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
						</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Joy Batumbakal</td>
                <td>sl202203212</td>
                <td>College of Nursing</td>
                <td>
            <a href="" class="edit">
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
						</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Jose Rizal</td>
                <td>sl202234242</td>
                <td>College of Architecture</td>
                <td>
            <a href="" class="edit">
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
						</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Vladimir Romblon</td>
                <td>sl202202541</td>
                <td>College of Law</td>
                <td>
            <a href="" class="edit">
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
						</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Jonathan Dunkit</td>
                <td>sl202207543</td>
                <td>College of Engineering</td>
                <td>
            <a href="" class="edit">
                <i class="material-icons" title="Edit">&#xe147;</i>
            </a>
						</td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
    </div>
<div>
<div class="d-flex">
          <div class="ml-auto p-auto">
            <a href="universityfees.php" class="btn btn-success" id="backstreet"> <span>Next Step</span></a>

</div>
</fieldset>
  
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
    $(document).ready(function () {
	var currentGfgStep, nextGfgStep, previousGfgStep;
	var opacity;
	var current = 1;
	var steps = $("fieldset").length;

	setProgressBar(current);

	$(".next-step").click(function () {

		currentGfgStep = $(this).parent();
		nextGfgStep = $(this).parent().next();

		$("#progressbar li").eq($("fieldset")
			.index(nextGfgStep)).addClass("active");

		nextGfgStep.show();
		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				nextGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		setProgressBar(++current);
	});

	$(".new-payment").click(function () {

		currentGfgStep = $(this).parent();
		newpaymentGfgStep = $(this).parent().new();

		$("#progressbar li").eq($("fieldset")
			.index(currentGfgStep)).removeClass("active");

      newpaymentGfgStep.show();

		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				newpaymentGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		setProgressBar(--current);
	});

	function setProgressBar(currentStep) {
		var percent = parseFloat(100 / steps) * current;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width", percent + "%")
	}

	$(".submit").click(function () {
		return false;
	})
});
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

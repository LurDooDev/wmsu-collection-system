<?php
// resume session here to fetch session values
session_start();

//prevent horny people
if (!isset($_SESSION['logged_id'])) {
  header('location: ../admin/dashboard-user.php');
} else if ($_SESSION['role'] != 'officer' && $_SESSION['role'] != 'admin') {
  header('location: dashboard-user.php');
}


require_once '../classes/database.class.php';
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
	<link rel="icon" type="image/jpg" href="../images/usc.png"/>
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/dashyboard.css" />
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
              <?php
              if($_SESSION['role'] == 'officer'){?>
                <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Dashboard</a>
                <?php } ?>
                
                <!-- <a href="../fees-user/fees-user.php" class="list-group-item list-group-item-action bg-hover first-text  fw-bold ">Fees</a> -->
                <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
                <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
                <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
                <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <!-- <a href="../csc-management/csc-management.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">CSC Management</a> -->
                <?php
                if($_SESSION['role'] == 'officer'){?>
                <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings
                <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
                </button>
                <div class="dropdown-container">
                <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
                    <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                    <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold"  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                    <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                </div>            
                <?php } ?>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Logout</a>
            </div>
        </div>
		<div class="table-responsive">
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Dashboard</h2>
        </div>
    </nav>
    
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Collected</div>
            <div class="number"> ₱ 40,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">First Semester</span>
            </div>
          </div>
   
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Collected</div>
            <div class="number"> ₱38,876</div>
            <div class="indicator">
              <span class="text">CCS Fee</span>
            </div>
          </div>
       
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Collected</div>
            <div class="number"> ₱ 12,876</div>
            <div class="indicator">
              <span class="text">CSC Fee</span>
            </div>
          </div>
       
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">CSC Projects</div>
            <div class="number"> ₱ 11,086</div>
            <div class="indicator">
              <span class="text">70% of the total collected</span>
            </div>
          </div>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Collection</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Date</li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
              <li><a href="#">02 Jan 2021</a></li>
            </ul>
            <ul class="details">
            <li class="topic">Student</li>
            <li><a href="#">Alex Doe</a></li>
            <li><a href="#">David Mart</a></li>
            <li><a href="#">Roe Parter</a></li>
            <li><a href="#">Diana Penty</a></li>
            <li><a href="#">Martin Paw</a></li>
            <li><a href="#">Doe Alex</a></li>
            <li><a href="#">Aiana Lexa</a></li>
            <li><a href="#">Rexel Mags</a></li>
             <li><a href="#">Tiana Loths</a></li>
          </ul>
          <ul class="details">
            <li class="topic">Status</li>
            <li><a href="#">PAID</a></li>
            <li><a href="#">PAID</a></li>
            <li><a href="#">Returned</a></li>
            <li><a href="#">PAID</a></li>
            <li><a href="#">PAID</a></li>
            <li><a href="#">Returned</a></li>
            <li><a href="#">PAID</a></li>
             <li><a href="#">PAID</a></li>
            <li><a href="#">PAID</a></li>
          </ul>
          <ul class="details">
            <li class="topic">CSC Fee</li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
            <li><a href="#">200</a></li>
             <li><a href="#">200</a></li>
             <li><a href="#">200</a></li>
          </ul>
          </div>
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Recent CSC Projects</div>
          <ul class="top-sales-details">
            <li>
            <a href="#">
              <!--<img src="images/sunglasses.jpg" alt="">-->
              <span class="product">Socialization</span>
            </a>
            <span class="price">600</span>
          </li>
          <li>
            <a href="#">
               <!--<img src="images/jeans.jpg" alt="">-->
              <span class="product">CSC Gardening</span>
            </a>
            <span class="price">50</span>
          </li>
          <li>
            <a href="#">
             <!-- <img src="images/nike.jpg" alt="">-->
              <span class="product">CSC FEST</span>
            </a>
            <span class="price">200</span>
          </li>
          <li>
            <a href="#">
              <!--<img src="images/scarves.jpg" alt="">-->
              <span class="product">Others</span>
            </a>
            <span class="price">*****</span>
          </li>
          <li>
            <a href="#">
              <!--<img src="images/blueBag.jpg" alt="">-->
              <span class="product">Others</span>
            </a>
            <span class="price">*****</span>
          </li>
          <li>
            <a href="#">
              <!--<img src="images/bag.jpg" alt="">-->
              <span class="product">Others</span>
            </a>
            <span class="price">*****</span>
          <li>
            <a href="#">
              <!--<img src="images/addidas.jpg" alt="">-->
              <span class="product">Others</span>
            </a>
            <span class="price">*****</span>
          </li>
          </ul>
        </div>
      </div>
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

        </body>       

<?php
  // resume session here to fetch session values
  session_start();
  require_once '../functions/session.function.php';
  
  if (!isset($_SESSION['logged_id'])) {
    header('location: ../admin/dashboard-user.php');
} else if ($_SESSION['role'] != 'officer' && $_SESSION['role'] != 'admin') {
    header('location: dashboard-user.php');
}


require_once '../classes/users.class.php';
require_once '../classes/college.class.php';
require_once '../classes/role.class.php';


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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/new-user.css" />
    <link rel="icon" type="image/jpg" href="../images/usc.png"/>
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
            
            if($_SESSION['role'] == 'admin'){?>
              <a href="../admin/dashboard-main.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
              <?php } ?>
              <?php
            if($_SESSION['role'] == 'officer'){?>
              <a href="../admin/dashboard-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
              <?php } ?>
              <!-- <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a> -->
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
              <?php } ?>
              <?php
              if($_SESSION['role'] == 'officer'){?>
              <a href="../payment/universitypayment_search.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Payments</a>
              <?php } ?>
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
              <?php } ?>
              <?php
            if($_SESSION['role'] == 'officer'){?>
              <a href="../payment-records/payment-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Payment Records</a>
              <?php } ?>
              
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Funds</a>
              <?php } ?>
              <?php
            if($_SESSION['role'] == 'officer'){?>
              <a href="../students/students.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold  ">Students</a>
              <?php } ?>
              
              </button> 
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <div class="dropdown-container">
                  <a href="../funds/overview_funds.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a>
                  <a href="../funds/collected-fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Collected Fees</a>
              </div>
              <?php } ?>
              <?php
            if($_SESSION['role'] == 'officer'){?>
              <a href="../financial-report-user/financial-report-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
              <?php } ?>
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
              <?php } ?>
              <?php
              if($_SESSION['role'] == 'officer'){?>
              <a href="../audit-log-user/audit-log-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
              <?php } ?>
              <?php
              if($_SESSION['role'] == 'admin'){?>
              <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
              <?php } ?>
              <div class="dropdown-container">
              
              <button class="list-group-item list-group-item-action bg-hover second-text dropdown-btn fw-bold">Admin Settings</a>
              
              
              <i class="fa fa-caret-down" style="margin-left: 37px;"></i>
              
              </button>
              
              <?php
                  if($_SESSION['role'] == 'admin'){?>
              <a href="../admin-settings/overview_settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
              <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                  <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold "  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
              <?php }?>
              <?php
            if($_SESSION['role'] == 'officer'){?>
              <a href="../admin-settings-user/admin-settings-user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Overview</a></ul>
              <a href="../university/university.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold " style="text-decoration:none; padding-left: 70px;">University Fee</a></ul>
                  <a href="../local/localfees.php"class="list-group-item list-group-item-action bg-hover first-text fw-bold "  style="text-decoration:none; padding-left: 70px;">Local Fee</a></ul>
                  <?php }?>
              <?php
              if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'officer'){?>
                  <a href="../admin-settings/user.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active" style="text-decoration:none; padding-left: 70px;">User Management</a></ul>
                  <?php } ?>
                  
                   
                    <!-- <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold" style="text-decoration:none; padding-left: 70px;">Colleges</a></ul> -->
                </div>
              
              <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
</div>
        </div>
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">User Management</h2>
        </div>
    </nav>
    <div class="container">
                <div class="row" style="padding-top:  21px;">
				<div class="col-sm-4" style="border-color: #000000;">
        			
       			 </div>
					<div class="col-sm-8 " style="display: flex; align-items: center; justify-content: flex-end;">
						<a href="#addCollectorModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add User</span></a>
					</div>
				</div>
             <div class =" table-responsive" style="margin-top: 10px;">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >ID</th>
                <th scope="col" style = " color: #000000;" >Name</th>
				<th scope="col" style = " color: #000000; ">College</th></th>
                <th scope="col" style = " color: #000000;" >Role</th></th>
				<th scope="col" style = " color: #000000;" >Position</th></th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
			$users = new Users();
			$userData = $users->showAllDetails();
    $i = 1;
    foreach($userData as $users) {      
?>
            <tr>
			<td><?php echo $i; ?></td>
                <td><?php echo $users['user_fullname']; ?></td>
                <td><?php echo $users['college_code']; ?></td>
				<td><?php echo $users['role_name']; ?></td>
                <td><?php echo $users['user_position']; ?></td>
                <td>
                <!-- <a href="#editFeesModal" class="edit" data-toggle="modal">
										<i class="material-symbols-outlined" title="Edit">edit</i>
									</a> -->
                    <a href="#deleteFeesModal<?php echo $i; ?>" class="delete" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </td>
            </tr>
            <!-- Delete Fees Modal -->
            <div id="deleteFeesModal<?php echo $i; ?>" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="deleteuser.php" method="POST">
                            <div class="modal-header">						
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Fees</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                            </div>
                            <div class="modal-body">					
                                <p>Are you sure you want to delete this record?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="user_id" value="<?php echo $users['id']; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Fees Modal
            <div id="editFeesModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
        <div class="modal-body">
  <div class="row">
    <div class="col-md-6">
    <div class="modal-body">					
      <div class="form-group">
        <label>Role</label>
        <select class="form-control" >
          <option value="" disabled selected>Admin</option>
          <option value="Manager">Admin</option>
          <option value="Supervisor">Officer</option>
          <option value="Coordinator">Collector</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Position</label>
        <select class="form-control" >
          <option value="" selected>President</option>
          <option value="Manager">Vice-President</option>
          <option value="Supervisor">Secretary</option>
          <option value="Staff">Mayor</option>
          <option value="Staff">Vice-Mayor</option>
          <option value="Staff">Assistant</option>
        </select>
      </div>
    </div>
  </div>
</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Save">
				</div>
			</form>
		</div>
	</div>
</div> -->
<?php 
            $i++;
        }
?>


<!-- Add Modal HTML -->

<div id="addCollectorModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="adduser.php" method="POST">
				<div class="modal-header">
					
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
        <div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
      <label for="userfullname">Name</label>
      <input type="text" name="userfullname" id="userfullname" class="form-control" required aria-describedby="name-help">
      <div class="error"></div>
     <div id="name-help" class="form-text">Enter the name of the user.</div>
    </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" required aria-describedby="username-description">
        <small id="username-description" class="form-text text-muted">Enter the username of the user.</small>
      </div>
      <div class="form-group">
        <label for="userpassword">Password</label>
        <input type="password" name="userpassword" id="userpassword" class="form-control" required aria-describedby="userpassword-description">
        <small id="userpassword-description" class="form-text text-muted">Enter the password of the user.</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="college" class="form-label">Colleges</label>
        <select class="form-control" id="college" name="college" required aria-describedby="college-help">
          <option value="">Select your option</option>
          <?php
            $college = new College ();
            $collegeData = $college->show();
            foreach ($collegeData as $college) {
          ?>
            <option value="<?php echo $college['id']; ?>"><?php echo $college['college_name']; ?></option>
          <?php }?>
        </select>
      </div>
      <div class="form-group">
        <label for="role" class="form-label">Roles</label>
        <select class="form-control" id="role" name="role" required>
          <option value="">Select your option</option>
          <?php
            $role = new Role ();
            $roleData = $role->show();
            foreach ($roleData as $role) {
          ?>
            <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
          <?php }?>
        </select>
      </div>
      <div class="form-group">
        <label for="userposition">Position</label>
        <select name="userposition" id="userposition" class="form-control" required>
          <option value="" disabled selected>Select your option</option>
          <option value="President">President</option>
          <option value="Vice-President">Vice-President</option>
          <option value="Secretary">Secretary</option>
          <option value="Mayor">Mayor</option>
          <option value="Vice-Mayor">Vice-Mayor</option>
          <option value="Assistant">Assistant</option>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
  <input type="hidden" name="action" value="add">
  <input type="submit" class="btn btn-success" value="Add" onclick="return validateForm()">
</div>

<script>
var existingUsernames = [];

function showNotification(message) {
  var notification = document.createElement("div");
  notification.innerHTML = message;
  notification.style.position = "fixed";
  notification.style.top = "10px";
  notification.style.right = "10px";
  notification.style.backgroundColor = "#f44336";
  notification.style.color = "#fff";
  notification.style.padding = "12px";
  notification.style.borderRadius = "4px";
  notification.style.boxShadow = "0 2px 6px rgba(0, 0, 0, 0.3)";
  notification.style.zIndex = "9999";
  notification.style.fontSize = "16px";
  notification.style.fontWeight = "bold";
  document.body.appendChild(notification);
  
  // Fade out and remove the notification after 5 seconds
  setTimeout(function() {
    notification.style.opacity = "0";
    setTimeout(function() {
      notification.parentNode.removeChild(notification);
    }, 1000);
  }, 5000);
}


function validateForm() {
  // Get the input fields
  var userfullname = document.getElementById("userfullname");
  var username = document.getElementById("username");
  var userpassword = document.getElementById("userpassword");
  var college = document.getElementById("college");
  var role = document.getElementById("role");
  var userposition = document.getElementById("userposition");

  // Initialize the errors array
  var errors = [];  
  
  // Validate the fields
  if (userfullname.value == "") {
    showNotification("Please enter your name.");
    userfullname.focus();
    return false;
  } 
  
else if (userfullname.value.length < 3) {
    showNotification("Name must be at least 3 characters");
    userfullname.focus();
    return false;
  }

  else if (userfullname.value.length > 50) {
    showNotification("Name must not exceed 50 characters.");
    userfullname.focus();
    return false;
  }
  
  if (!/^[^0-9]+$/.test(userfullname.value)) {
    showNotification("Name must not contain numeric values.");
    userfullname.focus();
    return false;
  }

  if (username.value == "") {
    showNotification("Please enter a username.");
    username.focus();
    return false;
  }
  
  else if (username.value.length > 50) {
    showNotification("User Name must not exceed 50 characters.");
    username.focus();
    return false;
  }

  if (existingUsernames.includes(username.value)) {
    showNotification("This username already exists. Please choose a different one.");
    username.focus();
    return false;
  }

  if (username.value.length < 2) {
    showNotification("User Name must be at least 2 characters");
    username.focus();
    return false;
  }

  if (userpassword.value == "") {
    showNotification("Please enter a password.");
    userpassword.focus();
    return false;
  }

  if (userpassword.value.length > 25) {
    showNotification("User Password exceeded the maximum length.");
    userpassword.focus();
    return false;
  }

  if (userpassword.value.length < 8) {
    showNotification("Password must be at least 8 characters long.");
    userpassword.focus();
    return false;
  }


  if (college.value == "") {
    showNotification("Please select a college.");
    college.focus();
    return false;
  }

  if (role.value == "") {
    showNotification("Please select a role.");
    role.focus();
    return false;
  }

  if (userposition.value == "") {
    showNotification("Please select a position.");
    userposition.focus();
    return false;
  }

  // If all fields are valid, add username to existingUsernames array and submit the form
  existingUsernames.push(username.value);
  window.location.href = "../admin-settings/user.php";
  return true;
}
</script>


			</form>
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

<script>

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var listgroup = document.getElementsByClassName("list-group-item")
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
</html>

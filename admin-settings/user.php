<?php


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
    <link rel="stylesheet" href="../css/payment.css" />
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dashboard.css" />
    <link rel="stylesheet" href="../css/user-management.css" />
    <link rel="stylesheet" href="../css/admin-settings.css" />
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
                <a href="../admin/dashboard.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Dashboard</a>
                <a href="../fees/fees.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Fees</a>
                <a href="../remit-records/remit-records.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Remit Records</a>
                <a href="../college/college.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Colleges</a>
                <a href="../funds/funds-sub.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold ">Funds</a>
                <a href="../financial-report/financial-report.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Financial Report</a>
                <a href="../audit-log/audit-log.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold">Audit Log</a>
                <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold active">Admin Settings</a>
                <a href="../public/logout.php" class="list-group-item list-group-item-action bg-hover fw-bold">Logout</a>
            </div>
        </div>
	<div id="page-content-wrapper">
<!-- Dashboard hamburger      -->
    <nav class="navbar navbar-expand-lg navbar-light bg-active py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0" style="color:#000000; font-weight: 400;">Admin Settings</h2>
        </div>
    </nav>
    <div class="container">
		<div class="row justify-content-center">
		<div class="graphBox">
                    <a href="../admin-settings/admin-settings.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold "style="border:inset;" id="funds">Overview</a>
                    <a href="../admin-settings/User-management.php" class="list-group-item list-group-item-action bg-hover first-text active "style="border:inset;" id="funds">User Management</a>
                    <a href="../admin-settings/Colleges.php" class="list-group-item list-group-item-action bg-hover first-text fw-bold fw-bold " style="border:inset;"id="funds">Colleges</a>
				</div>
                </div>
                <div class="row">
				<div class="col-sm-4" style="border-color: #000000;">
        			<input class="form-control border" type="search" name= "search" id="search-input" placeholder="Search Name">
       			 </div>
					<div class="col-sm-8 " style="display: flex; align-items: center; justify-content: flex-end;">
						<a href="#addCollectorModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add User</span></a>
					</div>
				</div>
             <div class =" table-responsive">
                <table class="table">
            <thead style="background-color:#95BDFE ;" class="text-white">
              <tr>
                <th scope="col" style = " color: #000000;" >ID</th>
                <th scope="col" style = " color: #000000;" >Name</th>
				<th scope="col" style = " color: #000000;" >College</th></th>
				<th scope="col" style = " color: #000000;" >Position</th></th>
                <th scope="col" style = " color: #000000;" >Email</th></th>
                <th scope="col" style = " color: #000000;" >Role</th></th>
                <th scope="col" style = " color: #000000;" >Action</th>
              </tr>
            </thead>
            <tbody>
			<?php
			$users = new Users();
			$userData = $users->show();
    $i = 1;
    foreach($userData as $users) {      
?>
            <tr>
			<td><?php echo $i; ?></td>
                <td><?php echo $users['user_fullname']; ?></td>
				<td><?php echo $users['college_name']; ?></td>
                <td><?php echo $users['college_code']; ?></td>
				<td><?php echo $users['user_email']; ?></td>
                <td><?php echo $users['user_type']; ?></td>
                <td>
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
                                <input type="hidden" name="user_id" value="<?php echo $users['user_id']; ?>">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php 
            $i++;
        }
?>
				</tbody>
			</table>
		</div>
	</div>        
</div>
</div>  
<!-- Add Modal HTML -->
<div id="addCollectorModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="adduser.php" method="POST">
				<div class="modal-header">						
					<h4 class="modal-title">Add Collector</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
                <div class="form-group">
						<label for="userfullname">Name</label>
						<input type="text" name="userfullname" id="userfullname" class="form-control" required>
					</div>
                <div class="form-group">
		  <label for="college" class="form-label">Colleges</label>
            <select class="form-control" id="college" name="college" required>
				
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
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="userpassword">Password</label>
						<input type="text" name="userpassword" id="userpassword" class="form-control" required>
					</div>		
						
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="hidden" name="action" value="add">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
					</div>
	</div>
<!-- Edit Modal HTML -->
<div id="editUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Collector</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>College Code</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Mayor</label>
						<input type="text" class="form-control" required>
					</div>		
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
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

</html>

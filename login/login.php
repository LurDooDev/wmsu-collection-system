<?php
session_start();
  require_once '../classes/database.class.php';
  require_once '../classes/users.class.php';

  if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
  
      // Create a new Users object
      $users_obj = new Users();
  
      // Call the log_in function to authenticate the user
      $user_data = $users_obj->log_in($username, $password);
  
      if ($user_data) {
          // Login successful - store user data in session
          $_SESSION['logged_id'] = $user_data['id'];
          $_SESSION['fullname'] = $user_data['user_fullname'];
          $_SESSION['position'] = $user_data['user_position'];
		  $_SESSION['collegeID'] = $user_data['college_id'];
          $_SESSION['college'] = $user_data['college_name'];
          $_SESSION['role'] = $user_data['role_name'];
  
          // Display the appropriate dashboard page for user
          if ($user_data['role_name'] == 'admin') {
              header('location: ../admin/dashboard-main.php');
          } else if ($user_data['role_name'] == 'officer') {
              header('location: ../admin/dashboard-user.php');
          } else if ($user_data['role_name'] == 'collector') {
              header('location: ../collector/collector.php');
          }
      } else {
          // Login failed - set an error message
          $error_msg = 'Invalid username or password';
      }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/jpg" href="../images/usc.png"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="margin-top: -80px;">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-70">
					</span>
					<span class="login100-form-avatar">
						<img src="../images/logo.jpg" alt="logo">
					</span>
					<?php
                    if(isset($error)){
                         echo '<div id="error-message">'.$error.'</div>';
                    	}
                    ?>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
						<input style="color:white" class="button" type="submit" value="Login" name="login" tabindex="3">
						</button>
					</div>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<!--Backend for error time-->
	<script>
  setTimeout(function() {
    $("#error-message").hide();
 	 }, 3000); // 3 seconds
	</script>

	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/animsition/js/animsition.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<script src="../vendor/countdowntime/countdowntime.js"></script>
	<script src="../js/main.js"></script>

</body>
</html>
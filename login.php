
<?php
	require_once '../classes/database.class.php';
	require_once '../classes/login.class.php';
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		//sanitize stripgs remove yung html tags and trim sa whitespace and yung isa self explanatory na beshies
		$username = htmlspecialchars(strip_tags(trim($_POST['username'])));
		$password = htmlspecialchars(strip_tags(trim($_POST['password'])));
	
		$login = new Login($username, $password);
		if($login->checkCredentials()){
			header("location: ../public/homepage.php");
		}
			$errorMessage = "Access denied. Incorrect username or password.";
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form">
				<form class="login-form" action="login.php" method="post">
					<span class="login100-form-title p-b-70">
						WMSU COLLECTION SYSTEM
					</span>
					<span class="login100-form-avatar">
						<img src="images/logo.jpg" alt="logo">
					</span>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" id ="username" name="username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input class="input100" type="password" id="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					<div class="container-login100-form-btn">
						<input class="login100-form-btn " type="submit" value="Login" name="login">
						</input>
					</div>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>



	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
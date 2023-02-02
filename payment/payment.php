<?php
session_start();
//prevent horny people
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
// Redirect the user to the login page if they are not logged in
header('Location: login.php');
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
  $query = trim($_GET['query']);
  if ($query !== '') {
    echo "You searched for: $query";
    $results = performSearch($query);
    if (!empty($results)) {
      // Redirect to another page if results are found
      header("Location: ../paymentfees.php");
      exit;
    } else {
      $errorMessage = "No results found.";
    }
  } else {
    $errorMessage = "Please enter a search query.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php if (isset($errorMessage)): ?>
        				<?= $errorMessage ?>
						<?php unset($errorMessage); ?>
    				<?php endif; ?>
<form action="" method="get">
  <input type="text" name="query" value="<?php echo htmlspecialchars($query ?? ''); ?>">
  <input type="submit" value="Search">
</form>

<a href="../public/logout.php" id='a_logout'> Log Out</a>
    </div>

  
</body>
</html>
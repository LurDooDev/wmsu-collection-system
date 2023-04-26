<?php 
require_once '../classes/database.class.php';
require_once "../classes/college.class.php";

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {

    
    
    // Sanitize input data
    $code = htmlspecialchars($_POST['code']);
    $name = htmlspecialchars($_POST['name']);


    $college = new College();


$error = array();
    
    if (empty($college->collegeCode) || empty($college->collegeName)) {
        $error[] = "Please fill in all the required fields";
    }
    
    if (strlen($college->collegeCode) > 10 || strlen($college->collegeName) > 50  ) {
        $error[] = "Field length exceeds the limit";
    }
}

?>
<?php 
if(empty($error)){
    $users->addcollege();
    header("Location: ../college/new-college.php");
    exit();
}
?>
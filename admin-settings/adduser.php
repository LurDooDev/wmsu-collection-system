<?php 

require_once '../classes/database.class.php';
require_once "../classes/users.class.php";

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    
    $users = new Users();
    $users->username = htmlspecialchars(trim($_POST['username']));
    $users->userfullname = htmlspecialchars($_POST['userfullname']);
    $users->userposition = htmlspecialchars($_POST['userposition']);
    $users->roleID = htmlspecialchars($_POST['role']);
    $users->collegeID = htmlspecialchars($_POST['college']);

    $password = htmlspecialchars($_POST['userpassword']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $users->userpassword = $hashed_password;

    // Validate form fields
    $error = array();
    
    if (empty($users->username) || empty($users->userfullname) || empty($users->userposition) || empty($users->roleID) || empty($users->collegeID) || empty($password)) {
        $error[] = "Please fill in all the required fields";
    }
    
    if (strlen($users->username) > 50 || strlen($users->userfullname) > 100 || strlen($users->userposition) > 50 || strlen($password) > 50) {
        $error[] = "Field length exceeds the limit";
    }
}
?>

<?php 
if(empty($error)){
    $users->addUser();
    header("Location: ../admin-settings/user.php");
    exit();
}
?>


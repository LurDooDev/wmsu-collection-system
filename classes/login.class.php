<?php
require_once "database.class.php";
// session start since gagamitin ko yung mga session ng login. for authorization.


class Login extends Database{
    // Store input
    private $username;
    private $password;

    //sanitize
    function __construct($username, $password){
        $this->username = htmlspecialchars(strip_tags(trim($username)));
        $this->password = htmlspecialchars(strip_tags(trim($password)));
    }

    //method to check for credentials sa database hirap pala maging backend :(
    function checkCredentials(){
        //tawagin si momshie database
        $conn = $this->connect();
        // Prepare a db mysq select data from the wmsu_users where username is equal sa input.
        $stmt = $conn->prepare("SELECT u.*, r.*, c.*, s.* 
        FROM wmsu_users u
        JOIN roles r ON u.role_id = r.role_id 
        JOIN colleges c ON u.college_id = c.college_id 
        JOIN students s ON u.student_id = s.student_id 
        WHERE BINARY u.username = :username");
         // Bind the input value sa statement don sa data kinuha sa db (itagalog ko pagcomment sir baka magalit si jose rizal)
        $stmt->bindParam(':username', $this->username);
        // after binding then lets execute
        if($stmt->execute()){
            //fetch data
            $result = $stmt->fetch();
            //if may nahanap
            if($result){
                //if password equals to password sa db then return true.
                if($this->password == $result['password']){
                session_start();
                $_SESSION['logged-in'] = $result['user_id'];
                    return true;
                }
            }
        }
        return false;
    }
}
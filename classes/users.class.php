<?php

// Include the database class
require_once 'database.class.php';

// Declare the Users class
class Users{

    // Class properties
    public $userID;
    public $username;
    public $userfullname;
    public $userposition;
    public $userroles;
    public $usercollege;
    public $userpassword;
    public $email;

    // protected property to store the database connection
    protected $db;

    // Class constructor to initialize the database connection
    function __construct()
    {
        $this->db = new Database();
    }
    function showByCollege($college) {
        $sql = "SELECT * FROM users WHERE user_college = :college";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':college', $college, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userData;
    }

    function show(){
        $sql = "SELECT * FROM users;";
        
        $query=$this->db->connect()->prepare($sql);
        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function add(){
        $sql = "INSERT INTO users(user_name, user_fullname, user_type, user_position, user_college, user_password, user_email) VALUES 
        (:username, :userfullname, :userroles, :userposition, :usercollege, :userpassword, :email);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':username', $this->username);
        $query->bindParam(':userfullname', $this->userfullname);
        $query->bindParam(':userroles', $this->userroles);
        $query->bindParam(':userposition', $this->userposition);
        $query->bindParam(':usercollege', $this->usercollege);
        $query->bindParam(':userpassword', $this->userpassword);
        $query->bindParam(':email', $this->email);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function delete(){
        $sql = "DELETE FROM users WHERE user_id=:user_id";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $this->userID);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    // Method to log a user in
    function log_in(){
        // SQL statement to retrieve the user with the matching username and password
        $sql = "SELECT * FROM users WHERE BINARY user_name = :username AND BINARY user_password = :password;";

        // Prepare the SQL statement for execution
        $query=$this->db->connect()->prepare($sql);

        // Bind the parameters to the SQL statement
        $query->bindParam(':username', $this->username);
        $query->bindParam(':password', $this->userpassword);

        // Execute the SQL statement
        if($query->execute()){
            // Check if the user was found
            if($query->rowCount()>0){
                // Return true if the user was found
                return true;
            }
        }
        // Return false if the user was not found
        return false;
    }

    // Method to retrieve the user's account information
    function get_users_info($id=0){
        // Check if the id parameter was provided
        if($id == 0){
            // SQL statement to retrieve the user with the matching username and password
            $sql = "SELECT * FROM users WHERE BINARY user_name = :username AND BINARY user_password = :password;";

            // Prepare the SQL statement for execution
            $query=$this->db->connect()->prepare($sql);

            // Bind the parameters to the SQL statement
            $query->bindParam(':username', $this->username);
            $query->bindParam(':password', $this->userpassword);
        }else{
            // SQL statement to retrieve the user with the matching id
            $sql = "SELECT * FROM users WHERE user_id = :id;";

            // Prepare the SQL statement for execution
            $query=$this->db->connect()->prepare($sql);

            // Bind the parameter to the SQL statement
            $query->bindParam(':id', $id);
        }

        // Execute the SQL statement
        if($query->execute()){
            // Fetch the data
            $data = $query->fetchAll();
        }
        // Return the data
        return $data;
    }


    function get_all_users(){
        // SQL statement to retrieve all users
        $sql = "SELECT * FROM users;";
    
        // Prepare the SQL statement for execution
        $query=$this->db->connect()->prepare($sql);
    
        // Execute the SQL statement
        if($query->execute()){
            // Fetch the data
            $data = $query->fetchAll();
        }
        // Return the data
        return $data;
    }

}

?>
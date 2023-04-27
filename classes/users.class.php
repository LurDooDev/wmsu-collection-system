<?php

// Include the database class
require_once 'database.class.php';

// Declare the Users class
class Users{

    // Class properties
    public $id;
    public $username;
    public $userfullname;
    public $userposition;
    public $userpassword;
    public $roleID;
    public $collegeID;

    // protected property to store the database connection
    protected $db;

    // Class constructor to initialize the database connection
    function __construct()
    {
        $this->db = new Database();
    }


    function addUser(){
    try {
      
        $roleSql = "SELECT id FROM roles WHERE id = :id";
            $roleStmt = $this->db->connect()->prepare($roleSql);
            $roleStmt->bindParam(':id', $this->roleID);
            $roleStmt->execute();
            $roleID = $roleStmt->fetchColumn();
       
            $collegeSql = "SELECT id FROM colleges WHERE id = :id";
            $collegeStmt = $this->db->connect()->prepare($collegeSql);
            $collegeStmt->bindParam(':id', $this->collegeID);
            $collegeStmt->execute();
            $collegeID = $collegeStmt->fetchColumn();

            $insertSql = "INSERT INTO users (role_id, college_id, user_username, user_password, user_fullname, user_position) VALUES (:role_id, :college_id, :username, :userpassword, :userfullname, :userposition)";
            $insertStmt = $this->db->connect()->prepare($insertSql);
            $insertStmt->bindParam(':role_id', $roleID);
            $insertStmt->bindParam(':college_id', $collegeID);
            $insertStmt->bindParam(':username', $this->username);
            $insertStmt->bindParam(':userpassword', $this->userpassword);
            $insertStmt->bindParam(':userfullname', $this->userfullname);
            $insertStmt->bindParam(':userposition', $this->userposition);
            $insertStmt->execute();
        
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

    //old
    function showByCollege($college) {
        $sql = "SELECT * FROM users WHERE user_college = :college";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':college', $college, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userData;
    }

    function showAllDetails() {
        $sql = "SELECT u.id, u.user_fullname, u.user_position, r.role_name, c.college_name, c.college_code
        FROM users u 
        JOIN roles r ON u.role_id = r.id 
        JOIN colleges c ON u.college_id = c.id";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function show(){
        $sql = "SELECT * FROM users;";
        
        $query=$this->db->connect()->prepare($sql);
        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    // Method to log a user in
    function log_in($username, $password) {
        // Sanitize inputs
        $username = htmlentities($username);
    
        // SQL statement to retrieve the user with the matching username
        $sql = "SELECT u.id, u.user_fullname, u.college_id, u.user_position, r.role_name, c.college_name, c.college_code, u.user_password 
                FROM users u 
                JOIN roles r ON u.role_id = r.id 
                JOIN colleges c ON u.college_id = c.id
                WHERE BINARY u.user_username = :username;";
    
        // Prepare the SQL statement for execution
        $query = $this->db->connect()->prepare($sql);
    
        // Bind the parameters to the SQL statement
        $query->bindParam(':username', $username);
    
        // Execute the SQL statement
        if ($query->execute()) {
            // Fetch the data
            $data = $query->fetchAll();
    
            if (count($data) == 1) {
                // Verify the password using password_verify()
                if (password_verify($password, $data[0]['user_password'])) {
                    // Login successful
                    return $data[0];
                }
            }
        }
        // Login failed
        return false;
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
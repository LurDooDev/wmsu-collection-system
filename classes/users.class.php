<?php

// Include the database class
require_once 'database.class.php';

// Declare the Users class
class Users{

    // Class properties
    public $id;
    public $username;
    public $password;
    public $email;
    public $type;

    // protected property to store the database connection
    protected $db;

    // Class constructor to initialize the database connection
    function __construct()
    {
        $this->db = new Database();
    }

    // Method to log a user in
    function log_in(){
        // SQL statement to retrieve the user with the matching username and password
        $sql = "SELECT * FROM users WHERE BINARY user_name = :username AND BINARY user_password = :password;";

        // Prepare the SQL statement for execution
        $query=$this->db->connect()->prepare($sql);

        // Bind the parameters to the SQL statement
        $query->bindParam(':username', $this->username);
        $query->bindParam(':password', $this->password);

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
    function get_account_info($id=0){
        // Check if the id parameter was provided
        if($id == 0){
            // SQL statement to retrieve the user with the matching username and password
            $sql = "SELECT * FROM users WHERE BINARY user_name = :username AND BINARY user_password = :password;";

            // Prepare the SQL statement for execution
            $query=$this->db->connect()->prepare($sql);

            // Bind the parameters to the SQL statement
            $query->bindParam(':username', $this->username);
            $query->bindParam(':password', $this->password);
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

}

?>

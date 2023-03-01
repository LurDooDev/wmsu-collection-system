<?php

require_once 'database.class.php';

class College {
    //attributes

    public $collegeID;
    public $collegeCode;
    public $collegeName;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO colleges (college_id, college_name, college_code) VALUES 
        (:college_id, :college_name, :college_code);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $this->collegeID);
        $query->bindParam(':college_code', $this->collegeCode);
        $query->bindParam(':college_name', $this->collegeName);
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function update(){
        $sql = "UPDATE colleges SET college_name=:college_name, college_code=:college_code WHERE college_id=:college_id";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':college_name', $this->collegeName);
        $query->bindParam(':college_code', $this->collegeCode);
        $query->bindParam(':college_id', $this->collegeID);
        
        if ($query->execute()) {
            $count = $query->rowCount();
            echo "$count row updated";
            return true;
        } else {
            $error = $query->errorInfo();
            echo "Update failed: " . $error[2];
            return false;
        }	
    }
    

    function get($id) {
        $sql = "SELECT * FROM colleges WHERE college_id = :college_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $id);
        $query->execute();
        return $query->fetch();
    }
    
    
    


    function delete(){
        $sql = "DELETE FROM colleges WHERE college_id=:college_id";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $this->collegeID);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function show(){
        $sql = "SELECT * FROM `colleges` ORDER BY `colleges`.`college_id` ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}

?>
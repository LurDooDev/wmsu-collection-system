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

    // //Methods
    function createCollege(){
        $sql = "INSERT INTO colleges (college_name, college_code) VALUES 
        (:college_name, :college_code);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':college_code', $this->collegeCode);
        $query->bindParam(':college_name', $this->collegeName);
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }
    

    function get($id) {
        $sql = "SELECT * FROM colleges WHERE id = :college_id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':college_id', $id);
        $query->execute();
        return $query->fetch();
    }
    

    function show(){
        $sql = "SELECT * FROM colleges ORDER BY colleges.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}

?>
<?php

require_once 'database.class.php';

class Semester {
    public $semesterID;
    public $semesterName;
    public $semesterDuration;
    public $isActive;
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function show(){
        $sql = "SELECT * FROM semesters ORDER BY semesters.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    
    function update(){
        $sql = "UPDATE semesters SET semester_name=:semester_name, semester_duration=:semester_duration, is_active=:is_active WHERE id=:id";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':semester_name', $this->semesterName);
        $query->bindParam(':semester_duration', $this->semesterDuration);
        $query->bindParam(':is_active', $this->isActive);
        $query->bindParam(':id', $this->semesterID);
        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }	
    }

    function create(){
        $sql = "INSERT INTO semesters (semester_name, semester_duration) VALUES 
        (:semester_name, :semester_duration);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':semester_name', $this->semesterName);
        $query->bindParam(':semester_duration', $this->semesterDuration);
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}
?>
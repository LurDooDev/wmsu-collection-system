<?php

require_once 'database.class.php';

class AcademicYear {
    public $academicYearID;
    public $academicYearName;
    public $academicStartDate;
    public $academicEndDate;
    public $isActive;
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function show(){
        $sql = "SELECT * FROM academic_year ORDER BY academic_year.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function create(){
        $sql = "INSERT INTO academic_year (academic_name, academic_start_date, academic_end_date) VALUES 
        (:academic_name, :academic_start_date, :academic_end_date );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':academic_name', $this->academicYearName);
        $query->bindParam(':academic_start_date', $this->academicStartDate);
        $query->bindParam(':academic_end_date', $this->academicEndDate);
    
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function update(){
        $sql = "UPDATE academic_year SET academic_start_date=:academic_start_date, academic_end_date=:academic_end_date, is_active=:is_active WHERE id=:id";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':academic_start_date', $this->academicStartDate);
        $query->bindParam(':academic_end_date', $this->academicEndDate);
        $query->bindParam(':is_active', $this->isActive);
        $query->bindParam(':id', $this->academicYearID);
        
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }	
    }

}
<?php

require_once 'database.class.php';

class Semester {
    public $semesterID;
    public $semesterName;
    public $semesterStartDate;
    public $semesterEndDate;
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function show(){
        $sql = "SELECT * FROM `semesters` ORDER BY `semesters`.`id` ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}
?>
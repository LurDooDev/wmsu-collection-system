<?php

require_once 'database.class.php';

class SchoolYear {
    public $schoolYearID;
    public $schoolYearName;
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function show(){
        $sql = "SELECT * FROM `school_year` ORDER BY `school_year`.`school_year_id` ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}
?>
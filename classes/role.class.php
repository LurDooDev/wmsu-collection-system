<?php

require_once 'database.class.php';

class Role {
    //attributes

    public $roleID;
    public $roleName;
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function show(){
        $sql = "SELECT * FROM roles ORDER BY roles.id ASC";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}

?>
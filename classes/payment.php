<?php

require_once 'database.class.php';

class LocalPayment {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}
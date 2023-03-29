<?php

class Database {
    private $host = 'localhost';
    private $username = 'u742250709_wmsu';
    private $password = 'Godisgood420!';
    private $database = 'u742250709_wmsucollection';
    protected $connection;

    public function connect() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
            die();
        }
        return $this->connection;
    }
}
?>

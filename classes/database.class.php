<?php

class Database{
    private $host = 'localhost';
    private $username = 'u742250709_wmsu';
    private $password = 'Godisgood420!';
    private $database = 'u742250709_wmsucollection';
    protected $connection;

    function connect(){
        try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
        return $this->connection;
    }

}

?>

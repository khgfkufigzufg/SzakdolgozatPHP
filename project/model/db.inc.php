<?php

// Db osztály
class Db {
    //bkTlk8QOX4vzjP5E --- adminszakd --- c31f --- afw!ZXfS4fK2
    private $servername = "localhost";
    private $username = "c31f";
    private $password = "afw!ZXfS4fK2";
    private $dbname = "szakdoga";
    
    private $conn;
    
    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->servername,
            $this->username, $this->password, $this->dbname);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
       
        /*else{
            echo 'Sikeres csatlakozás';
        }*/
    }
    
    public function execSQL($sql) {
        if(!$result = $this->conn->query($sql)) {
            echo("Error description: " . mysqli_error($this->conn)." in $sql");
        }
        return $result;
    }
    
    public function insertSQL($sql) {
        $result = $this->execSQL($sql);
        return $this->conn->insert_id;
    }
    
}

// Db példány
$Db = new Db();

?>
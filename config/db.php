<?php

class Database
{
    private $conn;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        global $databaseConfig;

        $this->host = $databaseConfig['host'];
        $this->username = $databaseConfig['username'];
        $this->password = $databaseConfig['password'];
        $this->database = $databaseConfig['database'];

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}
?>

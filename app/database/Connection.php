<?php 

namespace app\database;

use PDO;
use PDOException;  

class Connection
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];

        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getConnection()
    {
        $connection = new self(); // Create a new instance of Connection
        return $connection->conn;
    }
}




             
          




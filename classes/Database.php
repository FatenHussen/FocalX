<?php
class Database {
    private $host = 'localhost'; // The hostname of your MySQL server
    private $db_name = 'blog_db'; // The name of your database
    private $username = 'root'; // The username for accessing MySQL (default is 'root' for XAMPP)
    private $password = ''; // The password for the MySQL user (default is empty for XAMPP)
    public $conn;

    // Method to establish a connection to the database
    public function getConnection() {
        $this->conn = null;

        try {
            // Create a new PDO instance and assign it to $this->conn
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Set the PDO error mode to exception for better error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Display connection error message if the connection fails
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

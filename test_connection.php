<?php
require_once 'classes/Database.php'; // Include the Database class

// Create a new instance of the Database class
$database = new Database();

// Call the getConnection method to attempt a connection to the database
$db = $database->getConnection();

// Check if the connection was successful
if ($db) {
    echo "Connected to the database successfully!";
} else {
    echo "Failed to connect to the database.";
}

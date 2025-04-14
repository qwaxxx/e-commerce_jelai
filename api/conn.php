<?php
$host = "localhost";
$username = "jecefi";  // Change if using a different user
$password = "123456789";      // Change if using a password
$dbname = "e-commerce";

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

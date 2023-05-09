<?php
   // Set database credentials
$servername = "localhost:8111";
$username = "root";
$password = "Khush@151002";
$dbname = "bank";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
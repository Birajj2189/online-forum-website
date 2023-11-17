<?php
// script to connect to the database
// Create a database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "codewave";

$connection = mysqli_connect($host, $username, $password, $database);

// Check for database connection error
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
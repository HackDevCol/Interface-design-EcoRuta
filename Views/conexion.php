<?php
$host = "localhost";
$user = "root";
$password = "n*24R.506t";
$database = "EcoRuta";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connection successful";
?>

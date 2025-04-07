<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "usuarios";

// Create connection
$conn = new mysqli($server, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$age = $_POST['age'];

// Encrypt password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// SQL insert
$sql = "INSERT INTO users (name, email, password, age) VALUES ('$name', '$email', '$hashedPassword', $age)";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

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

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Search for user
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../views/Index.html");
        exit();
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='../views/login.html';</script>";
    }
} else {
    echo "<script>alert('User not found'); window.location.href='../views/login.html';</script>";
}

$conn->close();
?>

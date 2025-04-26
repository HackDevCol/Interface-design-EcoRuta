<?php
global $conn;
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['password'] ?? '';

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($contraseña)) {
        die("Todos los campos son obligatorios");
    }

    // Hashear la contraseña
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    try {
        // Verificar si el email ya existe
        $stmt = $conn->prepare("SELECT id FROM repartidores WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            die("El email ya está registrado");
        }

        // Insertar nuevo repartidor
        $stmt = $conn->prepare("INSERT INTO repartidores (nombre, email, contraseña) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $contraseñaHash]);

        echo "Registro exitoso";
    } catch(PDOException $e) {
        die("Error al registrar: " . $e->getMessage());
    }
} else {
    die("Método no permitido");
}
?>
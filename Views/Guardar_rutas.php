<?php
global $conn;
require_once 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Debes iniciar sesión primero");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destino = $_POST['destino'] ?? '';
    $ruta_optima = $_POST['ruta_optima'] ?? '';

    if (empty($destino) || empty($ruta_optima)) {
        die("Datos incompletos");
    }

    try {
        $stmt = $conn->prepare("INSERT INTO rutas (id_repartidor, destino, ruta_optima) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $destino, $ruta_optima]);
        
        echo "Ruta guardada exitosamente";
    } catch(PDOException $e) {
        die("Error al guardar la ruta: " . $e->getMessage());
    }
} else {
    die("Método no permitido");
}
?>
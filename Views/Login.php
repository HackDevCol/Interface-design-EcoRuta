<?php
global $conn;
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $contraseña = $_POST['password'] ?? '';

    try {
      
        $stmt = $conn->prepare("SELECT id, nombre, contraseña FROM repartidores WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
           
            if (password_verify($contraseña, $user['contraseña'])) {
               
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                
               
                header("Location: Home.html");
                exit();
            }
        }
        
    
        header("Location: Index.html?error=1");
        exit();
        
    } catch(PDOException $e) {
        die("Error al iniciar sesión: " . $e->getMessage());
    }
} else {
    die("Método no permitido");
}
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php'; 

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        // Verificación de contraseña en TEXTO PLANO (SOLO PARA DEMO)
        if ($password === $usuario["password"]) {
            // La contraseña es correcta
            $_SESSION["usuario"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];
            
            // Redirigir según el rol
            if ($usuario["rol"] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: bienvenida.php"); 
            }
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login.php?error=2");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Si alguien intenta acceder al archivo directamente, lo redirigimos
    header("Location: login.php");
    exit();
}
?>
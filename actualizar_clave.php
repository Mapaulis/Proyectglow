<?php
$conexion = new mysqli("localhost", "root", "", "glow_showup");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nueva_clave = password_hash($_POST['nueva_clave'], PASSWORD_DEFAULT);

    $resultado = $conexion->query("SELECT * FROM usuarios WHERE token_recuperacion='$token' AND token_expira >= NOW()");

    if ($resultado->num_rows == 1) {
        $conexion->query("UPDATE usuarios SET password='$nueva_clave', token_recuperacion=NULL, token_expira=NULL WHERE token_recuperacion='$token'");
        echo "✅ Contraseña actualizada correctamente. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "❌ El enlace no es válido o ha expirado.";
    }
}
?>

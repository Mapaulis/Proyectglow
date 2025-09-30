<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "glow_showup");
    if ($conexion->connect_error) die("Error: " . $conexion->connect_error);

    $email = $_POST["email"];
    $codigo = $_POST["codigo"];
    $nueva_contrasena = $_POST["nueva_contrasena"];

    // Verificar token válido
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("ss", $email, $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Actualizar contraseña
        $stmt = $conexion->prepare("UPDATE usuarios SET password=?, reset_token=NULL, reset_token_expiry=NULL WHERE email=?");
        $stmt->bind_param("ss", $nueva_contrasena, $email);
        $stmt->execute();

        echo "✅ Contraseña actualizada correctamente. <a href='login.php'>Inicia sesión</a>";
    } else {
        echo "❌ Código inválido o expirado.";
    }
}
?>

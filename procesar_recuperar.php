<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "glow_showup");
    if ($conexion->connect_error) die("Error: " . $conexion->connect_error);

    $email = $_POST["email"];
    $codigo = rand(100000, 999999);
    $expira = date("Y-m-d H:i:s", strtotime("+15 minutes"));

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Guardamos el token en la base de datos
        $stmt = $conexion->prepare("UPDATE usuarios SET reset_token=?, reset_token_expiry=? WHERE email=?");
        $stmt->bind_param("sss", $codigo, $expira, $email);
        $stmt->execute();

        // Enviar correo
        $asunto = "Tu código de recuperación";
        $mensaje = "Tu código de recuperación es: $codigo\nEste código expira en 15 minutos.";
        $cabeceras = "From: no-reply@glowshowup.com";

        mail($email, $asunto, $mensaje, $cabeceras);

        echo "Código enviado al correo. <a href='restablecer.php'>Haz clic aquí para restablecer tu contraseña</a>";
    } else {
        echo "❌ Correo no registrado.";
    }
}
?>

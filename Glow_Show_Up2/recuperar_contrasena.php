<?php
// Usaremos PHPMailer para enviar el correo. Asumimos que está en la carpeta "PHPMailer" junto a este archivo.
// Puedes descargar PHPMailer desde https://github.com/PHPMailer/PHPMailer y colocar la carpeta PHPMailer aquí.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if ($email) {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP de Gmail
            $mail->isSMTP();
            $mail->SMTPDebug = 0;                      // 0 para no mostrar debug, 2 para debug
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'adsosoft@gmail.com'; // <- Cambia aquí por tu correo Gmail
            $mail->Password   = 'xome wnlo oksz zzuz'; // <- Cambia aquí por tu contraseña o contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Establecer la codificación de caracteres
            $mail->CharSet = 'UTF-8'; // Asegúrate de que la codificación sea UTF-8
            // Destinatarios
            $mail->setFrom('ngmonta@gmail.com', 'Recuperacion de Contraseña');
            $mail->addAddress($email);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Instrucciones para recuperar tu contraseña';
            // Aquí puedes poner un enlace real a la recuperación o código
            // Conexión a tu base de datos
$conexion = new mysqli("localhost", "root", "", "glow_showup");

// Generar token
$token = bin2hex(random_bytes(16));
$expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

// Guardar token en la base de datos
$conexion->query("UPDATE usuarios SET token_recuperacion='$token', token_expira='$expira' WHERE email='$email'");

// Enlace de recuperación
$enlace = "http://localhost/GLOW_SHOW_UP2/restablecer.php?token=$token";

// Cuerpo del correo
$mail->Body = "
<p>Hola, hemos recibido una solicitud para recuperar tu contraseña.</p>
<p>Haz clic en el siguiente enlace para restablecerla (válido por 1 hora):</p>
<p><a href='$enlace'>$enlace</a></p>
<p>Si no solicitaste esto, ignora este correo.</p>
";


            $mail->send();
            $mensaje = "Se ha enviado un correo de recuperación a $email.";
        } catch (Exception $e) {
            $mensaje = "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    } else {
        $mensaje = "Por favor ingresa un correo electrónico válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Recuperar Contraseña</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    margin: 0; padding: 0;
    display: flex;
    min-height: 100vh;
    justify-content: center;
    align-items: center;
  }
  .container {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    max-width: 380px;
    width: 90%;
  }
  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #333;
  }
  form {
    display: flex;
    flex-direction: column;
  }
  input[type="email"] {
    padding: 0.75rem;
    font-size: 1rem;
    border: 1.5px solid #ccc;
    border-radius: 5px;
    margin-bottom: 1rem;
    transition: border-color 0.3s ease;
  }
  input[type="email"]:focus {
    outline: none;
    border-color: #007bff;
  }
  button {
    background: #007bff;
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.75rem;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  button:hover {
    background: #0056b3;
  }
  .message {
    margin-top: 1rem;
    font-size: 0.95rem;
    text-align: center;
    color: #555;
  }
  @media (max-width: 400px) {
    .container {
      padding: 1.5rem;
    }
  }
</style>
</head>
<body>
<div class="container">
  <h2>Recuperar Contraseña</h2>
  <form id="recoverForm" method="POST" action="">
    <label for="email" style="display:none;">Correo electrónico</label>
    <input type="text" id="email" name="email" placeholder="Tu correo electrónico"/>
    <button type="submit">Enviar correo de recuperación</button>
  </form>
  <?php if ($mensaje): ?>
  <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
  <?php endif; ?>
</div>

<script>
  document.getElementById('recoverForm').addEventListener('submit', function(e){
    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();
    if(!email) {
      alert('Ingresa un correo electrónico.');
      e.preventDefault();
      return;
    }
    // Validación simple de formato
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)) {
      alert('Ingresa un correo electrónico válido.');
      e.preventDefault();
      return;
    }
  });
</script>
</body>
</html>
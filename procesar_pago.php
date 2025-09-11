<?php
// Captura los datos del formulario (opcional por ahora)
$nombre = $_POST['nombre'] ?? '';
$numero = $_POST['numero_tarjeta'] ?? '';
$fecha = $_POST['fecha_expiracion'] ?? '';
$cvv = $_POST['cvv'] ?? '';

// Mostrar mensaje bonito al usuario
echo "
<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='UTF-8'>
  <title>Pago exitoso | Glow Show Up</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('imagenes/fondopago.png') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      backdrop-filter: blur(6px);
    }
    .mensaje {
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    .mensaje h2 {
      color: #b472ff;
      margin-bottom: 20px;
    }
    .mensaje a {
      display: inline-block;
      margin-top: 20px;
      background-color: #b472ff;
      color: white;
      padding: 12px 20px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }
    .mensaje a:hover {
      background-color: #8e4dd4;
    }
  </style>
</head>
<body>
  <div class='mensaje'>
    <h2>✅ ¡Pago realizado con éxito!</h2>
    <p>Gracias por tu compra, $nombre.</p>
    <a href='index.html'>Volver al Inicio</a>
  </div>
</body>
</html>
";
?>
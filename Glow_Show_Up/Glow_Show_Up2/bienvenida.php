<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido a Glow Show Up</title>
  <style>
   body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(rgba(255,255,255,0.6), rgba(255,255,255,0.6)), url('imagenes/fondobienvenida.png') no-repeat center center fixed;
  background-size: cover;
}


    h1 {
      font-size: 3em;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.3em;
      max-width: 600px;
    }

    .emoji {
      font-size: 2em;
      margin-bottom: 10px;
    }

    .cerrar {
      margin-top: 30px;
      background: white;
      color: #b464a4;
      padding: 10px 25px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s;
    }

    .cerrar:hover {
      background: #f2d0e7;
    }
    
  </style>
</head>
<body>
  <div class="emoji">✨🌟🌈</div>
  <h1>¡Bienvenido/a a Glow Show Up!</h1>
  <p>Nos alegra tenerte de vuelta, <strong><?php echo htmlspecialchars($usuario); ?></strong>.  
  ¡Estamos listos para mostrarte nuestras últimas tendencias! 💖🛍️</p>

  <a class="cerrar" href="logout.php">Cerrar sesión</a>
</body>
</html>

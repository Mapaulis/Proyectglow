<?php
session_start();

// Si el usuario no ha iniciado sesión, lo redirigimos al login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Obtenemos el nombre del usuario de la sesión para mostrarlo
$nombreUsuario = htmlspecialchars($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido/a a Glow Show Up</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('imagenes/fondobienvenida.jpg') no-repeat center center fixed; /* Pon tu imagen de fondo aquí */
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px;
        }
        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 2rem;
        }
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .btn {
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #b472ff;
            color: white;
        }
        .btn-secondary {
            background-color: #eee;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="welcome-container">
        <h2>✨ ¡Bienvenido/a, <?php echo $nombreUsuario; ?>! ✨</h2>
        <p>Nos alegra tenerte de vuelta. ¿Qué te gustaría hacer ahora?</p>
        <div class="actions">
            <a href="productx.php" class="btn btn-primary">🛍️ Ver Catálogo</a>
            <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
            <a href="index.html" class ="btn btn-secondary"> 🏠 Página Principal</a>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glow Show Up - Inicia sesión</title>

  <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = new mysqli("localhost", "root", "", "glow_showup");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if ($usuario["password"] === $password) {
            $_SESSION["usuario"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];
            header("Location: bienvenida.php");
            exit();
          } else {
            header("Location: login.php?error=1"); // contraseña incorrecta
            exit();
        }
    } else {
        header("Location: login.php?error=2"); // usuario no encontrado
        exit();
    }
}
?>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: 
        linear-gradient(135deg, rgba(231, 150, 207, 0.6), rgba(171, 229, 243, 0.6)),
        url('imagenes/fondoiniciodesesion.png') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: white;
      border-radius: 20px;
      width: 90%;
      max-width: 1000px;
      display: flex;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .form-section, .info-section {
      flex: 1;
      padding: 40px;
    }

    .form-section {
      border-right: 1px solid #ddd;
    }

    h1 {
      font-size: 26px;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      font-weight: 600;
      margin-top: 15px;
      display: block;
      color: #555;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }

    .remember {
      display: flex;
      align-items: center;
      margin: 10px 0;
    }

    .remember input {
      margin-right: 10px;
    }

    .button {
      margin-top: 20px;
      width: 100%;
      background: linear-gradient(to right,rgb(230, 157, 187), #b9a9f7);
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
    }

    .button:hover {
      opacity: 0.9;
    }

    .info-section {
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: #f9f9f9;
    }

    .info-section ul {
      list-style: none;
      padding-left: 0;
    }

    .info-section li {
      margin-bottom: 15px;
      color: #333;
    }

    .google-login {
      text-align: center;
      margin-top: 30px;
    }

    .google-login button {
      background: white;
      border: 1px solid #ccc;
      padding: 10px 20px;
      border-radius: 10px;
      cursor: pointer;
      
    }
    .error {
  background: #ffe0e0;
  color: #a94442;
  padding: 12px;
  margin-top: 20px;
  border: 1px solid #f5c6cb;
  border-radius: 10px;
  text-align: center;
  font-weight: bold;
  width: 100%;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h1>Inicia sesión en Glow Show Up</h1>
      <form method="POST" action="login.php">
  <label for="email">Correo electrónico</label>
  <input type="email" id="email" name="email" required>

  <label for="password">Contraseña</label>
  <input type="password" id="password" name="password" required>

  <div class="checkbox">
    <input type="checkbox" id="remember" name="remember">
    <label for="remember">Recuérdame</label>
  </div>

  <button type="submit" class="button">Iniciar sesión</button>
</form>


      <div>
<div style="margin-top: 15px;">
  <a href="recuperar_contrasena.php" class="button" style="display: inline-block; text-align: center; text-decoration: none;">¿Olvidaste tu contraseña?</a>
</div>

      </div>
    </div>

    <div class="info-section">
      <h1>¿Nuevo en Glow Show Up?</h1>
      <ul>
        <li>🔍 Haz seguimiento de tus pedidos fácilmente</li>
        <li>💾 Guarda tus datos para compras rápidas</li>
        <li>💬 Accede a devoluciones y soporte online</li>
      </ul>
      <button class="button" onclick="window.location.href='registro.php'">Crear cuenta</button>
    </div>
  </div>

  
  <script>
    function validarFormulario() {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      if (!email.includes('@')) {
        alert('Por favor, ingresa un correo válido.');
        return false;
      }

      if (password.length < 3) {
        alert('La contraseña debe tener al menos 3 caracteres.');
        return false;
      }

      return true; // permite enviar el formulario
    }
  </script>
</body>

</html>
</body>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 1) {
        echo "<div class='error'>⚠️ Contraseña incorrecta. Intenta de nuevo.</div>";
    } elseif ($_GET['error'] == 2) {
        echo "<div class='error'>⚠️ Usuario no encontrado. Verifica tus datos.</div>";
    }
}
?>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crear cuenta - Glow Show Up</title>

<?php
$mensaje = ""; // Para mostrar mensajes al usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Conexión sin contraseña (por defecto en XAMPP)
  $conexion = new mysqli("localhost", "root", "", "glow_showup");

  if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
  }

  // Recoger y limpiar datos
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $nombre = trim($_POST["nombre"]);
  $apellidos = trim($_POST["apellidos"]);
  $prefijo = trim($_POST["prefijo"]);
  $telefono = trim($_POST["telefono"]);
  $telefonoCompleto = $prefijo . $telefono;
  $novedades = isset($_POST["novedades"]) ? 1 : 0;

  // Verificar si el correo ya existe
  $verifica = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
  $verifica->bind_param("s", $email);
  $verifica->execute();
  $verifica->store_result();

  if ($verifica->num_rows > 0) {
    $mensaje = "❌ Este correo ya está registrado.";
  } else {
    // Insertar nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (email, password, nombre, apellidos, telefono, novedades) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $email, $password, $nombre, $apellidos, $telefonoCompleto, $novedades);

    if ($stmt->execute()) {
      echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('mensaje-exito').style.display = 'flex';
        });
      </script>";
    } else {
      $mensaje = "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
  }

  $verifica->close();
  $conexion->close();
}
?>
<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #ff9efc, #caa0ff, #9fffcf);
    background-size: 300% 300%;
    animation: gradiente 15s ease infinite;
    min-height: 100vh;
  }

  @keyframes gradiente {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .container {
    display: flex;
    flex-direction: row;
    height: 100vh;
  }

  .imagen-lado {
    flex: 1;
    background: url('imagenes/imagenregistro.png') no-repeat center center;
    background-size: cover;
  }

  .formulario {
    flex: 1;
    background-color: #ffffff;
    padding: 60px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
  }

  .formulario h2 {
    font-size: 32px;
    color: #6d0ba9;
    text-align: center;
    margin-bottom: 30px;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: bold;
    color: #333;
    margin-top: 18px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="tel"],
  select {
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 10px;
    margin-top: 6px;
    font-size: 16px;
    transition: border-color 0.3s;
  }

  input:focus,
  select:focus {
    border-color: #8000ff;
    outline: none;
  }

  .telefono {
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .checkbox {
    margin-top: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }

  .checkbox label {
    font-size: 15px;
    color: #444;
  }

  .politica {
    font-size: 14px;
    color: #555;
    margin-top: 15px;
  }

  .politica a {
    color: #8000ff;
    text-decoration: none;
    font-weight: bold;
  }

  .politica a:hover {
    text-decoration: underline;
  }

  button {
    margin-top: 25px;
    background: #8000ff;
    color: white;
    padding: 14px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #5e00c9;
  }

  #mensaje-exito {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
  }

  .modal {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    text-align: center;
  }

  .modal p {
    font-size: 22px;
    color: #4B0082;
    margin-bottom: 20px;
  }

  .modal button {
    background-color: #8000ff;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
  }

  .modal button:hover {
    background-color: #5e00c9;
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
    }

    .imagen-lado {
      height: 200px;
    }

    .formulario {
      padding: 40px 20px;
    }
  }
</style>
</head>

<body>
  <div class="container">
    <div class="imagen-lado"></div>
    <div class="formulario">
      <h2>CREA TU CUENTA</h2>
      <form method="POST">
        <label for="email">Correo electrónico*</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña*</label>
        <input type="password" id="password" name="password" required>

        <label for="nombre">Nombre*</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos*</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="telefono">Teléfono fijo*</label>
        <div class="telefono">
          <select name="prefijo" id="prefijo" required>
            <option value="+57">+57 - Colombia</option>
            <option value="+52">+52 - México</option>
            <option value="+1">+1 - USA</option>
          </select>
          <input type="tel" id="telefono" name="telefono" required>
        </div>

        <div class="checkbox">
          <input type="checkbox" id="novedades" name="novedades">
          <label for="novedades">Quiero recibir novedades y promociones personalizadas de Glow Show Up</label>
        </div>

        <p class="politica">
          Al pulsar en Crear Cuenta confirmo que he leído y acepto los 
          <a href="#">Términos de Uso</a> y la 
          <a href="#">Política de Privacidad</a>.
        </p>

        <button type="submit">CREAR CUENTA</button>

        <?php if (!empty($mensaje)) : ?>
          <p style="color: red; font-weight: bold; margin-top: 20px;"><?php echo $mensaje; ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Modal de éxito -->
  <div id="mensaje-exito" style="display:none;">
    <div class="modal">
      <p>¡Te has registrado con éxito!</p>
      <button onclick="cerrarModal()">Aceptar</button>
    </div>
  </div>

  <script>
    function cerrarModal() {
      document.getElementById("mensaje-exito").style.display = "none";
    }
  </script>
</body>
</html>

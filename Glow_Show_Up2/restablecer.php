<?php
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer contraseña</title>
</head>
<body>
  <h2>Restablecer contraseña</h2>
  <form method="POST" action="actualizar_clave.php">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <label>Nueva contraseña:</label>
    <input type="password" name="nueva_clave" required>
    <br>
    <button type="submit">Actualizar contraseña</button>
  </form>
</body>
</html>

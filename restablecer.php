<!-- restablecer.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer contraseña</title>
</head>
<body>
  <h2>Restablece tu contraseña</h2>
  <form action="procesar_restablecer.php" method="POST">
    <label for="email">Correo:</label><br>
    <input type="email" name="email" required><br><br>

    <label for="codigo">Código recibido:</label><br>
    <input type="text" name="codigo" required><br><br>

    <label for="nueva_contrasena">Nueva contraseña:</label><br>
    <input type="password" name="nueva_contrasena" required><br><br>

    <button type="submit">Actualizar contraseña</button>
  </form>
</body>
</html>

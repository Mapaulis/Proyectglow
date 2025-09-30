<!-- recuperar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar contraseña</title>
</head>
<body>
  <h2>Recuperar contraseña</h2>
  <form action="procesar_recuperar.php" method="POST">
    <label for="email">Ingresa tu correo registrado:</label><br>
    <input type="email" name="email" required><br><br>
    <button type="submit">Enviar código</button>
  </form>
</body>
</html>

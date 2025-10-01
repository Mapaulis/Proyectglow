<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Show Up - Inicia sesión</title>
    <style>
        /* Tu CSS se queda exactamente igual, está muy bien */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, rgba(231, 150, 207, 0.6), rgba(171, 229, 243, 0.6)), url('imagenes/fondoiniciodesesion.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .container { background: white; border-radius: 20px; width: 100%; max-width: 1000px; display: flex; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); overflow: hidden; flex-wrap: wrap; }
        .form-section, .info-section { flex: 1; padding: 40px; min-width: 300px; }
        .form-section { border-right: 1px solid #ddd; }
        h1 { font-size: 26px; margin-bottom: 20px; color: #333; }
        label { font-weight: 600; margin-top: 15px; display: block; color: #555; }
        input[type="email"], input[type="password"] { width: 100%; padding: 10px; margin-top: 5px; border-radius: 10px; border: 1px solid #ccc; }
        .button { margin-top: 20px; width: 100%; background: linear-gradient(to right,rgb(230, 157, 187), #b9a9f7); border: none; padding: 12px; font-weight: bold; border-radius: 12px; cursor: pointer; transition: 0.3s; color: white; text-align: center; text-decoration: none; display: inline-block; }
        .button:hover { opacity: 0.9; }
        .info-section { display: flex; flex-direction: column; justify-content: center; background-color: #f9f9f9; }
        .info-section ul { list-style: none; padding-left: 0; }
        .info-section li { margin-bottom: 15px; color: #333; }
        .error { background: #ffe0e0; color: #a94442; padding: 12px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 10px; text-align: center; font-weight: bold; width: 100%; }
        @media (max-width: 768px) { .form-section { border-right: none; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h1>Inicia sesión en Glow Show Up</h1>
            
            <?php
            // Este bloque ahora SÍ está dentro del HTML y mostrará los errores
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    echo "<div class='error'>⚠️ Contraseña incorrecta. Intenta de nuevo.</div>";
                } elseif ($_GET['error'] == 2) {
                    echo "<div class='error'>⚠️ Usuario no encontrado. Verifica tus datos.</div>";
                }
            }
            ?>

            <form method="POST" action="login_hanlder.php" onsubmit="return validarFormulario();">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="button">Iniciar sesión</button>
            </form>
            <a href="recuperar.php" class="button" style="background: #6c757d;">Restablecer Contraseña</a>
        </div>

        <div class="info-section">
            <h1>¿Nuevo en Glow Show Up?</h1>
            <ul>
                <li>🔍 Haz seguimiento de tus pedidos fácilmente</li>
                <li>💾 Guarda tus datos para compras rápidas</li>
                <li>💬 Accede a devoluciones y soporte online</li>
            </ul>
            <a href="registro.php" class="button">Crear cuenta</a>
        </div>
    </div>

    <script>
        function validarFormulario() {
            // Tu función de validación está bien, la dejamos como está.
            // Se activa con el onsubmit="return validarFormulario();" que añadimos en el <form>
            return true; 
        }
    </script>
</body>
</html>
<?php
// 1. Inicia la sesión para poder acceder a ella
session_start();

// 2. Limpia todas las variables de la sesión (como el nombre y el rol)
session_unset();

// 3. Destruye la sesión por completo
session_destroy();

// 4. Redirige al usuario a la página de inicio de sesión
header("Location: login.php");
exit();
?>
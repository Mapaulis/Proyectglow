<?php
// Paso 1: Incluir tu archivo de conexión a la base de datos
include 'conexion.php';

// Verificamos que los datos se envíen por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Paso 2: Capturar todos los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $total = floatval($_POST['total_pago']);
    $numero_tarjeta = htmlspecialchars($_POST['numero_tarjeta']);
    $fecha_expiracion = htmlspecialchars($_POST['fecha_expiracion']);
    $cvv = htmlspecialchars($_POST['cvv']);

    // Paso 3: Preparar la consulta SQL para insertar todos los datos de forma segura
    $sql = "INSERT INTO pagos (nombre, total, numero_tarjeta, fecha_expiracion, cvv, fecha_pago) VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($sql);

    // Si la preparación de la consulta falla, muestra un error.
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Paso 4: Vincular los datos a la consulta
    // "sdsss" significa que los tipos de datos son: string, double, string, string, string
    $stmt->bind_param("sdsss", $nombre, $total, $numero_tarjeta, $fecha_expiracion, $cvv);

    // Paso 5: Ejecutar la consulta y redirigir
    if ($stmt->execute()) {
        // Si todo sale bien, redirige a la página de éxito.
        header('Location: pago_exitoso.html');
        exit(); // Es importante terminar el script después de una redirección
    } else {
        // Si hay un error al ejecutar, lo muestra.
        echo "Error al guardar el pago: " . $stmt->error;
    }

    // Cerramos la sentencia y la conexión
    $stmt->close();
    $conn->close();

} else {
    // Si alguien intenta acceder a este archivo sin enviar el formulario, lo redirigimos al catálogo
    header('Location: productx.php');
    exit();
}
?>
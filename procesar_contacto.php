<?php

$host = "localhost";
$user = "root"; 
$pass = "12345"; 
$db = "glow_showup";


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$comentario = $_POST['comentario'];


$sql = "INSERT INTO contacto (nombre, correo, telefono, comentario)
        VALUES ('$nombre', '$correo', '$telefono', '$comentario')";

if ($conn->query($sql) === TRUE) {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gracias por contactarnos</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            body {
                background: #fff0f5;
                margin: 0;
                font-family: "Segoe UI", sans-serif;
            }
            .mensaje-gracias {
                background: linear-gradient(135deg, #fbefff, #ffe3ec);
                border: 2px solid #f3b9c5;
                border-radius: 20px;
                padding: 30px;
                max-width: 500px;
                margin: 100px auto;
                text-align: center;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                color: #702e50;
            }
            .mensaje-gracias h2 {
                font-size: 28px;
                margin-bottom: 10px;
                font-weight: bold;
            }
            .mensaje-gracias p {
                font-size: 18px;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="mensaje-gracias">
            <i class="fas fa-heart fa-2x" style="color:#ff5e8e;"></i>
            <h2>✨ ¡Gracias por contactarnos! ✨</h2>
            <p>Hemos recibido tu mensaje y pronto nos pondremos en contacto contigo.</p>
        </div>
    </body>
    </html>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

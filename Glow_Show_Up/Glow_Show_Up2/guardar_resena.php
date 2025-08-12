<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calificacion = $_POST['rating'];
    $titulo = $_POST['titulo'];
    $comentario = $_POST['comentario'];
    $nombre = $_POST['nombre_publico'];
    $correo = $_POST['correo'];
    $fecha = date("Y-m-d H:i:s");

    // Manejo del archivo (imagen o video)
    $nombreArchivo = '';
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $directorio = 'uploads/';
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $nombreOriginal = basename($_FILES['archivo']['name']);
        $nombreArchivo = $directorio . time() . '_' . $nombreOriginal;

        move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreArchivo);
    }

    $stmt = $conn->prepare("INSERT INTO resenas (calificacion, titulo, comentario, imagen, nombre, correo, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $calificacion, $titulo, $comentario, $nombreArchivo, $nombre, $correo, $fecha);

    if ($stmt->execute()) {
        header("Location: gracias.html");
        exit(); // Muy importante
    } else {
        echo "❌ Error al guardar la reseña: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

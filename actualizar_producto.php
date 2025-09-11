<?php
include 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

$query = "UPDATE productos SET 
            nombre = '$nombre',
            precio = $precio,
            stock = $stock
          WHERE id = $id";

if ($conn->query($query) === TRUE) {
    header("Location: productos.php"); // Redirige al listado
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>



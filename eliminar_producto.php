<?php
include 'conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM productos WHERE id=$id";
$conn->query($sql);

header("Location: productos.php");
?>

<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "glow_showup";

// Creamos la conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificamos la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>

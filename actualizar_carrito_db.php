<?php
session_start();
include 'conexion.php';

// Get the unique ID for this user's session
$session_id = session_id();

// Get the JSON data sent from carrito.js
$data = json_decode(file_get_contents('php://input'), true);
$carrito = $data['carrito'];

// First, delete all old cart entries for this user
$sql_delete = "DELETE FROM carritos WHERE session_id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("s", $session_id);
$stmt_delete->execute();
$stmt_delete->close();

// Now, insert the updated cart items
if (!empty($carrito)) {
    $sql_insert = "INSERT INTO carritos (session_id, producto_id, cantidad) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    foreach ($carrito as $producto) {
        $producto_id = intval($producto['id']);
        $cantidad = intval($producto['cantidad']);
        $stmt_insert->bind_param("sii", $session_id, $producto_id, $cantidad);
        $stmt_insert->execute();
    }
    $stmt_insert->close();
}

$conn->close();

// Send a success response back (optional)
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>
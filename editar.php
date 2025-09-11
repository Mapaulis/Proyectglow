<?php
include 'conexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
} else {
  echo "Producto no encontrado.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto | Glow Show Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #1e1e2f;
      font-family: 'Montserrat', sans-serif;
      color: #fff;
    }
    .container {
      margin-top: 50px;
      max-width: 600px;
      background: #2c2c3e;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 200, 255, 0.3);
    }
    h2 {
      color: #f3c6ff;
      text-align: center;
      margin-bottom: 30px;
    }
    .btn-custom {
      background-color: #e754d5;
      border: none;
      font-weight: bold;
    }
    .btn-custom:hover {
      background-color: #ff8ae1;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Editar Producto</h2>
    <form action="actualizar.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      
      <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']; ?>" required>
      </div>
      <div class="mb-3">
        <label>Precio</label>
        <input type="number" name="precio" class="form-control" value="<?php echo $row['precio']; ?>" required>
      </div>
      <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" required><?php echo $row['descripcion']; ?></textarea>
      </div>

      <button type="submit" class="btn btn-custom w-100">Actualizar</button>
    </form>
  </div>

</body>
</html>

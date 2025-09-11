<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Productos | Glow Show Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.8)), url('imagenes/fondoproducto.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Montserrat', sans-serif;
      color: #fff;
     

    }
    .navbar {
      background-color: #1e1e2f;
      padding: 15px 30px;
    }
    .navbar-brand {
      color: #f3c6ff;
      font-size: 1.8rem;
      font-weight: bold;
    }
    .titulo {
      text-align: center;
      font-size: 2.5rem;
      color: #f3c6ff;
      margin-top: 30px;
    }
    .btn-add {
      background-color: #e754d5;
      color: white;
      font-weight: bold;
    }
    .btn-add:hover {
      background-color: #ff8ae1;
    }
    .table-container {
      background-color: rgba(0, 0, 0, 0.75);
      border-radius: 15px;
      padding: 30px;
      margin-top: 30px;
    }
    .table th, .table td {
      vertical-align: middle !important;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-edit {
      background-color: #ffc107;
      border: none;
    }
    .btn-delete {
      background-color: #dc3545;
      border: none;
      color: white;
    }
    .btn-update {
      background-color: #17a2b8;
      border: none;
      color: white;
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <span class="navbar-brand">🌟 Glow Show Up | Gestión de Productos</span>
  </nav>

  <div class="container">
    <h1 class="titulo">Módulo de Gestión</h1>

    <div class="table-container">
      <form action="agregar_producto.php" method="POST" class="row g-3 mb-4">
        <div class="col-md-4">
          <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="precio" class="form-control" placeholder="Precio" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="stock" class="form-control" placeholder="Stock" required>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-add w-100">Agregar</button>
        </div>
        
      </form>

      <table class="table table-dark table-hover text-center">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include 'conexion.php';
            $query = "SELECT * FROM productos";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
              echo "<tr>
                <form action='actualizar_producto.php' method='POST'>
                  <input type='hidden' name='id' value='{$row['id']}'>
                  <td><input type='text' name='nombre' class='form-control' value='{$row['nombre']}'></td>
                  <td><input type='number' name='precio' class='form-control' value='{$row['precio']}'></td>
                  <td><input type='number' name='stock' class='form-control' value='{$row['stock']}'></td>
                  <td>
                    <button type='submit' class='btn btn-update btn-sm'>Actualizar</button>
                  <a href=\"#\" 
   class=\"btn btn-delete btn-sm\"
   data-bs-toggle=\"modal\"
   data-bs-target=\"#confirmarEliminarModal\"
   onclick=\"setEliminarId({$row['id']})\">
   Eliminar
</a>

                    
                  </td>
                </form>
              </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
<!-- Aqui nosotros hicimos un Modal de Confirmación -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmarEliminarModalLabel">¿Estás seguro de que quieres eliminar este producto?</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        Esta acción eliminará el producto. ¿Deseas continuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnConfirmarEliminar" href="#" class="btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function setEliminarId(id) {
    document.getElementById('btnConfirmarEliminar').href = 'eliminar_producto.php?id=' + id;
  }
</script>


</body>
</html>


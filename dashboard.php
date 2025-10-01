<?php

include 'conexion.php';


// --- OBTENER DATOS REALES PARA LAS TARJETAS ---

// Consulta para el total de usuarios (asumiendo que tienes una tabla 'usuarios')
$queryUsuarios = "SELECT COUNT(id) AS total FROM usuarios";
$resultUsuarios = $conn->query($queryUsuarios);
$totalUsuarios = $resultUsuarios->fetch_assoc()['total'];

// Consulta para el total de productos
$queryProductos = "SELECT COUNT(id) AS total FROM productos";
$resultProductos = $conn->query($queryProductos);
$totalProductos = $resultProductos->fetch_assoc()['total'];

// Consulta para el total de pedidos (pagos)
$queryPedidos = "SELECT COUNT(id) AS total FROM pagos";
$resultPedidos = $conn->query($queryPedidos);
$totalPedidos = $resultPedidos->fetch_assoc()['total'];

// Consulta para ventas de hoy. CURDATE() obtiene la fecha actual.
$queryVentasHoy = "SELECT COUNT(id) AS total FROM pagos WHERE DATE(fecha_pago) = CURDATE()";
$resultVentasHoy = $conn->query($queryVentasHoy);
$ventasHoy = $resultVentasHoy->fetch_assoc()['total'];


// Suma la columna 'cantidad' de la tabla 'carritos'
$queryCarrito = "SELECT SUM(cantidad) AS total FROM carritos";
$resultCarrito = $conn->query($queryCarrito);
// Si no hay nada en los carritos, el total será NULL, así que lo convertimos a 0
$totalCarrito = $resultCarrito->fetch_assoc()['total'] ?? 0;

// --- OBTENER LISTAS DE ELEMENTOS RECIENTES ---

// Consulta para productos recientes (los últimos 5 añadidos)
$queryProductosRecientes = "SELECT nombre, precio, stock FROM productos ORDER BY id DESC LIMIT 5";
$resultProductosRecientes = $conn->query($queryProductosRecientes);
$productosRecientes = [];
while($row = $resultProductosRecientes->fetch_assoc()) {
    $productosRecientes[] = $row;
}

// Consulta para pedidos recientes (los últimos 5 pagos)
$queryPedidosRecientes = "SELECT id, nombre AS usuario, total FROM pagos ORDER BY id DESC LIMIT 5";
$resultPedidosRecientes = $conn->query($queryPedidosRecientes);
$pedidosRecientes = [];
while($row = $resultPedidosRecientes->fetch_assoc()) {
    // Añadimos un 'estado' de ejemplo, ya que no lo tienes en tu tabla 'pagos'
    $row['estado'] = 'completed'; 
    $pedidosRecientes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Demo - Glow Show Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Estilos completamente renovados para dashboard moderno */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffd8e4 0%, #ffb3d1 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(255, 105, 180, 0.2);
        }

        .sidebar-header h2 {
            color: #ff69b4;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .sidebar-header p {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .sidebar-nav {
            padding: 2rem 0;
        }

        .nav-item {
            display: block;
            padding: 1rem 2rem;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255, 105, 180, 0.1);
            border-left-color: #ff69b4;
            color: #ff1493;
        }

        .nav-item i {
            width: 20px;
            margin-right: 1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .dashboard-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-header h1 {
            color: #333;
            font-size: 2rem;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff69b4, #ff1493);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-icon.users { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-icon.products { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .stat-icon.orders { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .stat-icon.cart { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .stat-icon.sales { background: linear-gradient(135deg, #fa709a, #fee140); }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 105, 180, 0.1);
            background: rgba(255, 105, 180, 0.05);
        }

        .content-card-header h3 {
            color: #333;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .content-card-body {
            padding: 1.5rem 2rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .item-info h4 {
            color: #333;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .item-info p {
            color: #666;
            font-size: 0.85rem;
        }

        .item-value {
            font-weight: bold;
            color: #ff69b4;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-processing { background: #cce7ff; color: #004085; }

        .demo-banner {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 1rem 2rem;
            text-align: center;
            font-weight: 500;
            margin-bottom: 2rem;
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar de navegación moderna -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-gem"></i> Glow Show Up</h2>
                <p>Panel de Administración</p>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
                <a href="productos.php" class="nav-item">
                    <i class="fas fa-box"></i> Productos
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-shopping-cart"></i> Pedidos
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-chart-bar"></i> Reportes
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i> Configuración
                </a>
            </nav>
        </aside>

        <!-- Contenido principal mejorado -->
        <main class="main-content">
            <div class="demo-banner">
                <i class="fas fa-info-circle"></i> VERSIÓN DEMO - Dashboard sin autenticación para pruebas
            </div>
            
            <header class="dashboard-header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <div class="user-avatar">A</div>
                    <div>
                        <p><strong>Administrador Demo</strong></p>
                        <p style="font-size: 0.9rem; color: #666;">Admin</p>
                    </div>
                </div>
            </header>

            <!-- Grid de estadísticas mejorado -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number"><?php echo $totalUsuarios; ?></div>
                    <div class="stat-label">Usuarios Registrados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon products">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-number"><?php echo $totalProductos; ?></div>
                    <div class="stat-label">Productos en Catálogo</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orders">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-number"><?php echo $totalPedidos; ?></div>
                    <div class="stat-label">Pedidos Realizados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon cart">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-number"><?php echo $totalCarrito; ?></div>
                    <div class="stat-label">Productos en Carritos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon sales">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number"><?php echo $ventasHoy; ?></div>
                    <div class="stat-label">Ventas Hoy</div>
                </div>
            </div>

            <!-- Grid de contenido con productos y pedidos recientes -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="content-card-header">
                        <h3><i class="fas fa-box-open"></i> Productos Recientes</h3>
                    </div>
                    <div class="content-card-body">
                        <?php foreach($productosRecientes as $producto): ?>
                        <div class="list-item">
                            <div class="item-info">
                                <h4><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                                <p>Stock: <?php echo $producto['stock']; ?> unidades</p>
                            </div>
                            <div class="item-value">$<?php echo number_format($producto['precio'], 2); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="content-card">
                    <div class="content-card-header">
                        <h3><i class="fas fa-receipt"></i> Pedidos Recientes</h3>
                    </div>
                    <div class="content-card-body">
                        <?php foreach($pedidosRecientes as $pedido): ?>
                        <div class="list-item">
                            <div class="item-info">
                                <h4>Pedido #<?php echo $pedido['id']; ?></h4>
                                <p><?php echo htmlspecialchars($pedido['usuario']); ?></p>
                            </div>
                            <div style="text-align: right;">
                                <div class="item-value">$<?php echo number_format($pedido['total'], 2); ?></div>
                                <span class="status-badge status-<?php echo strtolower($pedido['estado']); ?>">
                                    <?php echo ucfirst($pedido['estado']); ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
// array de productos esté aquí
$productos = [
    [
        'nombre' => 'Camiseta Blanca',
        'precio' => 30000,
        'imagen' => 'https://images.unsplash.com/photo-1651761179569-4ba2aa054997?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
    ],
    [
        'nombre' => 'Hoodie Negro',
        'precio' => 95000,
        'imagen' => 'https://tse1.explicit.bing.net/th/id/OIP.dJ4CaN6ZoiBungcBejF59wHaIZ?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Camisa Casual',
        'precio' => 70000,
        'imagen' => 'https://www.camiseriainglesa.com.ec/wp-content/uploads/2024/10/DSC0362-1.jpg'
    ],
    [
        'nombre' => 'Pantalón Jean',
        'precio' => 89000,
        'imagen' => 'https://tse3.mm.bing.net/th/id/OIP.krKKlvmJ-n_DFPxP3bQ5ZQHaHa?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Chaqueta Denim',
        'precio' => 120000,
        'imagen' => 'https://tse2.mm.bing.net/th/id/OIP.ZrvEXlb4kKQ_7KdLKNSF4wHaLH?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Zapatillas Deportivas',
        'precio' => 150000,
        'imagen' => 'https://tse4.mm.bing.net/th/id/OIP.wqwEufidl9MOIHra1Gc-CgHaHa?w=1000&h=1000&rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Falda Larga',
        'precio' => 60000,
        'imagen' => 'https://tse3.mm.bing.net/th/id/OIP.wCRXQHyUJ6tnukBEq44GFQHaKU?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Buzo Oversize',
        'precio' => 80000,
        'imagen' => 'https://tse4.mm.bing.net/th/id/OIP.mXeqrNS3ICwuutbwfq6kQAHaKf?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Gorra Glow',
        'precio' => 25000,
        'imagen' => 'https://neweraec.vtexassets.com/arquivos/ids/189164/60655841_1.jpg?v=638725597236900000'
    ],
    [
        'nombre' => 'Short Deportivo',
        'precio' => 40000,
        'imagen' => 'https://tse1.mm.bing.net/th/id/OIP.RrnKuPaO7fSpcawusw8OxAHaF3?rs=1&pid=ImgDetMain&o=7&rm=3'
    ],
    [
        'nombre' => 'Vestido Casual',
        'precio' => 110000,
        'imagen' => 'https://i5.walmartimages.com/seo/Diufon-Cotton-Linen-Dresses-for-Women-Solid-Color-Lace-Up-Waist-Pleated-Dress-V-Neck-Short-Sleeve-Dress_0b723584-71da-4932-a893-10a32593812a.8c800809fcf6125f1cd5e0b7cd8eb043.jpeg'
    ],
    [
        'nombre' => 'Conjunto Glow',
        'precio' => 175000,
        'imagen' => 'https://content.stylitics.com/images/collage/7e2585c9a23c3d924531c352d8de84e545bd24114ef33c'
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos | Glow Show Up</title>
    <style>
        /* CSS GENERAL */
       body { 
    margin: 0; 
    font-family: 'Segoe UI', sans-serif;
    /* FONDO CON CAPA OSCURA SEMITRANSPARENTE */
    background: 
        linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('fondoproducto.png') no-repeat center center fixed;
    background-size: cover;
}
        header { background-color: #333; color: white; padding: 1rem; text-align: center; display: flex; justify-content: space-between; align-items: center; }
        header h1 { margin: 0; font-size: 1.5rem; }
        .volver { text-align: center; margin: 2rem; }
        .volver a { text-decoration: none; color: #333; font-weight: bold; }

        /* CSS DEL CATÁLOGO */
        .contenedor { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; padding: 2rem; }
        .producto { display: flex; flex-direction: column; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; }
        .producto img { width: 100%; height: 250px; object-fit: cover; }
        .producto .info { padding: 1rem; flex-grow: 1; }
        .producto h3 { margin: 0 0 0.5rem; font-size: 1.1rem; }
        .producto span { font-weight: bold; color: #444; }
        
        /* CSS DE LOS BOTONES */
        .producto .botones { display: flex; gap: 10px; padding: 0 1rem 1rem; }
        .producto button { flex: 1; padding: 10px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: transform 0.2s; }
        .producto button:hover { transform: scale(1.05); }
        .btn-agregar { background-color: #b472ff; color: white; }
        .btn-comprar { background-color: #333; color: white; }

        /* CSS DEL ÍCONO DE CARRITO Y NOTIFICACIÓN */
        #icono-carrito { position: relative; cursor: pointer; color: white; text-decoration: none; font-size: 1.5rem; }
        #contador-carrito { position: absolute; top: -8px; right: -8px; background-color: #b472ff; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; font-weight: bold; display: none; }
        #notificacion { display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: #333; color: white; padding: 15px 30px; border-radius: 10px; z-index: 2000; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    </style>
</head>
<body>
    <header>
        <h1>✨ Catálogo de Productos ✨</h1>
        <a href="Carrito.php" id="icono-carrito">
            🛒
            <span id="contador-carrito">0</span>
        </a>
    </header>

    <div class="contenedor" id="catalogo-productos">
        <?php
        $idCounter = 1;
        foreach ($productos as $producto) {
            echo '<div class="producto">';
            echo '  <img src="' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
            echo '  <div class="info">';
            echo '      <h3>' . htmlspecialchars($producto['nombre']) . '</h3>';
            echo '      <span>$' . number_format($producto['precio'], 0, ',', '.') . '</span>';
            echo '  </div>';
            echo '  <div class="botones">';
            echo '      <button class="btn-agregar" 
                              data-id="' . $idCounter . '" 
                              data-nombre="' . htmlspecialchars($producto['nombre']) . '" 
                              data-precio="' . $producto['precio'] . '">
                          Agregar
                      </button>';
            echo '      <button class="btn-comprar" 
                              data-id="' . $idCounter . '" 
                              data-nombre="' . htmlspecialchars($producto['nombre']) . '" 
                              data-precio="' . $producto['precio'] . '">
                          Comprar ahora
                      </button>';
            echo '  </div>';
            echo '</div>';
            $idCounter++;
        }
        ?>
    </div>
    
    <div id="notificacion">Producto añadido al carrito</div>

    <div class="volver">
        <a href="index.html">← Volver al inicio</a>
    </div>

    <script src="Carrito.js"></script>
</body>
</html>
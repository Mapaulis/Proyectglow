<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos | Glow Show Up</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
    }

    header {
      background-color: #333;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .contenedor {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      padding: 2rem;
    }

    .producto {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
      padding-bottom: 1rem;
    }

    .producto img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .producto h3 {
      margin: 1rem 0 0.5rem;
    }

    .producto span {
      font-weight: bold;
      color: #444;
    }

    .volver {
      text-align: center;
      margin: 2rem;
    }

    .volver a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <h1>✨ Catálogo de Productos ✨</h1>
  </header>

  <div class="contenedor">
    <!-- 12 productos -->
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?tshirt" alt="Camiseta">
      <h3>Camiseta Blanca</h3>
      <span>$30.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?hoodie" alt="Hoodie">
      <h3>Hoodie Negro</h3>
      <span>$95.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?shirt" alt="Camisa">
      <h3>Camisa Casual</h3>
      <span>$70.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?jeans" alt="Jean">
      <h3>Pantalón Jean</h3>
      <span>$89.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?jacket" alt="Chaqueta">
      <h3>Chaqueta Denim</h3>
      <span>$120.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?sneakers" alt="Zapatos">
      <h3>Zapatillas Deportivas</h3>
      <span>$150.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?skirt" alt="Falda">
      <h3>Falda Larga</h3>
      <span>$60.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?sweater" alt="Buzo">
      <h3>Buzo Oversize</h3>
      <span>$80.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?hat" alt="Gorra">
      <h3>Gorra Glow</h3>
      <span>$25.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?shorts" alt="Shorts">
      <h3>Short Deportivo</h3>
      <span>$40.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?dress" alt="Vestido">
      <h3>Vestido Casual</h3>
      <span>$110.000</span>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?clothes" alt="Conjunto">
      <h3>Conjunto Glow</h3>
      <span>$135.000</span>
    </div>
  </div>

  <div class="volver">
    <a href="index.html">← Volver al inicio</a>
  </div>
</body>
</html>

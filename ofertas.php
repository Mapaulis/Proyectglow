<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ofertas | Glow Show Up</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff0f6;
    }

    header {
      background-color: #b472ff;
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

    .producto p {
      margin: 0.5rem 0;
      font-weight: bold;
      color: #e60073;
    }

    .volver {
      text-align: center;
      margin: 2rem;
    }

    .volver a {
      text-decoration: none;
      color: #b472ff;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <h1>🔥 OFERTAS EXCLUSIVAS 🔥</h1>
    <p>Aprovecha nuestros descuentos por tiempo limitado</p>
  </header>

  <div class="contenedor">
    <!-- 12 productos con descuento -->
    <!-- Reutilizando imágenes genéricas de ropa desde Unsplash -->
    <!-- Solo se cambia el título y el precio para simular variedad -->
    <!-- Puedes reemplazar imágenes por otras si lo deseas -->
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?tshirt" alt="Camiseta">
      <h3>Camiseta Básica</h3>
      <p>Antes: $60.000<br>Ahora: $35.000</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?hoodie" alt="Hoodie">
      <h3>Hoodie Oversize</h3>
      <p>Antes: $120.000<br>Ahora: $79.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?jeans" alt="Jean">
      <h3>Jean Glow</h3>
      <p>Antes: $110.000<br>Ahora: $69.000</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?jacket" alt="Chaqueta">
      <h3>Chaqueta Denim</h3>
      <p>Antes: $180.000<br>Ahora: $99.000</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?dress" alt="Vestido">
      <h3>Vestido Rosa</h3>
      <p>Antes: $150.000<br>Ahora: $99.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?sweater" alt="Suéter">
      <h3>Suéter Casual</h3>
      <p>Antes: $85.000<br>Ahora: $59.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?pants" alt="Pantalón">
      <h3>Pantalón Casual</h3>
      <p>Antes: $100.000<br>Ahora: $64.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?skirt" alt="Falda">
      <h3>Falda Larga</h3>
      <p>Antes: $60.000<br>Ahora: $39.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?shoes" alt="Zapatos">
      <h3>Zapatos Glow</h3>
      <p>Antes: $200.000<br>Ahora: $129.000</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?shirt" alt="Camisa">
      <h3>Camisa a rayas</h3>
      <p>Antes: $75.000<br>Ahora: $49.900</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?shorts" alt="Short">
      <h3>Short Deportivo</h3>
      <p>Antes: $45.000<br>Ahora: $29.000</p>
    </div>
    <div class="producto">
      <img src="https://source.unsplash.com/250x250/?clothing" alt="Conjunto">
      <h3>Conjunto Glow</h3>
      <p>Antes: $160.000<br>Ahora: $119.000</p>
    </div>
  </div>

  <div class="volver">
    <a href="index.html">← Volver al inicio</a>
  </div>
</body>
</html>

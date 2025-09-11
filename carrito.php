<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carrito de Compras</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f4f4;
      background: 
    linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.4)), 
    url('imagenes/fondocarrito.png') no-repeat center center fixed;
      color: #333;
    }
    

    .cart-container {
      max-width: 900px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #ddd;
      padding: 20px 0;
    }

    .cart-item img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }

    .item-info {
      flex: 2;
      margin-left: 20px;
    }

    .item-info h4 {
      margin: 0;
      font-size: 18px;
    }

    .item-info p {
      margin: 5px 0;
      color: #888;
    }

    .quantity-controls {
      display: flex;
      align-items: center;
    }

    .quantity-controls button {
      width: 30px;
      height: 30px;
      background: #eee;
      border: none;
      border-radius: 50%;
      font-size: 18px;
      cursor: pointer;
    }

    .quantity-controls span {
      margin: 0 10px;
      font-size: 16px;
    }

    .price {
      font-weight: bold;
      font-size: 18px;
    }

    .remove-btn {
      background: transparent;
      border: none;
      color: #e74c3c;
      font-size: 20px;
      cursor: pointer;
      margin-left: 10px;
    }

    .total {
      text-align: right;
      font-size: 22px;
      margin-top: 30px;
    }

    .checkout-btn {
      margin-top: 20px;
      width: 100%;
      background: #111;
      color: white;
      padding: 15px;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .checkout-btn:hover {
      background: #333;
    }
  </style>
</head>
<body>
  <div class="cart-container">
    <h2>Tu carrito</h2>

    <div class="cart-item" data-price="150000">
      <img src="imagenes/camisamujer.jpg" alt="Producto">
      <div class="item-info">
        <h4>Blusa Glow</h4>
        <p>Talla M</p>
      </div>
      <div class="quantity-controls">
        <button onclick="decrease(this)">−</button>
        <span>1</span>
        <button onclick="increase(this)">+</button>
      </div>
      <div class="price">$80.000</div>
      <button class="remove-btn" onclick="removeItem(this)">✕</button>
    </div>

    
    <div class="cart-item" data-price="150000">
      <img src="imagenes/pantalon.jpg" alt="Producto">
      <div class="item-info">
        <h4>Pantalon Verde</h4>
        <p>Talla 32</p>
      </div>
      <div class="quantity-controls">
        <button onclick="decrease(this)">−</button>
        <span>1</span>
        <button onclick="increase(this)">+</button>
      </div>
      <div class="price">$180.000</div>
      <button class="remove-btn" onclick="removeItem(this)">✕</button>
    </div>

    
    <div class="cart-item" data-price="150000">
      <img src="imagenes/tennis.jpg" alt="Producto">
      <div class="item-info">
        <h4>Tennis 098</h4>
        <p>Talla 35</p>
      </div>
      <div class="quantity-controls">
        <button onclick="decrease(this)">−</button>
        <span>1</span>
        <button onclick="increase(this)">+</button>
      </div>
      <div class="price">$120.000</div>
      <button class="remove-btn" onclick="removeItem(this)">✕</button>
    </div>

    <div class="total">
      Total: <span id="total">$150.000</span>
    </div>

    <a href="pago.html" class="checkout-btn">Proceder al pago</a>

  </div>

  <script>
    function updateTotal() {
      let total = 0;
      document.querySelectorAll(".cart-item").forEach(item => {
        const price = parseInt(item.dataset.price);
        const quantity = parseInt(item.querySelector("span").innerText);
        total += price * quantity;
      });
      document.getElementById("total").textContent = `$${total.toLocaleString("es-CO")}`;
    }

    function increase(btn) {
      const span = btn.previousElementSibling;
      span.innerText = parseInt(span.innerText) + 1;
      updateTotal();
    }

    function decrease(btn) {
      const span = btn.nextElementSibling;
      let count = parseInt(span.innerText);
      if (count > 1) {
        span.innerText = count - 1;
        updateTotal();
      }
    }

    function removeItem(btn) {
      const item = btn.closest(".cart-item");
      item.remove();
      updateTotal();
    }
  </script>
</body>
</html>

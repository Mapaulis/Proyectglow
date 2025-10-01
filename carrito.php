<?php
// Espacio para lógica de servidor en el futuro
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Carrito de Compras | Glow Show Up</title>
    <style>
        /* Tu excelente CSS se mantiene igual */
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f4; background: linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.4)), url('imagenes/fondocarrito.png') no-repeat center center fixed; color: #333; background-size: cover; }
        .cart-container { max-width: 900px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 30px; font-size: 28px; }
        .cart-item { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #ddd; padding: 20px 0; }
        .cart-item img { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; }
        .item-info { flex: 2; margin-left: 20px; }
        .item-info h4 { margin: 0; font-size: 18px; }
        .item-info p { margin: 5px 0; color: #888; }
        .quantity-controls { display: flex; align-items: center; }
        .quantity-controls button { width: 30px; height: 30px; background: #eee; border: none; border-radius: 50%; font-size: 18px; cursor: pointer; }
        .quantity-controls span { margin: 0 10px; font-size: 16px; }
        .price { font-weight: bold; font-size: 18px; min-width: 100px; text-align: right; }
        .remove-btn { background: transparent; border: none; color: #e74c3c; font-size: 20px; cursor: pointer; margin-left: 20px; }
        .total { text-align: right; font-size: 22px; margin-top: 30px; }
        .acciones { display: flex; justify-content: space-between; margin-top: 2rem; }
        .btn { padding: 12px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; border: none; cursor: pointer; font-size: 16px; }
        .btn-pagar { background-color: #111; color: white; }
        .btn-seguir { background-color: #eee; color: #333; }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>Tu carrito</h2>

        <div id="cart-items-container"></div>
        
        <div id="cart-empty-message" style="display: none; text-align: center; padding: 40px;">
            <p>Tu carrito está vacío.</p>
        </div>

        <div class="total">
            Total: <span id="total-price">$0</span>
        </div>
        
        <div class="acciones">
            <a href="productx.php" class="btn btn-seguir">← Seguir comprando</a>
            <a href="PFormulario.html" id="btn-pagar" class="btn btn-pagar">Proceder al pago</a>
        </div>
    </div>

   <script>
    const cartItemsContainer = document.getElementById('cart-items-container');
    const totalPriceElement = document.getElementById('total-price');
    const emptyCartMessage = document.getElementById('cart-empty-message');
    const checkoutButton = document.getElementById('btn-pagar');
    
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // --- NEW: Function to communicate with the database ---
    async function sincronizarCarritoConDB() {
        try {
            await fetch('actualizar_carrito_db.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ carrito: carrito }),
            });
            console.log("Cart synchronized with the database.");
        } catch (error) {
            console.error('Error synchronizing:', error);
        }
    }

    // --- KEY FUNCTION to save changes locally AND to the database ---
    function saveCartAndReload() {
        // Save to the browser's memory
        localStorage.setItem('carrito', JSON.stringify(carrito));
        const total = carrito.reduce((sum, producto) => sum + (producto.precio * producto.cantidad), 0);
        localStorage.setItem('totalCompra', total);
        
        // Notify the database of the changes
        sincronizarCarritoConDB();
        
        // Update the view
        renderCart();
    }

    function renderCart() {
        cartItemsContainer.innerHTML = ''; 

        if (carrito.length === 0) {
            emptyCartMessage.style.display = 'block';
            checkoutButton.style.display = 'none';
            totalPriceElement.parentElement.style.display = 'none';
        } else {
            emptyCartMessage.style.display = 'none';
            checkoutButton.style.display = 'block';
            totalPriceElement.parentElement.style.display = 'block';

            carrito.forEach(producto => {
                const itemHTML = `
                    <div class="cart-item" data-id="${producto.id}">
                        <img src="${producto.imagen}" alt="${producto.nombre}">
                        <div class="item-info">
                            <h4>${producto.nombre}</h4>
                        </div>
                        <div class="quantity-controls">
                            <button onclick="decreaseQuantity('${producto.id}')">−</button>
                            <span>${producto.cantidad}</span>
                            <button onclick="increaseQuantity('${producto.id}')">+</button>
                        </div>
                        <div class="price">$${(producto.precio * producto.cantidad).toLocaleString('es-CO')}</div>
                        <button class="remove-btn" onclick="removeItem('${producto.id}')">✕</button>
                    </div>
                `;
                cartItemsContainer.innerHTML += itemHTML;
            });
        }
        updateTotal();
    }

    function updateTotal() {
        const total = carrito.reduce((sum, producto) => sum + (producto.precio * producto.cantidad), 0);
        totalPriceElement.textContent = `$${total.toLocaleString("es-CO")}`;
    }

    // --- CORRECTED INTERACTIVE FUNCTIONS ---
    // We attach them to the 'window' object to make them globally accessible
    window.increaseQuantity = function(productId) {
        const producto = carrito.find(p => p.id === productId);
        if (producto) {
            producto.cantidad++;
            saveCartAndReload();
        }
    }

    window.decreaseQuantity = function(productId) {
        const producto = carrito.find(p => p.id === productId);
        if (producto && producto.cantidad > 1) {
            producto.cantidad--;
        } else if (producto) {
            carrito = carrito.filter(p => p.id !== productId);
        }
        saveCartAndReload();
    }

    window.removeItem = function(productId) {
        carrito = carrito.filter(p => p.id !== productId);
        saveCartAndReload();
    }

    // Initial cart load
    renderCart();
</script>
</body>
</html>
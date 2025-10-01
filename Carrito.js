// carrito.js (with Database Sync)

document.addEventListener('DOMContentLoaded', () => {
    
    const catalogo = document.getElementById('catalogo-productos');
    const contadorCarrito = document.getElementById('contador-carrito');
    const notificacion = document.getElementById('notificacion');

    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // --- NEW: Function to send cart data to the server ---
    async function sincronizarCarritoConDB() {
        try {
            await fetch('actualizar_carrito_db.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ carrito: carrito }),
            });
        } catch (error) {
            console.error('Error al sincronizar el carrito:', error);
        }
    }

    function guardarCarrito() {
        localStorage.setItem('carrito', JSON.stringify(carrito));
        actualizarTotalYGuardar();
        sincronizarCarritoConDB(); // Sync with DB every time the cart is saved
    }
    
    function actualizarTotalYGuardar() {
        const total = carrito.reduce((sum, producto) => sum + (producto.precio * producto.cantidad), 0);
        localStorage.setItem('totalCompra', total);
        actualizarContador();
    }

    function actualizarContador() {
        const totalItems = carrito.reduce((sum, producto) => sum + producto.cantidad, 0);
        contadorCarrito.textContent = totalItems;
        contadorCarrito.style.display = totalItems > 0 ? 'block' : 'none';
    }

    function mostrarNotificacion() {
        notificacion.style.display = 'block';
        setTimeout(() => {
            notificacion.style.display = 'none';
        }, 2000);
    }

    function agregarAlCarrito(productoNuevo) {
        const productoExistente = carrito.find(p => p.id === productoNuevo.id);
        if (productoExistente) {
            productoExistente.cantidad++;
        } else {
            productoNuevo.cantidad = 1;
            carrito.push(productoNuevo);
        }
        guardarCarrito();
        mostrarNotificacion();
    }

    catalogo.addEventListener('click', e => {
        if (e.target.classList.contains('btn-agregar')) {
            const producto = obtenerDatosProducto(e.target);
            agregarAlCarrito(producto);
        }
        if (e.target.classList.contains('btn-comprar')) {
            const producto = obtenerDatosProducto(e.target);
            producto.cantidad = 1;
            carrito = [producto];
            guardarCarrito();
            window.location.href = 'PFormulario.html';
        }
    });

    function obtenerDatosProducto(boton) {
        return {
            id: boton.dataset.id,
            nombre: boton.dataset.nombre,
            precio: parseFloat(boton.dataset.precio),
            imagen: boton.closest('.producto').querySelector('img').src
        };
    }

    actualizarTotalYGuardar();
});
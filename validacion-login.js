document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('form[action="login.php"]');
  form.addEventListener('submit', function(event) {
    let errores = [];
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    // Validar Email
    if (email === '') {
      errores.push('El correo electrónico es obligatorio.');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      errores.push('El formato del correo electrónico no es válido.');
    }

    // Validar Contraseña
    if (password === '') {
      errores.push('La contraseña es obligatoria.');
    } else if (password.length < 6) {
      errores.push('La contraseña debe tener al menos 6 caracteres.');
    }

    // Mostrar errores o permitir envío
    document.querySelectorAll('.error-validacion-login').forEach(e => e.remove());
    if (errores.length > 0) {
      event.preventDefault();
      const errorDiv = document.createElement('div');
      errorDiv.className = 'error error-validacion-login';
      errorDiv.innerHTML = errores.map(e => `<div>${e}</div>`).join('');
      form.insertBefore(errorDiv, form.firstChild);
    }
  });
});
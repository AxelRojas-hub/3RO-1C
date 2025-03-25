document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', validateRegisterForm);
});

function validateRegisterForm(e) {
    const nombre = document.getElementById('nombre_completo').value.trim();
    const email = document.getElementById('correo').value.trim();

    if (!nombre || !email) {
        e.preventDefault(); // Evita que se envíe el formulario
        alert('Por favor, complete todos los campos obligatorios.');
    }
}

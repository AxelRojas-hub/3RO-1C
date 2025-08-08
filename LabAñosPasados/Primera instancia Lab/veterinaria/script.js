document.getElementById('tipoServicio').addEventListener('change', function() {
    var tipoServicio = this.value;
    var camposExtras = document.getElementById('camposExtras');

    // Limpiar campos extras
    camposExtras.innerHTML = '';

    // Mostrar campos extras dependiendo del tipo de servicio seleccionado
    if (tipoServicio === 'limpiezaAcuario') {
        camposExtras.innerHTML = `
            <label for="dimensiones">Dimensiones del Acuario (alto x ancho):</label>
            <input type="text" id="dimensiones" name="dimensiones" placeholder="Alto x Ancho">
            <label for="cantidadPeces">Cantidad Aproximada de Peces:</label>
            <input type="number" id="cantidadPeces" name="cantidadPeces" min="1">
            <label for="direccionAcuario">Dirección del Acuario:</label>
            <input type="text" id="direccionAcuario" name="direccionAcuario" placeholder="Dirección del Acuario">
        `;
    } else if (tipoServicio !== 'peluqueria' && tipoServicio !== 'bano') {
        camposExtras.innerHTML = `
            <label for="cantidadAnimales">Cantidad de Animales:</label>
            <input type="number" id="cantidadAnimales" name="cantidadAnimales" min="1">
            <label for="raza">Raza:</label>
            <input type="text" id="raza" name="raza">
            <label for="pesoAproximado">Peso Aproximado (Kg):</label>
            <input type="number" id="pesoAproximado" name="pesoAproximado" min="1">
            <label for="esAgresivo">¿Es Agresivo?</label>
            <select id="esAgresivo" name="esAgresivo">
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>
            <label for="esCliente">¿Es Cliente de la Veterinaria?</label>
            <select id="esCliente" name="esCliente">
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>
        `;
    }
});

document.getElementById('cotizacionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Aquí puedes agregar la lógica para calcular la cotización y mostrar el resultado
    var resultado = document.getElementById('resultado');
    resultado.innerHTML = '<p>Cotización enviada con éxito.</p>';
    this.reset(); // Limpiar el formulario después de enviar la cotización
});

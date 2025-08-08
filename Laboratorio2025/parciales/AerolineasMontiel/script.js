function buscarModelo() {
    let nombreReducido = document.getElementById("input_modelos").value;

    let xhr = new XMLHttpRequest();

    xhr.open("GET", "buscarModelo.php?nombreReducido=" + nombreReducido, true);

    xhr.onreadystatechange = function () {
        let span = document.getElementById("id_span");
        let detalle = document.getElementById("contenedor-detalle");
        let tabla = document.getElementById("id_table");
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(JSON.parse(xhr.responseText));
            const datos = JSON.parse(xhr.responseText);
            const avion = datos[0];
            if (datos !== "No hay datos") {
                const nombre = avion.nombre;
                const fabricante = avion.fabricante;

                detalle.innerHTML = `<h3>Detalle Avion</h3>
                                    <p>Nombre Completo: ${nombre}</p>
                                    <p>Fabricante: ${fabricante}</p>`;

                tabla.innerHTML = "";
                tabla.innerHTML = `<tr><th>Matricula</th><th>Fecha de ingreso</th><th>Capacidad</th><th>Distribucion</th></tr>`
                for (const avion of datos) {
                    let fila = document.createElement("tr");
                    fila.innerHTML = `<td>${avion.matricula}</td>
                                        <td>${avion.fechaIngreso}</td>
                                        <td>${avion.capacidad}</td>
                                        <td>${avion.distribucion}</td>`;
                    tabla.appendChild(fila);
                }
            }
        }
    }

    xhr.send(null);
}
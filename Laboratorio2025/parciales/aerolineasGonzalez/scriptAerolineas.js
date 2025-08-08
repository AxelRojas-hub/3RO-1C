function comprobarExistenciaAvion() {
    let cade = document.getElementById("idIngresoAeronave").value;
    //document.getElementById("mensajeInput").textContent = cade;
    let peticion = new XMLHttpRequest();
    peticion.open("GET", "conexionBD.php?cade=" + cade, true);
    peticion.onreadystatechange = validarInput;

    function validarInput() {
        if ((peticion.readyState == 4) && (peticion.status == 200)) {
            // console.log('Response Text', peticion.responseText);
            let objeto = JSON.parse(peticion.responseText);
            const tabla = document.getElementById('tbody');
            //Aca limpias la tabla para que no se apilen
            tabla.innerHTML = "";
            if (objeto.modelo == "Modelo No Econtrado") {
                document.getElementById("mensajeInput").textContent = "Modelo No Valido";
            }
            else {
                let Avion = objeto[0];
                if (Avion) {
                    document.getElementById("mensajeInput").textContent = "Modelo Valido";
                    let elemento1 = document.createElement("li");
                    let elemento2 = document.createElement("li");
                    elemento1.textContent = "Nombre Completo = " + Avion.nombre;
                    elemento2.textContent = "Fabricante = " + Avion.fabricante
                    //Aca limpias el inner html para que no se repitan los li
                    document.getElementById("infoAvion").innerHTML = "";
                    document.getElementById("infoAvion").appendChild(elemento1);
                    document.getElementById("infoAvion").appendChild(elemento2);
                    for (let i of objeto) {
                        console.log(i)
                        let fila = document.createElement("tr");
                        let matriculaEl = document.createElement("td");
                        matriculaEl.textContent = i.matricula;
                        let ingresoEl = document.createElement("td");
                        ingresoEl.textContent = i.fechaIngreso;
                        let capacidadEl = document.createElement("td");
                        capacidadEl.textContent = i.capacidad;
                        let distribucionEl = document.createElement("td");
                        distribucionEl.textContent = i.distribucion;
                        fila.appendChild(matriculaEl)
                        fila.appendChild(ingresoEl)
                        fila.appendChild(capacidadEl)
                        fila.appendChild(distribucionEl)
                        tabla.appendChild(fila);
                    }
                }
                else {
                    console.log("else");
                }
            }
        }
    }
    peticion.send(null);
}
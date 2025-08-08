function getPlaneData() {
    let modeloAvion = document.getElementById("modeloAvion").value;
    let req = new XMLHttpRequest();
    req.open("GET", "procesa.php?modeloAvion=" + modeloAvion, true);
    req.onreadystatechange = () => {
        //Esto si sale todo bien
        if ((req.readyState === 4) && (req.status === 200)) {
            // console.log(req.responseText);
            const obj = JSON.parse(req.responseText);
            const avion = obj.flota[0];
            //Parsear la data que viene segun necesite
            // Mostrar la info en el dom
            if (avion) {
                const { nombre, fabricante } = avion;
                const status = document.getElementById('statusSpan')
                status.innerText = "Modelo valido";
                status.style.color = "green";
                document.getElementById('spanNombre').innerText = nombre;
                document.getElementById('spanFabricante').innerText = fabricante;
            } else {
                const status = document.getElementById('statusSpan')
                status.innerText = "Modelo no valido";
                status.style.color = "red";
            }
            const tablaEl = document.getElementById('bodyTabla');
            tablaEl.innerHTML = '';
            for (const avion of obj.flota) {
                const el = document.createElement('tr');
                el.innerHTML = `<td>${avion.matricula}</td>
                <td>${avion.fechaIngreso}</td>
                <td>${avion.capacidad}</td>
                <td>${avion.distribucion}</td>
                `
                tablaEl.appendChild(el);
            }



        }
    };
    req.send(null);
}
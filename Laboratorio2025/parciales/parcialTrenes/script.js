function getDestinos() {
    const optionEl = document.getElementById('filtro1');
    const req = new XMLHttpRequest();
    req.open("post", 'destinos.php', true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const obj = JSON.parse(req.responseText);
            const select = document.getElementById('filtro2');
            //Cuando cambia pongo el select con la opcion por defecto
            select.innerHTML = "<option value='-1' selected>Seleccióna tu destino</option>";
            const tabla = document.getElementById('mainTbody');
            tabla.innerHTML = "";
            //Agrega todos los destinos al select
            //CHECKEAR QUE NO SE REPITA QUE LO HAGA DIOS
            //Hay una forma que es hacer un Set desde el array, en el Set no se repiten valores
            //A partir de ahi, se puede volver a crear el array con Array.from()
            for (const destino of obj.destinos) {
                let optionEl = document.createElement('option');
                optionEl.value = destino;
                optionEl.textContent = destino;
                select.appendChild(optionEl);
            }
            //Agrega todos las empresas al primer container
            for (const empresa of obj.empresas) {
                let rowEl = document.createElement('tr');
                let destino = obj.destinos.shift();
                rowEl.addEventListener('click', () => { getDetalle(empresa.nombreEmpresa, obj.origen, destino) });
                rowEl.innerHTML = `
                <td><img src="${empresa.logoEmpresa}" class="logoEmpresa"></td>
                <td>${empresa.nombreEmpresa}</td>
                <td>${obj.origen}</td>
                <td class="tdDestino">${destino}</td>
                `;
                tabla.appendChild(rowEl);
            }
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("origen=" + optionEl.value);
}
function getDetalle(empresa, origen, destino) {
    const req = new XMLHttpRequest();
    req.open("post", 'detalle.php', true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const obj = JSON.parse(req.responseText)
            //Mostrar en el segundo container
            const { nroServicio, estacionOrigenServicio, estacionDestinoServicio, horaSalidaServicio, horaLlegadaServicio, precioServicio, frecuenciaServicio } = obj;
            document.getElementById('nroServicio').textContent = nroServicio;
            document.getElementById('estacionOrigen').textContent = estacionOrigenServicio;
            document.getElementById('estacionDestino').textContent = estacionDestinoServicio;
            document.getElementById('horaSalida').textContent = horaSalidaServicio;
            document.getElementById('horaLlegada').textContent = horaLlegadaServicio;
            document.getElementById('frecuencia').textContent = frecuenciaServicio;
            document.getElementById('precioTicket').textContent = precioServicio;

        }
    };
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(`empresa=${empresa}&origen=${origen}&destino=${destino}`);
}
function getServicios() {
    const selectedOption = document.getElementById('filtro2');
    const val = selectedOption.value;
    const tbody = document.getElementById('mainTbody');
    const tds = tbody.querySelectorAll('.tdDestino');
    const arrayTds = Array.from(tds);
    //Si val es -1, es la opcion por defecto
    if (val !== '-1') {
        arrayTds.forEach((el) => {
            if (el.textContent != val) {
                el.parentElement.style.display = "none";
            } else {
                el.parentElement.removeAttribute("style");
            }
        })
    } else {
        arrayTds.forEach((el) => {
            el.parentElement.removeAttribute('style')
        })
    }
}
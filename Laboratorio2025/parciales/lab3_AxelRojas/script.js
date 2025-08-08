function getProductsByType() {
    const val = document.getElementById('filtro1').value;
    const val2doFiltro = document.getElementById('filtro1').value;
    //Si selecciona la opcion por defecto, limpia la tabla y vuelve
    if (val == "-1") {
        let tabla = document.getElementById('mainTbody');
        tabla.innerHTML = "";
        let tabla2 = document.getElementById('secTbody');
        tabla2.innerHTML = "";
        document.getElementById('priceDiff').textContent = "";
        document.getElementById('masBarato').textContent = "";
        document.getElementById('masCaro').textContent = "";
        return;
    }

    const req = new XMLHttpRequest();
    const tabla = document.getElementById('mainTbody');
    tabla.innerHTML = "";
    req.open("post", "products.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const obj = JSON.parse(req.responseText);
            for (const supermercado of obj.supermercados) {
                const tr = document.createElement('tr');
                // AGREGAR DESPUES
                tr.addEventListener('click', () => {
                    getDetail(supermercado.nombreProducto)
                })
                tr.innerHTML = `
                <td>${supermercado.nombreProducto}</td>
                <td>${supermercado.precio}</td>
                <td>${supermercado.nombreSuper}</td>
                <td>${supermercado.ubicacion}</td>
                `
                tabla.appendChild(tr);
            }
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(`productId=${val}`);
}
function getProductsByLocation() {
    const val = document.getElementById('filtro2').value;
    const idProducto = document.getElementById('filtro1').value;
    //Si selecciona la opcion por defecto, vuelvo a ejecutar la consulta del filtro anterior
    if (val == "-1") {
        getProductsByType();
        return;
    }
    const tabla = document.getElementById('mainTbody');
    tabla.innerHTML = "";
    //Request
    const req = new XMLHttpRequest();
    req.open("post", "products.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const obj = JSON.parse(req.responseText);
            for (const supermercado of obj.supermercados) {
                const tr = document.createElement('tr');
                // AGREGAR DESPUES
                tr.addEventListener('click', () => { getDetail(supermercado.nombreProducto) })
                tr.innerHTML = `
                <td>${supermercado.nombreProducto}</td>
                <td>${supermercado.precio}</td>
                <td>${supermercado.nombreSuper}</td>
                <td>${supermercado.ubicacion}</td>
                `
                tabla.appendChild(tr);
            }
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //Si no tengo id de producto, hago la peticion solo con la ubicacion
    //Si el id de prod es distinto de -1, hago la consulta con los dos filtros
    if (idProducto == '-1') {
        req.send(`ubicacion=${val}`);
    } else {
        req.send(`ubicacion=${val}&productId=${idProducto}`);
    }
}
function getDetail(nombreProd) {
    const tabla = document.getElementById('secTbody');

    const req = new XMLHttpRequest();
    req.open("post", "detailProducts.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const obj = JSON.parse(req.responseText);
            tabla.innerHTML = "";
            const [elemMasBarato, elemMasCaro] = maximaDiferencia(obj.supermercados);
            document.getElementById('priceDiff').textContent = elemMasCaro.precio - elemMasBarato.precio;
            document.getElementById('masCaro').textContent = elemMasCaro.nombreSuper;
            document.getElementById('masBarato').textContent = elemMasBarato.nombreSuper;
            for (const supermercado of obj.supermercados) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${supermercado.nombreSuper}</td>
                <td>${supermercado.precio}</td>
                <td>${supermercado.ubicacion}</td>
                `
                tabla.appendChild(tr);
            }
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(`productName=${nombreProd}`);
}
function maximaDiferencia(arrSupermercados) {
    //Ordeno el arreglo por precio
    //Saco el primero y el ultimo y calculo la diferencia
    const sortedArray = arrSupermercados.sort((a, b) => parseFloat(a.precio) - parseFloat(b.precio))
    const primerElemento = sortedArray[0];
    //Vuelvo a meter el elemento al final con .push
    const ultimoElemento = sortedArray.pop();
    sortedArray.push(ultimoElemento);
    return [primerElemento, ultimoElemento];
}
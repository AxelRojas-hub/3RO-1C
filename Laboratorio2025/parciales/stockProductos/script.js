const getProductStock = () => {
    const id = document.getElementById('selectProducto').value;
    const req = new XMLHttpRequest();
    req.open("POST", "./procesa.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            const data = JSON.parse(req.responseText);
            const tbody = document.getElementById("tbody");
            tbody.innerHTML = '';
            const { nombreProducto, proveedor } = data[0];
            document.getElementById('productName').innerText = "Nombre Producto: " + nombreProducto
            document.getElementById('proveedor').innerText = "Proveedor: " + proveedor;
            //Agrego toda la info de la consulta a la tabla
            for (const row of data) {
                const rowEl = document.createElement('tr');
                rowEl.innerHTML = `
                <td>${row.sucursal}</td>
                <td class="stockActual">${row.cantidad}</td>
                <td>
                <label>
                <input type="number" name="inputCantidad">
                <button type="button" class="editBtn" onClick=updateStock(event,${id})>Actualizar ✏️</button>
                </label>
                </td>
                `;
                tbody.appendChild(rowEl);
            }
            document.getElementById('stockTotal').innerText = getStockTotal();
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(`id=${id}`);
}
function updateStock(event, id) {
    //Como lo dispara el boton, el previous es el input
    const inputElement = event.target.previousElementSibling
    const labelEl = inputElement.parentNode;
    //Aca tengo el TD de Cantidad
    const tdEl = labelEl.parentNode;
    const stockEl = tdEl.previousElementSibling;
    const sucursal = stockEl.previousElementSibling;
    const stockValue = parseInt(stockEl.textContent);

    const req = new XMLHttpRequest();
    req.open("POST", "./update.php", true);
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            console.log("Todo ok", req.responseText);
            stockEl.textContent = inputElement.value;
        }
    }
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("stock=" + inputElement.value + "&sucursal=" + sucursal + "&idProducto=" + id);
}
function getStockTotal() {
    const stocks = document.querySelectorAll('.stockActual');
    let suma = 0;
    for (const stock of stocks) {
        suma = suma + parseInt(stock.textContent);
    }
    return suma;
}
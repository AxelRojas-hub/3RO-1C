<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock de productos</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
</head>

<body>
    <section>
        <select name="producto" id="selectProducto" onchange="getProductStock()">
            <option value="-1" disabled selected>Selecciona un producto</option>
            <?php
            $con = new mysqli("localhost", "root", "", "computacion");
            $query = "SELECT nombreProducto, codigo FROM producto";
            $res = $con->query($query);
            while ($reg = $res->fetch_object()) {
                echo "<option value='$reg->codigo'>$reg->nombreProducto</option>";
            }
            ?>
        </select>
        <div class="detail">
            <h3>Datos del producto</h3>
            <p id="productName">Nombre Producto:</p>
            <p id="proveedor">Proveedor</p>
            <p>Total producto en stock: <span id="stockTotal"></span></p>
        </div>
        <table border="white">
            <thead>
                <th>Sucursal</th>
                <th>Stock Actual</th>
                <th width="60%">Cantidad</th>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </section>
</body>

</html>
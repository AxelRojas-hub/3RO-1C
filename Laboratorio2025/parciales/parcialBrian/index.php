<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="./scritp.js" defer></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <label for="">Filtro Producto</label>
    <input type="text" id="idproductoSuggester" onkeyup="doble_filtrado();">
    <!-- onkeyup="busco_producto(); -->

    <br>
    <br>
    <select name="" id="idubicaciones" onchange="doble_filtrado()">
        <!-- get_productos(); -->
        <option value="">Por defecto</option>
        <?php
        $con = new mysqli("localhost", "root", "", "comparador");
        $sql = "SELECT DISTINCT ubicacion FROM supermercado";
        $result = $con->query($sql);
        while ($row = $result->fetch_object()) {
            echo "<option value='$row->ubicacion'>$row->ubicacion</option>";
        }

        ?>
    </select>
    <section>
        <table border="black" width="100%" textColor="#000">
            <thead>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Supermercado</th>
                <th>Ubicacion</th>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
    </section>
    <section>
        <table border="black" width="100%" textColor="#000">
            <thead>
                <th>Supermercado</th>
                <th>Precio</th>
                <th>Ubicacion</th>
            </thead>
            <p class="priceDiff">Maxima diferencia de precios: <span id="priceDiff"></span></p>
            <p>Mas caro: <span id="masCaro"></span> | Mas barato: <span id="masBarato"></span></p>
            <tbody id="tbody2">


            </tbody>

        </table>
    </section>
</body>

</html>
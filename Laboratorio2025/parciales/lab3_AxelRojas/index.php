<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumidores unidos | Axel Rojas</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
</head>

<body>
    <section>
        <header>
            <h1>Consumidores Unidos</h1>
            <h2>Comparador de precios</h2>
        </header>
        <form class="selectSection">
            <select name="filtro1" id="filtro1" onchange="getProductsByType()">
                <option value="-1" selected>Seleccióna tu producto</option>
                <?php
                $con = new mysqli("localhost", "root", "", "comparador");
                $q = "SELECT DISTINCT nombre, id_producto FROM producto";
                $res = $con->query($q);
                while ($reg = $res->fetch_object()) {
                    echo "<option value='$reg->id_producto'>$reg->nombre</option>";
                }
                ?>
            </select>
            <select name="filtro2" id="filtro2" onchange="getProductsByLocation()">
                <option value="-1" selected>Seleccióna tu ubicacion</option>
                <?php
                $con = new mysqli("localhost", "root", "", "comparador");
                $q = "SELECT DISTINCT ubicacion FROM supermercado";
                $res = $con->query($q);
                while ($reg = $res->fetch_object()) {
                    echo "<option value='$reg->ubicacion'>$reg->ubicacion</option>";
                }
                ?>
            </select>
        </form>
        <div class="mainResults">
            <table width="100%" cellSpacing="0" cellPadding="2px">
                <thead>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Supermercado</th>
                    <th>Ubicacion</th>
                </thead>
                <tbody id="mainTbody">
                </tbody>
            </table>
        </div>
        <div class="secResults">
            <table width="100%" cellSpacing="0" cellPadding="4px">
                <legend class="legendSecTable">Detalle de producto</legend>
                <p class="priceDiff">Maxima diferencia de precios: <span id="priceDiff"></span></p>
                <p>Mas caro: <span id="masCaro"></span> | Mas barato: <span id="masBarato"></span></p>
                <thead>
                    <th>Supermercado</th>
                    <th>Precio</th>
                    <th>Ubicacion</th>
                </thead>
                <tbody id="secTbody">
                </tbody>
            </table>
        </div>
    </section>
    <footer>
        <p>Axel Rojas | Laboratorio N°3 2025 </p>
    </footer>
</body>

</html>
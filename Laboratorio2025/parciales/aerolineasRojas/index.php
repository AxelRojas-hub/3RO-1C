<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJ3</title>
    <script src="./script.js" defer></script>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
</head>

<body>
    <form oninput="getPlaneData()">
        <label for="aeronave">
            Seleccione un modelo de aeronave:
            <input
                type="text"
                id="modeloAvion"
                name="modeloAvion"
                placeholder="EJ: B737"
                required>
        </label>
        <span id="statusSpan">Pendiente</span>
    </form>
    <h2>Detalle de la aeronave</h2>
    <ul id="detailList">
        <li>Fabricante: <span id="spanFabricante"></span></li>
        <li>Nombre: <span id="spanNombre"></span></li>
    </ul>
    <h3>Flota</h3>
    <table border="white">
        <thead>
            <th>Matricula</th>
            <th>Ingreso a la flota</th>
            <th>Capacidad</th>
            <th>Distribucion</th>
        </thead>
        <tbody id="bodyTabla"></tbody>
    </table>
</body>

</html>
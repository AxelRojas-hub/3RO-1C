<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerolineas Splinter</title>
    <link rel="stylesheet" href="estilos.css">
    <script type="text/javascript" src="./scriptAerolineas.js" defer></script>
</head>

<body>
    <header>
        <h1>Aerolineas Esplinter</h1>
    </header>
    <nav>
        <h3>Laboratorio 2020 aerolineas AJAX</h3>
    </nav>
    <section>
        <article>
            <label for="idIngresoAeronave">Seleccione un modelo de aeronave</label>
            <input type="text" id="idIngresoAeronave" name="inputAeronave" size="30px" oninput="comprobarExistenciaAvion();">
            <p id="mensajeInput"></p>
            <ul id="infoAvion">

            </ul>
            <table>
                <tr>
                    <th>Matr&iacute;cula</th>
                    <th>Ingreso a la Flota</th>
                    <th>Capacidad</th>
                    <th>Distribuci&oacute;n</th>
                </tr>
                <tbody id="tbody">
                </tbody>
            </table>
        </article>
    </section>
</body>

</html>
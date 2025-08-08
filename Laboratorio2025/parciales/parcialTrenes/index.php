<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RailEurope</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
</head>

<body>
    <section>
        <header>
            <h1>RAIL EUROPE</h1>
            <h2>Consulta de servicios de tren</h2>
        </header>
        <form class="selectSection">
            <select name="filtro1" id="filtro1" onchange="getDestinos()">
                <option value="-1" selected disabled>Seleccióna tu origen</option>
                <?php
                $con = new mysqli("localhost", "root", "", "raileurope");
                $q = "SELECT DISTINCT ciudadOrigenServicio FROM servicios";
                $res = $con->query($q);
                while ($reg = $res->fetch_object()) {
                    echo "<option>$reg->ciudadOrigenServicio</option>";
                }
                ?>
            </select>
            <select name="filtro2" id="filtro2" onchange="getServicios()">
                <option value="-1" selected>Seleccióna tu destino</option>
            </select>
        </form>
        <div class="mainResults">
            <table width="100%" cellSpacing="0" cellPadding="2px">
                <thead>
                    <th>Logo</th>
                    <th>Empresa</th>
                    <th>Origen</th>
                    <th>Destino</th>
                </thead>
                <tbody id="mainTbody">
                </tbody>
            </table>
        </div>
        <div class="secResults">
            <ul id="secResultsList">
                <li>Numero de servicio: <span id="nroServicio"></span></li>
                <li>Estacion origen: <span id="estacionOrigen"></span></li>
                <li>Estacion Destino: <span id="estacionDestino"></span></li>
                <li>Hora de salida: <span id="horaSalida"></span></li>
                <li>Hora de llegada: <span id="horaLlegada"></span></li>
                <li>Frecuencia del servicio: <span id="frecuencia"></span></li>
                <li>Precio del ticket: <span id="precioTicket"></span></li>
            </ul>
        </div>
    </section>
</body>

</html>
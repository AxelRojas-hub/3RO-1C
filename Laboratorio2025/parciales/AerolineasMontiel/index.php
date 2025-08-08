<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerolineas</title>
</head>
<body>
    <header>
        <h1>Aerolineas Argentinas</h1>
    </header>
    <div id="contenedor-buscador">
        <label>Seleccionar un modelo de aeronave: </label>
        <input type="text" id="input_modelos" onkeyup="buscarModelo()" maxlength="8"> <span id="id_span"></span>
    </div>
    <div id="contenedor-detalle"></div>
    <div id="contenedor-flota">
        <table id="id_table">
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>
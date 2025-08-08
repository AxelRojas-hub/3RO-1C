<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Numérico</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header>
        <h1>Centro Numérico</h1>
    </header>
    <?php
    $nroPartida = 1;
    if (isset($_COOKIE['partidas'])) {
        $nroPartida = intval($_COOKIE['partidas']);
        $nroPartida++;
    }
    echo "<span class='matchCounter'>Partida nro " . $nroPartida . "</span>";
    ?>
    <form method="POST" class="main-form">
        <label>Ingresa tu numero
            <input autofocus name="numero" required id="numeroInput" type="number">
        </label>
        <button type="submit" class="sendbtn" name="button" value="probar">Probar</button>
    </form>
    <form method="POST">
        <button type="submit" class="dangerbtn" name="rendirse" value="1">Rendirse</button>
    </form>
    <?php
    $numero = 0;
    $sumatoriaIzq = 0;
    $sumatoriaDer = 0;
    $puntaje = 10;

    // Boton para rendirse
    if (isset($_POST['rendirse'])) {
        setcookie('partidas', $nroPartida);
        Juego::mostrarResultados();
        setcookie('puntaje', 10);
        setcookie('intentos', 0);
        unset($_COOKIE['puntaje']);
        unset($_COOKIE['intentos']);
        exit;
    }

    //Manejar si ya no quedan intentos
    if (intval($_COOKIE['puntaje']) <= 0) {
        echo "<span>No te quedan mas intentos</span>";
        Juego::mostrarResultados();
        setcookie('intentos', 0);
        setcookie('puntaje', 10);
        setcookie('partidas', $nroPartida);
        exit;
    }

    //Si existe la cookie de puntaje la setea, sino setea 0 por default
    if (isset($_COOKIE['puntaje']) && intval($_COOKIE['puntaje']) > 0) {
        $puntaje = intval($_COOKIE['puntaje']);
    } else {
        setcookie('puntaje', $puntaje);
    }
    //Si existe la cookie de intentos la setea, sino setea 0 por default
    if (isset($_COOKIE['intentos']) && intval($_COOKIE['puntaje']) > 0) {
        $intentos = $_COOKIE['intentos'];
    } else {
        $intentos = 0;
        setcookie('intentos', $intentos);
    }

    //SI esta el numero, y es mayor a 0, verifica si es CN 
    if (
        isset($_POST['numero'])
        && intval($_POST['numero']) > 0
        && $_POST['numero'] != ""
    ) {
        require_once('./Juego.class.php');
        $numero = intval($_POST['numero']);
        Juego::mostrarResultados();
        $intentos++;
        $puntaje--;
        setcookie('puntaje', $puntaje);
        setcookie('intentos', $intentos);
        if (Juego::isCentroNumerico($numero)) {
            echo "<h2>Encontraste un centro numerico!</h2>";
            setcookie('intentos', 0);
            setcookie('puntaje', 10);
            setcookie('partidas', $nroPartida);
            exit;
        } else {
            echo "<h2>" . $numero . " no es centro numerico</h2>";
            Juego::checkearCNCercanos($numero);
            Juego::mostrarTabla();
        };
    } else {
        //Maneja si el numero ingresado es negativo
        if (intval($_POST['numero']) < 0) {
            echo "<span>Ingresá un numero positivo.</span>";
        }
    }
    ?>
</body>

</html>
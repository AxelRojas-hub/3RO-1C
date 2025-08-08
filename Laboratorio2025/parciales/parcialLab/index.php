<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Numérico | Axel Rojas</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header>
        <h1>Centro Numérico</h1>
    </header>
    <?php
    require_once('./Juego.class.php');
    require_once('./CookieManager.class.php');

    $puntaje = CookieManager::getInt('puntaje', 10);
    $intentos = CookieManager::getInt('intentos', 0);
    $numero = 0;
    $nroPartida = 1;
    if (CookieManager::getInt('partidas', 0) > 0) {
        $nroPartida = CookieManager::getInt('partidas') + 1;
    }

    $juego = new Juego($numero, $puntaje, $nroPartida);

    echo "<span class='matchCounter'>Partida nro " . $juego->getNroPartida() . "</span>";
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
    CookieManager::set('puntaje', $puntaje);
    CookieManager::set('intentos', $intentos);

    // Boton para rendirse
    if (isset($_POST['rendirse'])) {
        CookieManager::set('partidas', $juego->getNroPartida());
        Juego::mostrarResultados();
        CookieManager::resetGameCookies(10, 0, $juego->getNroPartida());
        CookieManager::delete('puntaje');
        CookieManager::delete('intentos');
        exit;
    }

    //Manejar si ya no quedan intentos
    if ($puntaje <= 0) {
        echo "<span>No te quedan mas intentos</span>";
        Juego::mostrarResultados();
        CookieManager::resetGameCookies(10, 0, $juego->getNroPartida());
        exit;
    }

    //SI esta el numero, y es mayor a 0, verifica si es CN 
    if (
        isset($_POST['numero'])
        && intval($_POST['numero']) > 0
        && $_POST['numero'] != ""
    ) {
        $numero = intval($_POST['numero']);
        $juego->setNumero($numero);
        Juego::mostrarResultados();
        $intentos++;
        $puntaje--;
        $juego->setPuntaje($puntaje);
        // Actualizar cookies después de modificar los valores
        CookieManager::set('puntaje', $puntaje);
        CookieManager::set('intentos', $intentos);
        if ($juego->isCentroNumerico()) {
            echo "<h2>Encontraste un centro numerico!</h2>";
            CookieManager::resetGameCookies(10, 0, $juego->getNroPartida());
            exit;
        }
        echo "<h2>" . $juego->getNumero() . " no es centro numerico</h2>";
        $juego->checkearCNCercanos();
        $juego->mostrarTabla();
    }
    //Maneja si el numero ingresado es negativo
    if (isset($_POST['numero']) && intval($_POST['numero']) < 0) {
        echo "<span>Ingresá un numero positivo.</span>";
    }
    ?>
    <footer>
        <p>LabNro2 | Axel Rojas</p>
    </footer>
</body>

</html>
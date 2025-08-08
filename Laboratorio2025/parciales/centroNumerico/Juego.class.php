<?php class Juego
{
    public static function isCentroNumerico($numero)
    {
        $sumatoriaDer = 0;
        $sumatoriaIzq = 0;
        while ($numero > 0) {
            $sumatoriaIzq = $sumatoriaIzq + $numero;
            $numero--;
        }
        //Vuelvo a asignarle el valor inicial
        $numero = intval($_POST['numero']);
        while ($sumatoriaDer < $sumatoriaIzq) {
            $sumatoriaDer = $sumatoriaDer + $numero;
            $numero++;
        }

        if ($sumatoriaDer == $sumatoriaIzq) {
            return true;
        } else {
            return false;
        }
    }
    public static function checkearCNCercanos($numero)
    {
        $punteroIzq = $numero--;
        $punteroDer = $numero + 1;
        for ($i = 0; $i < 5; $i++) {
            if (Juego::isCentroNumerico($punteroIzq)) {
                echo "<h4>¡Tenes un centro numerico cerca!</h4>";
                break;
            } else {
                if (Juego::isCentroNumerico($punteroDer)) {
                    echo "<h4>¡Tenes un centro numerico cerca!</h4>";
                    break;
                }
            }
            $punteroIzq--;
            $punteroDer++;
        }
    }
    public static function mostrarResultados()
    {
        echo "<div class='resultsContainer'>";
        echo "<span class='spanResults'>Intentos: {$_COOKIE['intentos']} </span >";
        echo "<span class='spanResults'>Puntaje: {$_COOKIE['puntaje']}</span >";
        echo "</div>";
    }
    public static function reiniciarDatos($nroPartida)
    {
        setcookie('intentos', 0);
        setcookie('puntaje', 10);
        setcookie('partidas', $nroPartida);
        exit;
    }
    public static function mostrarTabla()
    {
        $numero = $_POST['numero'];
        $sumatoriaDer = 0;
        $sumatoriaIzq = 0;
        while ($numero > 0) {
            $sumatoriaIzq = $sumatoriaIzq + $numero;
            $numero--;
        }
        //Vuelvo a asignarle el valor inicial
        $numero = intval($_POST['numero']);
        while ($sumatoriaDer < $sumatoriaIzq) {
            $sumatoriaDer = $sumatoriaDer + $numero;
            $numero++;
        }
        echo "<table border cellpadding='10' cellspacing='0'>
                <tbody>
                    <tr>
                        <td>Numero ingresado</td>
                        <td>{$_POST['numero']}</td>
                    </tr> 
                    <tr>
                        <td>Sumatoria por izq.</td>
                        <td>$sumatoriaIzq</td>
                    </tr> 
                    <tr>
                        <td>Sumatoria por der.</td>
                        <td>$sumatoriaDer</td>
                    </tr> 
                </tbody>
                </table>";
    }
}

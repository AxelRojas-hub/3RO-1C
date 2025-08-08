<?php
class Juego
{
    private $numero;
    private $sumatoriaIzq;
    private $sumatoriaDer;
    private $puntaje;
    private $nroPartida;

    public function __construct($numero = 0, $puntaje = 10, $nroPartida = 1)
    {
        $this->numero = $numero;
        $this->puntaje = $puntaje;
        $this->nroPartida = $nroPartida;
        $this->sumatoriaIzq = 0;
        $this->sumatoriaDer = 0;
    }

    // Getters y setters
    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getPuntaje()
    {
        return $this->puntaje;
    }
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    }
    public function getNroPartida()
    {
        return $this->nroPartida;
    }
    public function setNroPartida($nroPartida)
    {
        $this->nroPartida = $nroPartida;
    }

    // Métodos de instancia que usan el estado
    public function isCentroNumerico()
    {
        $sumatoriaDer = 0;
        $sumatoriaIzq = 0;
        $n = $this->numero;
        while ($n > 0) {
            $sumatoriaIzq += $n;
            $n--;
        }
        $n = $this->numero;
        while ($sumatoriaDer < $sumatoriaIzq) {
            $sumatoriaDer += $n;
            $n++;
        }
        $this->sumatoriaIzq = $sumatoriaIzq;
        $this->sumatoriaDer = $sumatoriaDer;
        return $sumatoriaDer == $sumatoriaIzq;
    }

    public function checkearCNCercanos()
    {
        $punteroIzq = $this->numero - 1;
        $punteroDer = $this->numero + 1;
        for ($i = 0; $i < 5; $i++) {
            if (self::isCentroNumerico($punteroIzq)) {
                echo "<h4>¡Tenes un centro numerico cerca!</h4>";
                break;
            } else if (self::isCentroNumerico($punteroDer)) {
                echo "<h4>¡Tenes un centro numerico cerca!</h4>";
                break;
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

    public function reiniciarDatos()
    {
        setcookie('intentos', 0);
        setcookie('puntaje', 10);
        setcookie('partidas', $this->nroPartida);
        exit;
    }

    public function mostrarTabla()
    {
        $n = $this->numero;
        $sumatoriaIzq = 0;
        $sumatoriaDer = 0;
        $tmp = $n;
        while ($tmp > 0) {
            $sumatoriaIzq += $tmp;
            $tmp--;
        }
        $tmp = $n;
        while ($sumatoriaDer < $sumatoriaIzq) {
            $sumatoriaDer += $tmp;
            $tmp++;
        }
        echo "<table border cellpadding='10' cellspacing='0'>
                <tbody>
                    <tr>
                        <td>Numero ingresado</td>
                        <td>{$this->numero}</td>
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

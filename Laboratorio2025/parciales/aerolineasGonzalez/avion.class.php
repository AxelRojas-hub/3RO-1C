<?php
class Avion
{
    private $id;
    private $modelo; //esto es el nombre de la tabla modelo matcheado por id
    private $matricula;
    private $fabricante;
    private $capacidad;
    private $distribucion;
    private $fechaIngreso;

    public function __construct() {}

    public function getID()
    {
        return $this->id;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getFabricante()
    {
        return $this->fabricante;
    }

    public function getCapacidad()
    {
        return $this->capacidad;
    }

    public function getDistribucion()
    {
        return $this->distribucion;
    }

    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;
    }

    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;
    }

    public function setDistribucion($distribucion)
    {
        $this->distribucion = $distribucion;
    }

    public function setFechaIngreso($fecha)
    {
        $this->fechaIngreso = $fecha;
    }

    public static function getAviones($cade)
    {
        $listaAviones = [];
        $conexion = new mysqli("localhost", "root", "", "aerolineas") or die("no se pudo conectar a la base de datos");
        $cadena = $conexion->real_escape_string($cade);
        $consulta = "SELECT m.nombre, m.fabricante, a.matricula, a.fechaIngreso, a.capacidad, a.distribucion
            FROM modelos as m JOIN aviones as a ON m.idModelo = a.idModelo
            WHERE m.nombreReducido = '{$cadena}'";
        $resu = $conexion->query($consulta);
        while ($avion = $resu->fetch_object()) {
            $listaAviones[] = $avion;
        }
        $resu->free();
        $conexion->close();
        return $listaAviones;
    }
}

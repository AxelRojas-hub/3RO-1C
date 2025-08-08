<?php
class Modelo {
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost","root","","aerolineas");
    }

    public function getConn(){
        return $this->conn;
    }

    public function devolverDatos($nombreReducido){
        $sql = "SELECT * FROM aviones AS a JOIN modelos AS m ON a.idModelo = m.idModelo
                WHERE m.nombreReducido = '{$this->conn->real_escape_string($nombreReducido)}'";

        $resu = $this->conn->query($sql);

        $datos = [];

        if($resu->num_rows > 0){
            while($row = $resu->fetch_assoc()){
                $datos[] = $row;
            }
            return $datos;
        }
    }

    public function existeModelo($nombreReducido){
        $sql = "SELECT nombreReducido FROM modelos WHERE nombreReducido = $nombreReducido";
    }
}
?>
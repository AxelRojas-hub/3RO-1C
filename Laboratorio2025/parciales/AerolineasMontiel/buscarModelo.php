<?php
require_once "Modelo.class.php";

$conn = new mysqli("localhost", "root", "", "aerolineas");

if (isset($_GET['nombreReducido'])) {
    $nombreReducido = $conn->real_escape_string($_GET['nombreReducido']);

    $sql = "SELECT * FROM aviones AS a JOIN modelos AS m ON a.idModelo = m.idModelo
                WHERE m.nombreReducido = '{$nombreReducido}'";

    $resu = $conn->query($sql);

    $datos = [];

    if ($resu->num_rows > 0) {
        while ($row = $resu->fetch_assoc()) {
            $datos[] = $row;
        }
        echo json_encode($datos);
    } else {
        echo json_encode("No hay datos");
    }
}

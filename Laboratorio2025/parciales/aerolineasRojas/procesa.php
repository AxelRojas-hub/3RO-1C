<?php
$con = new mysqli("localhost", "root", "", "aerolineas") or die("No se conectó");
$modeloAvion = $con->real_escape_string($_GET["modeloAvion"]);
$query = "
  SELECT a.matricula, a.fechaIngreso,a.capacidad,a.distribucion, m.nombreReducido, m.nombre, m.fabricante
    FROM aviones AS a
  JOIN modelos AS m ON m.idModelo = a.idModelo
  WHERE m.nombreReducido = '{$modeloAvion}'
";

$res = $con->query($query);
header('Content-Type: application/json');
$tempObj = new StdClass();
$tempObj->flota = [];
// Si no trae nada devuelve obj vacio
if ($res->num_rows == 0) {
  $tempObj->matricula = "-----";
  $tempObj->fechaIngreso = "-----";
  $tempObj->capacidad = "-----";
  $tempObj->distribucion = "-----";
  $tempObj->nombre = "-----";
  $tempObj->fabricante = "-----";
  $tempObj->modeloAvion = $modeloAvion;
} else {

  while ($reg = $res->fetch_object()) {
    $newObj = new StdClass();
    $newObj->matricula = $reg->matricula;
    $newObj->fechaIngreso = $reg->fechaIngreso;
    $newObj->capacidad = $reg->capacidad;
    $newObj->distribucion = $reg->distribucion;
    $newObj->nombre = $reg->nombre;
    $newObj->fabricante = $reg->fabricante;
    $tempObj->flota[] = $newObj;
  }
}

echo json_encode($tempObj);
$res->free();
$con->close();

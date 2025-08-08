<?php
include_once("avion.class.php");
$listaAviones = Avion::getAviones($_GET['cade']);
if (!(isset($listaAviones))) {
    $objetoTemporal = new stdClass();
    $objetoTemporal->modelo = "Modelo No Encontrado";
    $miJSON = json_encode($objetoTemporal);
} else {
    $miJSON = json_encode($listaAviones);
}
echo $miJSON;

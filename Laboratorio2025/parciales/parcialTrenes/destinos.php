<?php
$con = new mysqli("localhost", "root", "", "raileurope");
$param = $con->real_escape_string($_POST['origen']);
$query = "SELECT s.ciudadDestinoServicio,s.ciudadOrigenServicio,e.nombreEmpresa, e.logoEmpresa
    FROM servicios AS s 
    JOIN empresas AS e ON s.idEmpresa = e.idEmpresa
    WHERE ciudadOrigenServicio ='$param'
    ";
$res = $con->query($query);
$obj = new stdClass();
$obj->destinos = [];
$obj->empresas = [];
$obj->origen = $_POST['origen'];
while ($reg = $res->fetch_object()) {
    $empresa = new stdClass();
    $empresa->nombreEmpresa = $reg->nombreEmpresa;
    $empresa->logoEmpresa = $reg->logoEmpresa;
    $obj->empresas[] = $empresa;
    $obj->destinos[] = $reg->ciudadDestinoServicio;
}
echo json_encode($obj);

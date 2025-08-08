<?php
$con = new mysqli("localhost", "root", "", "raileurope");
$origen = $con->real_escape_string($_POST['origen']);
$empresa = $con->real_escape_string($_POST['empresa']);
$destino = $con->real_escape_string($_POST['destino']);
// número de servicio, estación de tren del origen, estación de tren del destino, hora
// de salida, hora de llegada, frecuencia del servicio y precio del ticket.
$query = "SELECT s.nroServicio, s.estacionOrigenServicio, s.estacionDestinoServicio, s.horaSalidaServicio, s.horaLlegadaServicio, s.frecuenciaServicio, s.precioServicio
    FROM servicios AS s 
    JOIN empresas AS e ON s.idEmpresa = e.idEmpresa
    WHERE s.ciudadOrigenServicio ='$origen' 
    AND s.ciudadDestinoServicio ='$destino'
    AND e.nombreEmpresa ='$empresa'
    ";
$res = $con->query($query);
$obj = new stdClass();

while ($reg = $res->fetch_object()) {
    $obj->nroServicio = $reg->nroServicio;
    $obj->estacionOrigenServicio = $reg->estacionOrigenServicio;
    $obj->estacionDestinoServicio = $reg->estacionDestinoServicio;
    $obj->horaSalidaServicio = $reg->horaSalidaServicio;
    $obj->horaLlegadaServicio = $reg->horaLlegadaServicio;
    $obj->frecuenciaServicio = $reg->frecuenciaServicio;
    $obj->precioServicio = $reg->precioServicio;
}

echo json_encode($obj);

<?php

$con = new mysqli('localhost', 'root', '', 'comparador');
$productName = $con->real_escape_string($_POST['productName']);
$q = "
        SELECT  pre.precio,s.nombre AS nombreSuper, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE pro.nombre = '$productName'
    ";

//Finalmente con las querys armadas, la ejecuto
// y devuelvo el array de supermercados
$result = $con->query($q);
$data = new stdClass();
$data->supermercados = [];
while ($reg = $result->fetch_object()) {
    $data->supermercados[] = $reg;
}
echo json_encode($data);

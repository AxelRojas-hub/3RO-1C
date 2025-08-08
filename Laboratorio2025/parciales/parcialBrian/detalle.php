<?php
$con = new mysqli("localhost", "root", "", "comparador");
$producto = $con->real_escape_string($_GET['nombre']);
$q = "SELECT s.nombre as nombreSucursal, pre.precio, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE pro.nombre='$producto'";

$result = $con->query($q);
$productos = [];
while ($reg = $result->fetch_object()) {

    $productos[] = $reg;
}


echo json_encode($productos);

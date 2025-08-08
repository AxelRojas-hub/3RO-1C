<?php
$con = new mysqli("localhost", "root", "", "comparador");
$ubicacion = $_GET['sucursal'] = "" ? null : $con->real_escape_string($_GET['sucursal']);
$producto = $con->real_escape_string($_GET['term']);
if (isset($_GET["sucursal"]) && isset($_GET["term"])  && $_GET["sucursal"] != null) {
    //$con->real_escape_string me limpia el ingreso del dato
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.nombre, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE s.ubicacion = '$ubicacion'  AND pro.nombre LIKE '$producto%'
    ";
} else if (isset($_GET["sucursal"]) && !isset($_GET["term"])) {
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.nombre, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE s.ubicacion = '$ubicacion' 
    ";
} else {
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.nombre, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado 
        WHERE pro.nombre LIKE '%$producto%'
    ";
}



$result = $con->query($q);
//creamos un clase vacia
$data = new stdClass();
//le asignamos un atributo con un array 
$data->supermercados = [];
while ($reg = $result->fetch_object()) {

    $data->supermercados[] = $reg;
}

echo json_encode($data);

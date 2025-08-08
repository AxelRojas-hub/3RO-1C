<?php

$con = new mysqli('localhost', 'root', '', 'comparador');


if (isset($_POST['productId']) && isset($_POST['ubicacion'])) {
    // Hago la query con los dos params
    $ubiSuper = $con->real_escape_string($_POST['ubicacion']);
    $idProd = $con->real_escape_string($_POST['productId']);
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.nombre AS nombreSuper, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE s.ubicacion = '$ubiSuper' AND pre.id_producto = '$idProd'
    ";
} else if (isset($_POST['ubicacion']) && !isset($_POST['productId'])) {
    // Si tengo solo la ubicacion hago la query con esto
    $ubiSuper = $con->real_escape_string($_POST['ubicacion']);
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.ubicacion, s.nombre AS nombreSuper FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE s.ubicacion = '$ubiSuper'
    ";
} else {
    // Si no se cumple ninguna de las anteriores, 
    // solo queda hacer la query con el id del producto
    $idProd = $con->real_escape_string($_POST['productId']);
    $q = "
        SELECT pro.nombre AS nombreProducto, pre.precio,s.nombre AS nombreSuper, s.ubicacion FROM producto AS pro
        JOIN precios AS pre ON pre.id_producto = pro.id_producto
        JOIN supermercado AS s ON pre.id_supermercado = s.id_supermercado
        WHERE pro.id_producto = '$idProd'
    ";
}

//Finalmente con las querys armadas, la ejecuto 
// y devuelvo el array de supermercados
$result = $con->query($q);
$data = new stdClass();
$data->supermercados = [];
while ($reg = $result->fetch_object()) {
    $data->supermercados[] = $reg;
}
echo json_encode($data);

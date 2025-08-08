<?php
if (isset($_POST["stock"])) {
    $con = new mysqli("localhost", "root", "", "computacion");
    $stock = $con->real_escape_string($_POST["stock"]);
    $id = $con->real_escape_string($_POST["idProducto"]);
    $sucursal = $con->real_escape_string($_POST["sucursal"]);

    $q = "
    UPDATE stockproducto AS s
    SET cantidad='$stock'
    WHERE s.codigo = '$id' AND s.sucursal ='$sucursal'";
    $res = $con->query($q);
    if ($res) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
}

<?php
if (isset($_POST["id"]) && $_POST["id"] !== -1) {
    $con = new mysqli("localhost", "root", "", "computacion");
    $param = $con->real_escape_string($_POST["id"]);
    $q = "
    SELECT s.sucursal, s.cantidad, p.nombreProducto, p.proveedor 
    FROM stockproducto AS s 
    JOIN producto AS p 
    ON p.codigo = s.codigo
    WHERE s.codigo = '$param'";
    $res = $con->query($q);
    $data = [];
    while ($reg = $res->fetch_object()) {
        $data[] = $reg;
    }
    echo json_encode($data);
}

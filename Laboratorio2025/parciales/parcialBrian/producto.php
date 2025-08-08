<?php
$conn = new mysqli("localhost", "root", "", "comparador");
if ($conn->connect_error) {
    echo json_encode(["error" => "Error de conexión a la base de datos: " . $conn->connect_error]);
    exit();
}



$productos = [];

if (isset($_POST["sucursal"])) {
    $sucursal = htmlspecialchars($_POST["sucursal"]);

    $sql = "SELECT p.nombre as nombreproducto, ps.precio,s.nombre,s.ubicacion FROM producto AS p JOIN precios AS ps ON p.id_producto=ps.id_producto JOIN supermercado AS s ON s.id_supermercado=ps.id_supermercado
    WHERE s.ubicacion = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $sucursal); // "s" indica que el parámetro es un string

    if (!$stmt->execute()) { // Ejecutar la consulta preparada
        $conn->close();
        die(json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]));
    }

    $result = $stmt->get_result(); // Obtener el resultado
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row; // Añadir cada fila al array de productos
        }
    }
    $stmt->close(); // Cerrar el statement
    $conn->close(); // Cerrar la conexión a la base de datos

    echo json_encode($productos);
}

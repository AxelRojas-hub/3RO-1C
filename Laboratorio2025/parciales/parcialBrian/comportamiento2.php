<?php


$conn = new mysqli("localhost", "root", "", "comparador"); // Conexión a la DB

$term = $_GET['term'] ?? ''; // Obtener el término directamente de GET

$suggestions = []; // Array para guardar los nombres de productos sugeridos

if (!empty($term)) {
    // Consulta SQL para buscar coincidencias parciales (¡PELIGROSO!)
    // Usamos LOWER para búsqueda insensible a mayúsculas/minúsculas
    $sql = "SELECT p.nombre as nombreproducto, ps.precio,s.nombre,s.ubicacion FROM producto AS p JOIN precios AS ps ON p.id_producto=ps.id_producto JOIN supermercado AS s ON s.id_supermercado=ps.id_supermercado WHERE p.nombre LIKE '$term%' LIMIT 10";

    $result = $conn->query($sql);
    $data = [];

    if ($result) {
        while ($row = $result->fetch_object()) {
            $data[] = $row; // Añadir cada nombre encontrado al array
        }
    }
}

$conn->close();
echo json_encode($data); // Devolver el array de sugerencias

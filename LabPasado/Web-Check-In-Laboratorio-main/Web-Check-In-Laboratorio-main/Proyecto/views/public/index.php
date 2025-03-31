<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../config/database.php';

echo "Paso 1: Archivo incluido correctamente.<br>";

$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "¡Conexión exitosa a la base de datos!";
} else {
    echo "Error al conectar con la base de datos.";
}

<?php
class Database {
    private $host = "localhost";
    private $db_name = "web_checkin2"; // Nombre de tu base de datos
    private $username = "root";      // Usuario de tu servidor MySQL
    private $password = "";          // Contraseña de tu servidor MySQL
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password,
                $options
            );
        } catch (PDOException $exception) {
            echo "Error de conexión a la base de datos: " . $exception->getMessage();
            exit; // Detener ejecución si ocurre un error
        }

        return $this->conn;
    }
}

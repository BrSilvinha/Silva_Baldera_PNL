<?php
class Database {
    private $host = "localhost"; // Cambia si tu base de datos está en otro servidor
    private $db_name = "denuncias_db"; // Asegúrate de que este nombre coincida con tu base de datos
    private $username = "root"; // Nombre de usuario de la base de datos
    private $password = ""; // Contraseña de la base de datos (asegúrate de que sea correcta)
    public $conn;

    // Método para obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            // Crear una nueva conexión PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Configuración de errores para excepciones
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

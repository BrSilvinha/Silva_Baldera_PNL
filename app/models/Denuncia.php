<?php
class Denuncia {
    private $conn;
    private $table_name = "denuncias";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear una nueva denuncia
    public function crear($data) {
        $query = "INSERT INTO " . $this->table_name . " (titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano) 
                    VALUES (:titulo, :descripcion, :ubicacion, :estado, :ciudadano, :telefono_ciudadano)";
        $stmt = $this->conn->prepare($query);

        // Vincular los valores
        $stmt->bindParam(":titulo", $data['titulo']);
        $stmt->bindParam(":descripcion", $data['descripcion']);
        $stmt->bindParam(":ubicacion", $data['ubicacion']);
        $stmt->bindParam(":estado", $data['estado']);
        $stmt->bindParam(":ciudadano", $data['ciudadano']);
        $stmt->bindParam(":telefono_ciudadano", $data['telefono_ciudadano']);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Método para obtener todas las denuncias
    public function obtenerTodas() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener denuncias paginadas
    public function obtenerPaginadas($offset, $limit) {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_registro DESC LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($query);

        // Vincular los valores de paginación
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para actualizar el estado de una denuncia
    public function actualizarEstado($id, $estado) {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular los valores
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":id", $id);

        // Ejecutar la consulta
        return $stmt->execute();
    }

    // Método para eliminar una denuncia por su ID
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular el valor del ID
        $stmt->bindParam(":id", $id);

        // Ejecutar la consulta
        return $stmt->execute();
    }
}
?>

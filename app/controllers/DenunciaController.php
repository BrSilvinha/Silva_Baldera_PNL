<?php
include_once '../models/Database.php';

class DenunciaController {
    private $conn;

    // Constructor para inicializar la conexión a la base de datos
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear una nueva denuncia
    public function crearDenuncia($titulo, $descripcion, $ubicacion, $estado, $ciudadano, $telefono) {
        $sql = "INSERT INTO denuncias (titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano) 
                VALUES (:titulo, :descripcion, :ubicacion, :estado, :ciudadano, :telefono)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':ciudadano', $ciudadano);
        $stmt->bindParam(':telefono', $telefono);
        return $stmt->execute();
    }

    // Obtener todas las denuncias con paginación y búsqueda opcional por ID
    public function obtenerDenuncias($offset = 0, $limit = 5, $searchId = null) {
        $sql = "SELECT * FROM denuncias";
        if ($searchId !== null) {
            $sql .= " WHERE id = :search_id"; // Filtrar por ID si se proporciona
        }
        $sql .= " LIMIT :offset, :limit";

        $stmt = $this->conn->prepare($sql);
        if ($searchId !== null) {
            $stmt->bindParam(':search_id', $searchId, PDO::PARAM_INT);
        }
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener el total de denuncias, incluyendo filtrado por ID
    public function contarDenuncias($searchId = null) {
        $sql = "SELECT COUNT(*) as total FROM denuncias";
        if ($searchId !== null) {
            $sql .= " WHERE id = :search_id"; // Filtrar por ID si se proporciona
        }

        $stmt = $this->conn->prepare($sql);
        if ($searchId !== null) {
            $stmt->bindParam(':search_id', $searchId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Obtener una denuncia por ID
    public function obtenerDenunciaPorId($id) {
        $sql = "SELECT * FROM denuncias WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar una denuncia
    public function actualizarDenuncia($id, $titulo, $descripcion, $ubicacion, $estado, $ciudadano, $telefono) {
        $sql = "UPDATE denuncias SET 
                titulo = :titulo, 
                descripcion = :descripcion, 
                ubicacion = :ubicacion, 
                estado = :estado, 
                ciudadano = :ciudadano, 
                telefono_ciudadano = :telefono 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':ciudadano', $ciudadano);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar una denuncia
    public function eliminarDenuncia($id) {
        $sql = "DELETE FROM denuncias WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Buscar denuncias por título o descripción (opcional)
    public function buscarDenuncias($query) {
        $sql = "SELECT * FROM denuncias WHERE titulo LIKE :query OR descripcion LIKE :query";
        $stmt = $this->conn->prepare($sql);
        $query = "%{$query}%";
        $stmt->bindParam(':query', $query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

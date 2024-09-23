<?php
require_once __DIR__ . '/../config/database.php';

class ObraSocialModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las obras sociales
    public function obtenerObrasSociales() {
        try {
            $query = "SELECT * FROM obrasocial";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener obras sociales: " . $e->getMessage();
            return [];
        }
    }

    // Obtener una obra social por su ID
    public function obtenerObraSocialPorId($id_obra_social) {
        try {
            $query = "SELECT * FROM obrasocial WHERE id_obra_social = :id_obra_social";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_obra_social', $id_obra_social, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la obra social: " . $e->getMessage();
            return null;
        }
    }

    // Agregar una nueva obra social
    public function agregarObraSocial($nombre, $descripcion) {
        try {
            $query = "INSERT INTO obrasocial (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al agregar obra social: " . $e->getMessage();
            return false;
        }
    }

    // Actualizar una obra social
    public function actualizarObraSocial($id_obra_social, $nombre, $descripcion) {
        try {
            $query = "UPDATE obrasocial SET nombre = :nombre, descripcion = :descripcion WHERE id_obra_social = :id_obra_social";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_obra_social', $id_obra_social, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error al actualizar la obra social: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar una obra social
    public function eliminarObraSocial($id_obra_social) {
        try {
            $query = "DELETE FROM obrasocial WHERE id_obra_social = :id_obra_social";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_obra_social', $id_obra_social, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error al eliminar la obra social: " . $e->getMessage();
            return false;
        }
    }
}
$obraSocialModel = new ObraSocialModel($conn);
?>

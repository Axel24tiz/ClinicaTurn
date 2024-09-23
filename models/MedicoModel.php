<?php
require_once __DIR__ . '/../config/database.php';

class MedicoModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los médicos
    public function obtenerMedicos() {
        try {
            $query = "SELECT * FROM medico";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener médicos: " . $e->getMessage();
            return [];
        }
    }

    // Obtener un médico por ID
    public function obtenerMedicoPorId($id_medico) {
        try {
            $query = "SELECT * FROM medico WHERE id_medico = :id_medico";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener el médico: " . $e->getMessage();
            return null;
        }
    }
}
$medicoModel = new MedicoModel($conn);
?>

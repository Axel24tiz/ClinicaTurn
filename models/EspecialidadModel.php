<?php
// Incluir la conexión a la base de datos
require_once __DIR__ . '/../config/database.php';

class EspecialidadModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las especialidades
    public function obtenerEspecialidades() {
        try {
            $query = "SELECT * FROM especialidad";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            // Devuelve un array con todas las especialidades
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Error al obtener especialidades: " . $e->getMessage();
            return [];
        }
    }
}

// Crear una instancia del modelo
$especialidadModel = new EspecialidadModel($conn);

// Llamar al método para obtener especialidades
$especialidades = $especialidadModel->obtenerEspecialidades();
?>

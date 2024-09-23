<?php
require_once __DIR__ . '/../config/database.php';

class PacienteModel {
    private $conn;
    private $table_name = "paciente";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los pacientes
    public function obtenerPacientes() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener pacientes: " . $e->getMessage();
            return [];
        }
    }

    // Obtener un paciente por ID
    public function obtenerPacientePorId($id_paciente) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id_paciente = :id_paciente";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener el paciente: " . $e->getMessage();
            return null;
        }
    }

    // Obtener un paciente por DNI
    public function obtenerPorDni($dni) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE dni = :dni LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener el paciente por DNI: " . $e->getMessage();
            return null;
        }
    }

    // Agregar un nuevo paciente con todos los campos necesarios
    public function crearPaciente($dni, $nombre, $apellido, $obra_social_id, $numero_carnet, $edad, $email, $telefono) {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (dni, nombre, apellido, obra_social_id, numero_carnet, edad, email, telefono) 
                      VALUES 
                      (:dni, :nombre, :apellido, :obra_social_id, :numero_carnet, :edad, :email, :telefono)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':obra_social_id', $obra_social_id, PDO::PARAM_INT);
            $stmt->bindParam(':numero_carnet', $numero_carnet, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->execute();
            return $this->conn->lastInsertId(); // Devuelve el ID del nuevo paciente
        } catch (PDOException $e) {
            echo "Error al agregar paciente: " . $e->getMessage();
            return false;
        }
    }

    // Actualizar datos de un paciente existente
    public function actualizarPaciente($id_paciente, $dni, $nombre, $apellido, $obra_social_id, $numero_carnet, $edad, $email, $telefono) {
        try {
            $query = "UPDATE " . $this->table_name . " SET 
                      dni = :dni,
                      nombre = :nombre, 
                      apellido = :apellido, 
                      obra_social_id = :obra_social_id, 
                      numero_carnet = :numero_carnet, 
                      edad = :edad, 
                      email = :email, 
                      telefono = :telefono
                      WHERE id_paciente = :id_paciente";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':obra_social_id', $obra_social_id, PDO::PARAM_INT);
            $stmt->bindParam(':numero_carnet', $numero_carnet, PDO::PARAM_STR);
            $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el paciente: " . $e->getMessage();
            return false;
        }
    }
        // Verificar si el paciente ya existe por email
        public function getPacienteIdByEmail($email) {
            try {
                $query = "SELECT id_paciente FROM paciente WHERE email = :email";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['id_paciente'] : false;
            } catch (PDOException $e) {
                echo "Error al obtener el paciente por email: " . $e->getMessage();
                return false;
            }
        }
}
?>

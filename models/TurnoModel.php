<?php
require_once __DIR__ . '/../config/database.php';

class TurnoModel {
    private $conn;
    private $table_name = "turno";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los turnos
    public function obtenerTurnos() {
        try {
            $query = "SELECT t.*, p.nombre AS paciente_nombre, p.apellido AS paciente_apellido, 
                             m.nombre AS medico_nombre, m.apellido AS medico_apellido, 
                             os.nombre AS obra_social_nombre
                      FROM " . $this->table_name . " t
                      JOIN paciente p ON t.id_paciente = p.id_paciente
                      JOIN medico m ON t.id_medico = m.id_medico
                      JOIN obrasocial os ON p.obra_social_id = os.id_obra_social
                      ORDER BY t.fecha_hora DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener turnos: " . $e->getMessage();
            return [];
        }
    }

        // Verificar si un día completo está ocupado
        public function esDiaOcupado($id_medico, $fecha) {
            try {
                // Cuenta cuántos turnos tiene el médico en la fecha dada
                $query = "SELECT COUNT(*) AS total_turnos FROM turno WHERE id_medico = :id_medico AND fecha = :fecha AND estado IN ('pendiente', 'confirmado')";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
                $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmt->execute();
                
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Si el total de turnos es igual al máximo de turnos por ese día, el día está completamente ocupado
                return ($resultado['total_turnos'] >= 8);  // Suponiendo que 8 es el máximo de turnos por día
            } catch (PDOException $e) {
                echo "Error al verificar si el día está ocupado: " . $e->getMessage();
                return false;
            }
        }
        
        // Guardar un nuevo turno
        public function guardarTurno($id_paciente, $id_medico, $tipo_turno, $fecha, $hora, $sobre_turno, $estado, $monto_a_pagar) {
            try {
                $query = "INSERT INTO turno (id_paciente, id_medico, tipo_turno, fecha, hora, sobre_turno, estado, monto_a_pagar) 
                          VALUES (:id_paciente, :id_medico, :tipo_turno, :fecha, :hora, :sobre_turno, :estado, :monto_a_pagar)";
                $stmt = $this->conn->prepare($query);
    
                $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
                $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
                $stmt->bindParam(':tipo_turno', $tipo_turno, PDO::PARAM_STR);
                $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
                $stmt->bindParam(':sobre_turno', $sobre_turno, PDO::PARAM_BOOL);
                $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
                $stmt->bindParam(':monto_a_pagar', $monto_a_pagar, PDO::PARAM_STR);
    
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error al guardar turno: " . $e->getMessage();
                return false;
            }
        }

    // Obtener un turno por ID
    public function obtenerTurnoPorId($id_turno) {
        try {
            $query = "SELECT t.*, p.nombre AS paciente_nombre, p.apellido AS paciente_apellido, 
                             m.nombre AS medico_nombre, m.apellido AS medico_apellido, 
                             os.nombre AS obra_social_nombre
                      FROM " . $this->table_name . " t
                      JOIN paciente p ON t.id_paciente = p.id_paciente
                      JOIN medico m ON t.id_medico = m.id_medico
                      JOIN obrasocial os ON p.obra_social_id = os.id_obra_social
                      WHERE t.id_turno = :id_turno LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_turno', $id_turno, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener el turno: " . $e->getMessage();
            return null;
        }
    }

    // Crear un nuevo turno
    public function crearTurno($id_paciente, $id_medico, $fecha_hora, $tipo_turno, $sobre_turno, $monto_a_pagar) {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (id_paciente, id_medico, fecha_hora, tipo_turno, sobre_turno, estado, monto_a_pagar) 
                      VALUES 
                      (:id_paciente, :id_medico, :fecha_hora, :tipo_turno, :sobre_turno, 'pendiente', :monto_a_pagar)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_hora', $fecha_hora, PDO::PARAM_STR);
            $stmt->bindParam(':tipo_turno', $tipo_turno, PDO::PARAM_STR);
            $stmt->bindParam(':sobre_turno', $sobre_turno, PDO::PARAM_INT);
            $stmt->bindParam(':monto_a_pagar', $monto_a_pagar, PDO::PARAM_STR);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al crear turno: " . $e->getMessage();
            return false;
        }
    }

    // Verificar disponibilidad de turno
    public function verificarDisponibilidad($id_medico, $fecha_hora) {
        try {
            $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                      WHERE id_medico = :id_medico AND fecha_hora = :fecha_hora AND estado != 'cancelado'";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_hora', $fecha_hora, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'] == 0;
        } catch (PDOException $e) {
            echo "Error al verificar disponibilidad: " . $e->getMessage();
            return false;
        }
    }

    // Obtener horarios de un médico para una fecha específica
    public function obtenerHorariosPorFecha($id_medico, $fecha){
        // Obtener el día de la semana (1 = Lunes, 7 = Domingo)
        $dia_semana = date('N', strtotime($fecha));
        
        $query = "SELECT hm.hora_inicio, hm.hora_fin FROM horariomedico hm
                  WHERE hm.id_medico = :id_medico AND hm.dia_semana = :dia_semana";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
        $stmt->bindParam(':dia_semana', $dia_semana, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($id_turno, $nuevo_estado) {
        try {
            $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id_turno = :id_turno";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado', $nuevo_estado, PDO::PARAM_STR);
            $stmt->bindParam(':id_turno', $id_turno, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el estado del turno: " . $e->getMessage();
            return false;
        }
    }
}

// Crear instancia del modelo Turno
$turnoModel = new TurnoModel($conn);
?>

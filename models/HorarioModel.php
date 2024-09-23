<?php
require_once __DIR__ . '/../config/database.php';

class HorarioModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener horarios disponibles de un médico
    public function obtenerHorarioMedico($id_medico) {
        try {
            $query = "SELECT dia_semana, hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener el horario del médico: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerHorariosPorDiaSemana($id_medico, $dia_semana) {
        try {
            $query = "SELECT hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico AND dia_semana = :dia_semana";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':dia_semana', $dia_semana, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los horarios por día de la semana: " . $e->getMessage();
            return [];
        }
    }
    public function verificarDisponibilidadPorFecha($id_medico, $fecha) {
        try {
            $query = "SELECT COUNT(*) AS total_turnos FROM turnos WHERE id_medico = :id_medico AND fecha = :fecha";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->execute();
    
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return ($resultado['total_turnos'] >= 8);  // Suponiendo que 8 es el máximo de turnos por día
        } catch (PDOException $e) {
            echo "Error al verificar disponibilidad: " . $e->getMessage();
            return false;
        }
    }
    
    function generarIntervalos($hora_inicio, $hora_fin, $intervalo = '30 minutes') {
        $intervalos = [];
        $inicio = new DateTime($hora_inicio);
        $fin = new DateTime($hora_fin);
    
        while ($inicio < $fin) {
            $intervalos[] = $inicio->format('H:i');
            $inicio->modify($intervalo);
        }
    
        return $intervalos;
    }
    
    function obtenerTurnosOcupados($id_medico, $fecha, $conn) {
        $query = "SELECT hora FROM turno WHERE id_medico = :id_medico AND fecha = :fecha";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_medico', $id_medico);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
    
        $turnosOcupados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $turnosOcupados[] = $row['hora'];
        }
        
        return $turnosOcupados;
    }
    
    
    
    
}

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

    

    // Obtener horarios por día de la semana
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

    // Verificar disponibilidad de un médico por fecha
    public function verificarDisponibilidadPorFecha($id_medico, $fecha) {
        try {
            $query = "SELECT COUNT(*) AS total_turnos FROM turnos WHERE id_medico = :id_medico AND fecha = :fecha";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return ($resultado['total_turnos'] >= 8);  // Máximo de 8 turnos por día
        } catch (PDOException $e) {
            echo "Error al verificar disponibilidad: " . $e->getMessage();
            return false;
        }
    }

    // Excluir fechas pasadas
    public function esFechaPasada($fecha) {
        $hoy = date('Y-m-d');
        return ($fecha < $hoy);
    }


    // Generar intervalos de tiempo
    public function generarIntervalos($hora_inicio, $hora_fin, $intervalo = '30 minutes') {
        $intervalos = [];
        $inicio = new DateTime($hora_inicio);
        $fin = new DateTime($hora_fin);

        while ($inicio < $fin) {
            $intervalos[] = $inicio->format('H:i');
            $inicio->modify($intervalo);
        }

        return $intervalos;
    }

    // Obtener turnos ocupados
    public function obtenerTurnosOcupados($id_medico, $fecha) {
        $query = "SELECT hora FROM turno WHERE id_medico = :id_medico AND fecha = :fecha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_medico', $id_medico);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        $turnosOcupados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $turnosOcupados[] = $row['hora'];
        }

        return $turnosOcupados;
    }
    public function esFeriado($fecha) {
        $year = (new DateTime($fecha))->format('Y');
        $api_url = "https://date.nager.at/api/v3/PublicHolidays/$year/AR";
        
        // Llamar a la API de feriados públicos
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Evitar problemas con certificados SSL
    
            $response = curl_exec($ch);
            curl_close($ch);
    
            if ($response) {
                $feriados = json_decode($response, true);
                foreach ($feriados as $feriado) {
                    if ($feriado['date'] == $fecha) {
                        return true; // Es un feriado
                    }
                }
            }
    
            return false; // No es feriado
        } catch (Exception $e) {
            echo "Error al verificar feriado: " . $e->getMessage();
            return false;
        }
    }
    

    // Validar si una fecha es válida para agendar (no feriado ni fecha pasada)
    public function esFechaValidaParaTurno($fecha) {
        return !$this->esFechaPasada($fecha) && !$this->esFeriado($fecha);
    }
}

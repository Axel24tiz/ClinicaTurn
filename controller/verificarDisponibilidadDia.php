<?php
require_once '../config/database.php';

$id_medico = $_GET['id_medico'] ?? 0;
$fecha = $_GET['fecha'] ?? '';

if (empty($id_medico) || empty($fecha)) {
    echo json_encode(['error' => 'Datos incompletos.']);
    exit;
}

try {
    // Verificar si el médico trabaja ese día
    $query_horarios = "SELECT hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico AND dia_semana = DAYOFWEEK(:fecha) - 1";
    $stmt = $conn->prepare($query_horarios);
    $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->execute();
    
    $horarios = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$horarios) {
        echo json_encode(['disponible' => false, 'mensaje' => 'El médico no trabaja este día.']);
        exit;
    }

    // Convertir horas de inicio y fin a formato de 24 horas
    $hora_inicio = $horarios['hora_inicio'];
    $hora_fin = $horarios['hora_fin'];

    // Verificar si hay turnos ya ocupados en esa fecha
    $query_turnos = "SELECT hora FROM turno WHERE id_medico = :id_medico AND fecha = :fecha AND estado IN ('pendiente', 'confirmado')";
    $stmt_turnos = $conn->prepare($query_turnos);
    $stmt_turnos->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
    $stmt_turnos->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt_turnos->execute();
    
    $turnos_ocupados = $stmt_turnos->fetchAll(PDO::FETCH_COLUMN);

    // Crear un array con todos los horarios posibles entre la hora de inicio y fin
    $horarios_disponibles = [];
    $hora_actual = strtotime($hora_inicio);
    $hora_limite = strtotime($hora_fin);
    
    while ($hora_actual < $hora_limite) {
        $hora_formateada = date('H:i:s', $hora_actual);
        
        // Si el horario no está ocupado, lo añadimos a los horarios disponibles
        if (!in_array($hora_formateada, $turnos_ocupados)) {
            $horarios_disponibles[] = $hora_formateada;
        }

        // Añadir 30 minutos o el intervalo de tiempo que uses para los turnos
        $hora_actual = strtotime('+30 minutes', $hora_actual);
    }

    if (empty($horarios_disponibles)) {
        echo json_encode(['disponible' => false, 'mensaje' => 'No hay horarios disponibles.']);
    } else {
        echo json_encode(['disponible' => true, 'horarios' => $horarios_disponibles]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al verificar la disponibilidad: ' . $e->getMessage()]);
}
?>

<?php
require_once '../config/database.php'; 
require_once '../models/HorarioModel.php'; 

$id_medico = $_GET['id_medico'];
$fecha = $_GET['fecha'];

// Obtener los horarios del médico para el día seleccionado
$query = "SELECT hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico AND dia_semana = DAYOFWEEK(:fecha)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_medico', $id_medico);
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();

$horario = $stmt->fetch(PDO::FETCH_ASSOC); 

if ($horario) {
    $hora_inicio = $horario['hora_inicio'];
    $hora_fin = $horario['hora_fin'];


    // Filtrar horarios disponibles
    $horariosDisponibles = array_diff($intervalos, $turnosOcupados);

    echo json_encode(['horarios' => $horariosDisponibles]);
} else {
    echo json_encode(['error' => 'No se encontraron horarios para el médico en ese día.']);
}
?>

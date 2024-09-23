<?php
require_once '../config/database.php';  // Asegúrate de que esta ruta sea la correcta
require_once '../models/HorarioModel.php';  // Incluye el archivo con las funciones

// Obtener los parámetros que llegan por GET
$id_medico = $_GET['id_medico'];
$fecha = $_GET['fecha'];

// Obtener los horarios del médico para el día seleccionado
$query = "SELECT hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico AND dia_semana = DAYOFWEEK(:fecha)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_medico', $id_medico);
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();

$horario = $stmt->fetch(PDO::FETCH_ASSOC);  // PDO usa fetch() para obtener los resultados

if ($horario) {
    $hora_inicio = $horario['hora_inicio'];
    $hora_fin = $horario['hora_fin'];

    // Generar intervalos de tiempo
    $intervalos = generarIntervalos($hora_inicio, $hora_fin, $intervalo);

    // Obtener los turnos ya ocupados
    $turnosOcupados = obtenerTurnosOcupados($id_medico, $fecha, $conn);

    // Filtrar horarios disponibles
    $horariosDisponibles = array_diff($intervalos, $turnosOcupados);

    // Enviar los horarios como respuesta JSON para que el frontend los reciba
    echo json_encode(['horarios' => $horariosDisponibles]);
} else {
    echo json_encode(['error' => 'No se encontraron horarios para el médico en ese día.']);
}
?>

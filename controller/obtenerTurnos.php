<?php
// controller/obtenerTurnos.php

require_once '../config/database.php';
require_once '../models/TurnoModel.php';

header('Content-Type: application/json');

$turnoModel = new TurnoModel($conn);

// Obtener todos los turnos
$turnos = $turnoModel->obtenerTurnos();

// Convertir los turnos al formato que FullCalendar entiende
$eventosTurnos = [];
foreach ($turnos as $turno) {
    // Extraer la fecha y hora de 'fecha_hora'
    $fecha_hora = $turno['fecha_hora'];
    // Asumir una duración fija, por ejemplo, 1 hora por turno
    $hora_inicio = $fecha_hora;
    $hora_fin = date('Y-m-d H:i:s', strtotime($fecha_hora . ' +1 hour'));
    
    $eventosTurnos[] = [
        'title' => 'Turno: ' . $turno['paciente_nombre'] . ' ' . $turno['paciente_apellido'],
        'start' => $hora_inicio,
        'end' => $hora_fin,
        'color' => '#FF6F61', // Rojo para turnos ocupados
        'editable' => false
    ];
}

echo json_encode($eventosTurnos);
?>

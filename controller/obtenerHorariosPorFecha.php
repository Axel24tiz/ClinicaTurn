<?php
require_once '../config/database.php';
require_once '../models/HorarioModel.php';

$id_medico = isset($_GET['id_medico']) ? intval($_GET['id_medico']) : 0;
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';

if ($id_medico > 0 && !empty($fecha)) {
    $horarioModel = new HorarioModel($conn);
    $diaSemana = date('l', strtotime($fecha));  // Obtiene el día de la semana para la fecha seleccionada
    $horarios = $horarioModel->obtenerHorariosPorDiaSemana($id_medico, $diaSemana);

    if (!empty($horarios)) {
        echo json_encode($horarios);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

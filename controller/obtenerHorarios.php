<?php
require_once '../config/database.php';
require_once '../models/HorarioModel.php';

$id_medico = isset($_GET['id_medico']) ? intval($_GET['id_medico']) : 0;

if ($id_medico > 0) {
    $horarioModel = new HorarioModel($conn);

    // Obtener los horarios disponibles
    $horarios = $horarioModel->obtenerHorarioMedico($id_medico);

    // Convertir los horarios a eventos para FullCalendar
    $eventos = [];
    foreach ($horarios as $horario) {
        // Supón que hoy es lunes, puedes generar fechas futuras basándote en los días de la semana.
        $diaSemanaNumero = date('w', strtotime($horario['dia_semana']));  // Convertir 'Lunes', etc., a números
        $startDate = new DateTime();
        $startDate->modify("next " . $horario['dia_semana']);  // Mueve la fecha al próximo lunes, martes, etc.
    
        // Combinar fecha con la hora de inicio y fin
        $startDate->setTime(explode(':', $horario['hora_inicio'])[0], explode(':', $horario['hora_inicio'])[1]);
        $endDate = clone $startDate;
        $endDate->setTime(explode(':', $horario['hora_fin'])[0], explode(':', $horario['hora_fin'])[1]);
    
        // Solo agrega el evento si está en una fecha futura
        if ($startDate >= new DateTime()) {
            $eventos[] = [
                'title' => 'Disponible',
                'start' => $startDate->format('Y-m-d\TH:i:s'),
                'end' => $endDate->format('Y-m-d\TH:i:s'),
                'color' => 'green'
            ];
        }
    }
    echo json_encode($eventos);
} else {
    echo json_encode([]);
}
?>

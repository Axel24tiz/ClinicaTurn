<?php
require_once '../config/database.php';

$id_medico = $_GET['id_medico'] ?? 0;

try {
    // Preparar la consulta SQL
    $query = "SELECT dia_semana, hora_inicio, hora_fin FROM horariomedico WHERE id_medico = :id_medico";
    $stmt = $conn->prepare($query);
    
    // Asignar el parámetro
    $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $dias_laborales = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dias_laborales[] = [
            'title' => 'Disponible',
            'start' => obtenerFechaProxima($row['dia_semana']),
            'end' => obtenerFechaProxima($row['dia_semana']),
            'color' => '#008000' // Verde
        ];
    }

    // Devolver los resultados en formato JSON
    echo json_encode($dias_laborales);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Función para obtener la próxima fecha de un día de la semana
function obtenerFechaProxima($dia_semana) {
    $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    $hoy = date('N') - 1; // N: día de la semana (1: Lunes, 7: Domingo)
    $dia_objetivo = array_search($dia_semana, $dias);

    // Calcular la diferencia de días
    $diferencia = $dia_objetivo - $hoy;
    if ($diferencia < 0) {
        $diferencia += 7; // Ajustar para la próxima semana
    }

    return date('Y-m-d', strtotime("+$diferencia days"));
}
?>

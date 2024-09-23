<?php
require_once '../config/database.php';

$id_medico = $_GET['id_medico'] ?? 0;

try {
    // Preparar la consulta SQL
    $query = "SELECT fecha, hora FROM turno WHERE id_medico = :id_medico AND estado IN ('pendiente', 'confirmado')";
    $stmt = $conn->prepare($query);
    
    // Asignar el parámetro
    $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $turnos_ocupados = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $turnos_ocupados[] = [
            'title' => 'Ocupado',
            'start' => $row['fecha'] . 'T' . $row['hora'],
            'color' => '#FF0000' // Rojo
        ];
    }

    // Devolver los resultados en formato JSON
    echo json_encode($turnos_ocupados);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

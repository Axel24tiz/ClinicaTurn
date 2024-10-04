<?php
require_once '../config/database.php';
require_once '../models/EspecialidadModel.php';
require_once '../models/ObraSocialModel.php';

$especialidadModel = new EspecialidadModel($conn);
$especialidades = $especialidadModel->obtenerEspecialidades();

$obraSocialModel = new ObraSocialModel($conn);
$coberturas = $obraSocialModel->obtenerObrasSociales();

$nombre = isset($_GET['name']) ? trim($_GET['name']) : '';
$especialidad = isset($_GET['specialty']) ? trim($_GET['specialty']) : '';
$obra_social = isset($_GET['obra_social']) ? trim($_GET['obra_social']) : '';

// Consulta extendida con obras sociales y disponibilidad de horario
$query = "SELECT medico.id_medico, medico.nombre, medico.apellido, especialidad.nombre AS especialidad,
                 GROUP_CONCAT(DISTINCT obrasocial.nombre SEPARATOR ', ') AS obras_sociales,
                 horariomedico.hora_inicio, horariomedico.hora_fin
          FROM medico
          LEFT JOIN especialidad ON medico.id_especialidad = especialidad.id_especialidad
          LEFT JOIN medico_obrasocial ON medico.id_medico = medico_obrasocial.id_medico
          LEFT JOIN obrasocial ON medico_obrasocial.id_obra_social = obrasocial.id_obra_social
          LEFT JOIN horariomedico ON medico.id_medico = horariomedico.id_medico
          WHERE 1 = 1";

if (!empty($nombre)) {
    $query .= " AND (medico.nombre LIKE :nombre OR medico.apellido LIKE :nombre)";
}
if (!empty($especialidad)) {
    $query .= " AND especialidad.nombre = :especialidad";
}
if (!empty($obra_social)) {
    $query .= " AND obrasocial.id_obra_social = :obra_social";
}

$query .= " GROUP BY medico.id_medico";

$stmt = $conn->prepare($query);

// Vincula parámetros solo si no están vacíos
if (!empty($nombre)) {
    $stmt->bindValue(':nombre', "%$nombre%", PDO::PARAM_STR);
}
if (!empty($especialidad)) {
    $stmt->bindValue(':especialidad', $especialidad, PDO::PARAM_STR);
}
if (!empty($obra_social)) {
    $stmt->bindValue(':obra_social', $obra_social, PDO::PARAM_INT);
}

$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Incluir la vista para mostrar los resultados
include '../views/searchResultsView.php';
?>

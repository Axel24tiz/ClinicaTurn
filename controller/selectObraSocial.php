<?php
// Incluir el archivo de conexión a la base de datos y el modelo de obra social
require_once '../config/database.php';
require_once '../models/ObraSocialModel.php';

session_start(); // Iniciar sesión para guardar la información temporalmente

// Verificar si el usuario ha enviado el formulario con el paciente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Guardar la información del paciente en la sesión
    $paciente = [
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'email' => $_POST['email'],
        'relacion' => $_POST['relacion'],  // Para determinar si es para el usuario o un familiar
    ];

    $_SESSION['paciente'] = $paciente; // Guardar en sesión

    // Crear instancia del modelo de Obra Social
    $obraSocialModel = new ObraSocialModel($conn);

    // Obtener todas las obras sociales desde la base de datos
    $obras_sociales = $obraSocialModel->obtenerObrasSociales();

    // Verificar si hay resultados
    if (empty($obras_sociales)) {
        echo "No se encontraron obras sociales.";
        exit();
    }

    // Mostrar el formulario de selección de obra social
    include '../views/selectObraSocialView.php';
} else {
    echo "Error: No se envió información del paciente.";
    exit();
}
?>

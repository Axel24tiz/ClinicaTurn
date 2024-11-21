<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'coneccion.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$request = explode('/', $requestUri);
//echo ($request[2]);
$id = isset($request[2]) ? intval($request[2]) : null;

switch ($method) {
    case 'GET':
        if ($request[0] == 'estados') {
            // Obtener todos los estados
            $stmt = $pdo->query("SELECT * FROM estado");
            $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($estados);
        } else if ($id) {
            // Obtener una tarea por ID
            $stmt = $pdo->prepare("SELECT * FROM profesional WHERE id = ?");
            $stmt->execute([$id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($task);
        } else {
            // Obtener todas las tareas
            $stmt = $pdo->query("SELECT * FROM profesional");
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tasks);
        }
        break;

    case 'POST':
        // Crear una nueva tarea
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO profesional (dniProf, abreviaturaProf, apellidoProf, nombreProf, especialidad) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['dni'], $data['abreviatura'], $data['apellido'], $data['nombre'], $data['especialidad']]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        // Actualizar una tarea existente
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE profesional SET dniProf = ?, abreviaturaProf = ?, apellidoProf = ?, nombreProf = ?, especialidad = ? WHERE id = ?");
        $stmt->execute([$data['dni'], $data['abreviatura'], $data['apellido'], $data['nombre'], $data['especialidad'], $id]);
        echo json_encode(['id' => $id]);
        break;

    case 'DELETE':
        // Eliminar una tarea
        $stmt = $pdo->prepare("DELETE FROM profesional WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['id' => $id]);
        break;

    default:
        echo json_encode(['error' => 'Method Not Allowed']);
        http_response_code(405);
        break;
}

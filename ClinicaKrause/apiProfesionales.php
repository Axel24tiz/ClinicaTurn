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
$id = isset($request[3]) ? intval($request[3]) : null;

switch ($method) {
    case 'GET':
        if ($request[0] == 'estados') {
            // Obtener todos los estados
            $stmt = $pdo->query("SELECT * FROM estado");
            $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($estados);
        } else if ($id) {
            // Obtener una tarea por ID
            $stmt = $pdo->prepare("SELECT * FROM medico WHERE id_medico = ?");
            $stmt->execute([$id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($task);
        } else {
            // Obtener todas las tareas
            $stmt = $pdo->query("SELECT * FROM medico");
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tasks);
        }
        break;

    case 'POST':
        // Crear una nueva tarea
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO medico (apellido, nombre, id_especialidad) VALUES (?, ?, ?)");
        $stmt->execute([$data['apellido'], $data['nombre'], $data['especialidad']]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        // Actualizar una tarea existente
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE medico SET apellido = ?, nombre = ?, id_especialidad = ? WHERE id_medico = ?");
        $stmt->execute([$data['apellido'], $data['nombre'], $data['especialidad'], $id]);
        echo json_encode(['id_medico' => $id]);
        break;

    case 'DELETE':
        // Eliminar una tarea
        $stmt = $pdo->prepare("DELETE FROM medico WHERE id_medico = ?");
        $stmt->execute([$id]);
        echo json_encode(['id_medico' => $id]);
        break;

    default:
        echo json_encode(['error' => 'Method Not Allowed']);
        http_response_code(405);
        break;
}

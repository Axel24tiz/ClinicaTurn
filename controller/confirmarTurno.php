
<?php
require_once '../config/database.php';

$id_medico = $_POST['id_medico'];
$dni = $_POST['dni'];
$nombre = $_POST['nombre_paciente'];
$apellido = $_POST['apellido_paciente'];
$tipo_turno = $_POST['tipo_turno'];
$fecha_hora = $_POST['fecha_hora'];
$fecha = date('Y-m-d', strtotime($fecha_hora));  
$hora = date('H:i:s', strtotime($fecha_hora));   
$edad = $_POST['edad'];
$email = $_POST['email_paciente'];
$telefono = $_POST['telefono'];
$sobre_turno = isset($_POST['sobre_turno']) ? 1 : 0;

// Si selecciona obra social, obtener obra social y número de carnet
$obra_social_id = $tipo_turno === 'obra_social' ? $_POST['obra_social'] : null;
$numero_carnet = $tipo_turno === 'obra_social' ? $_POST['numero_carnet'] : null;

// Verifica si el DNI existe
$query = "SELECT id_paciente FROM paciente WHERE dni = :dni";
$stmt = $conn->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->execute();
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($paciente) {
    // Si el paciente ya existe, obtenemos su ID
    $id_paciente = $paciente['id_paciente'];
} else {
    // Si no existe, creamos un nuevo registro en la tabla paciente
    $query = "INSERT INTO paciente (dni, nombre, apellido, obra_social_id, numero_carnet, edad, email, telefono, created_at) 
              VALUES (:dni, :nombre, :apellido, :obra_social_id, :numero_carnet, :edad, :email, :telefono, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':obra_social_id', $obra_social_id);
    $stmt->bindParam(':numero_carnet', $numero_carnet);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->execute();

    // Obtener el ID del nuevo paciente
    $id_paciente = $conn->lastInsertId();
}

// Calcular el monto a pagar según el tipo de turno
if ($tipo_turno === 'particular') {
    $monto_a_pagar = 15000;  // Ejemplo de monto para particular
} else if ($tipo_turno === 'obra_social') {
    $monto_a_pagar = 7000;   // Ejemplo de monto para obra social
} else {
    $monto_a_pagar = 0;      // Default en caso de error
}

// Insertar el turno en la tabla de turnos
$query = "INSERT INTO turno (id_paciente, id_medico, tipo_turno, fecha, hora, sobre_turno, estado, monto_a_pagar) 
          VALUES (:id_paciente, :id_medico, :tipo_turno, :fecha, :hora, :sobre_turno, 'pendiente', :monto_a_pagar)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_paciente', $id_paciente);
$stmt->bindParam(':id_medico', $id_medico);
$stmt->bindParam(':tipo_turno', $tipo_turno);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':hora', $hora);
$stmt->bindParam(':sobre_turno', $sobre_turno);
$stmt->bindParam(':monto_a_pagar', $monto_a_pagar);
$stmt->execute();

echo "Turno registrado exitosamente.";
?>

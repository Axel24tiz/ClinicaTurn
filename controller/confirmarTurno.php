<?php
require_once '../config/database.php';
require_once '../libs/PHPMailer/PHPMailer.php';
require_once '../libs/PHPMailer/SMTP.php';
require_once '../libs/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Obtener los datos del formulario
$id_medico = $_POST['id_medico'];
$dni = $_POST['dni'];
$nombre = $_POST['nombre_paciente'];
$apellido = $_POST['apellido_paciente'];
$tipo_turno = $_POST['tipo_turno'];
$fecha_hora = $_POST['fecha_hora'];
$fecha = date('Y-m-d', strtotime($fecha_hora));
$hora = date('H:i:s', strtotime($fecha_hora));
$email = $_POST['email_paciente'];
$sobre_turno = isset($_POST['sobre_turno']) ? 1 : 0;

$obra_social_id = $tipo_turno === 'obra_social' ? $_POST['obra_social'] : null;
$numero_carnet = $tipo_turno === 'obra_social' ? $_POST['numero_carnet'] : null;

// Verificar si el paciente ya está registrado
$query = "SELECT id_paciente FROM paciente WHERE dni = :dni";
$stmt = $conn->prepare($query);
$stmt->bindParam(':dni', $dni);
$stmt->execute();
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if ($paciente) {
    $id_paciente = $paciente['id_paciente'];
} else {
    $query = "INSERT INTO paciente (dni, nombre, apellido, obra_social_id, numero_carnet, email, created_at) 
              VALUES (:dni, :nombre, :apellido, :obra_social_id, :numero_carnet, :email, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':obra_social_id', $obra_social_id);
    $stmt->bindParam(':numero_carnet', $numero_carnet);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $id_paciente = $conn->lastInsertId();
}

// Calcular el monto a pagar
$monto_a_pagar = ($tipo_turno === 'particular') ? 15000 : 7000;

// Insertar el turno
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

// Obtener el nombre completo del médico
$query = "SELECT TRIM(CONCAT(nombre, ' ', apellido)) AS nombre_completo FROM medico WHERE id_medico = :id_medico";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
$stmt->execute();
$medico = $stmt->fetch(PDO::FETCH_ASSOC);

$nombre_medico = $medico ? $medico['nombre_completo'] : 'Médico no especificado';

// Configuración del correo
$cuentaRemitente = 'notificacioneskrause@gmail.com';
$PassCuentaRemitente = 'ziez xztl nfad eomh';
$Asunto = "Constancia del turno";
$Mensaje = "
    <h1>Turno Pendiente</h1>
    <p>Estimado/a <b>$nombre $apellido</b>,</p>
    <p>Su turno ha sido ingresado con éxito. Por favor, encuentre los detalles a continuación:</p>
    <ul>
        <li><b>Fecha:</b> $fecha</li>
        <li><b>Hora:</b> $hora</li>
        <li><b>Tipo de Turno:</b> $tipo_turno</li>
        <li><b>Médico:</b> Dr./Dra. $nombre_medico</li>
    </ul>
    <p>Por favor, llegue 30 minutos antes para confirmar su asistencia con la secretaría.</p>
    <p>Atentamente,</p>
    <p><b>Clinica Ottokrause</b></p>
";
$MensajeAlterno = "Su turno ha sido confirmado para el $fecha a las $hora con el médico $nombre_medico.";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = $cuentaRemitente;
    $mail->Password = $PassCuentaRemitente;

    $mail->setFrom($cuentaRemitente, 'Clinica Ottokrause');
    $mail->addAddress($email, "$nombre $apellido");

    $mail->IsHTML(true);
    $mail->Subject = $Asunto;
    $mail->addEmbeddedImage('../views/clinicakrause.jpeg', 'logo_img', 'clinicakrause.jpeg');
    $mail->Body = "
    <h1>Turno Confirmado</h1>
    <img src='cid:logo_img' alt='Clinica Ottokrause' style='max-width:200px;'>
    <p>Estimado/a <b>$nombre $apellido</b>,</p>
    <p>Su turno ha sido confirmado con éxito. Por favor, encuentre los detalles a continuación:</p>
    <ul>
        <li><b>Fecha:</b> $fecha</li>
        <li><b>Hora:</b> $hora</li>
        <li><b>Tipo de Turno:</b> $tipo_turno</li>
        <li><b>Médico:</b> Dr./Dra. $nombre_medico</li>
    </ul>
    <p>Por favor, llegue 30 minutos antes para confirmar su asistencia con la secretaría.</p>
    <p>Atentamente,</p>
    <p><b>Clinica Ottokrause</b></p>
";

$mail->AltBody = "Turno Confirmado - Clinica Ottokrause\nEstimado/a $nombre $apellido,\nSu turno ha sido confirmado:\nFecha: $fecha\nHora: $hora\nMédico: Dr./Dra. $nombre_medico\nPor favor, llegue 30 minutos antes.";



    $mail->send();
    echo "Turno registrado exitosamente. Correo enviado.";
} catch (Exception $e) {
    echo "Turno registrado exitosamente, pero hubo un problema al enviar el correo: {$mail->ErrorInfo}";
}

session_start();
$_SESSION['turno_confirmado'] = [
    'id_medico' => $id_medico,
    'nombre_medico' => $nombre_medico,
    'fecha' => $fecha,
    'hora' => $hora,
    'tipo_turno' => $tipo_turno,
    'nombre_paciente' => $nombre,
    'apellido_paciente' => $apellido,
    'email' => $email,
    'telefono' => $telefono,
];

header('Location: ../views/citaconfirmadaView.php');
exit;
?>

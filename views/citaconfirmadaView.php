<!-- views/citaconfirmadaView.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Turno Confirmado</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="confirmacion-turno">
        <h1>¡Turno Agendado con Éxito!</h1>
        <p>Gracias por agendar tu turno. A continuación, encontrarás los detalles:</p>

        <ul>
            <li><strong>Médico:</strong> <?php echo htmlspecialchars($medico['nombre'] . ' ' . $medico['apellido']); ?></li>
            <li><strong>Fecha y Hora:</strong> <?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($fecha_hora))); ?></li>
            <li><strong>Tipo de Turno:</strong> <?php echo htmlspecialchars(ucfirst($tipo_turno)); ?></li>
            <li><strong>Monto a Pagar:</strong> $<?php echo number_format($monto_a_pagar, 2); ?></li>
            <li><strong>Correo de Confirmación:</strong> <?php echo htmlspecialchars($email); ?></li>
        </ul>

        <p>Revisa tu correo electrónico para obtener el código QR con los detalles de tu turno.</p>

        <a href="../index.php" class="btn-naranja">Volver a la Página Principal</a>
    </div>
</body>
</html>

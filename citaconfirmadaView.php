<?php
session_start();

if (!isset($_SESSION['turno_confirmado'])) {
    echo "No hay información de turno disponible.";
    exit;
}

$turno = $_SESSION['turno_confirmado'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turno Confirmado</title>
    <link rel="stylesheet" href="../clinicaindex.css">
    <style>
        .container {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin: 20px 0;
        }
        .details th {
            text-align: left;
            padding-right: 15px;
        }
        .details td {
            padding-bottom: 10px;
        }
        .actions {
            margin-top: 20px;
            text-align: center;
        }
        .actions button {
            margin: 5px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-download {
            background-color: #007bff;
            color: #fff;
        }
        .btn-download:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../views/CLINICA_KRAUSE.png" alt="Clinica Ottokrause" width="150">
        </div>
        <h1>Turno pendiente</h1>
        <div class="text-center mt-4">
            <a href="../clinicaweb.php" class="btn btn-primary">Volver al Inicio</a>
        </div>
        <p>Estimado/a <b><?php echo htmlspecialchars($turno['nombre_paciente'] . ' ' . $turno['apellido_paciente']); ?></b>,</p>
        <p>Su turno ha sido ingresado con éxito. Por favor, encuentre los detalles a continuación:</p>

        <table class="details">
            <tr>
                <th>Fecha:</th>
                <td><?php echo htmlspecialchars($turno['fecha']); ?></td>
            </tr>
            <tr>
                <th>Hora:</th>
                <td><?php echo htmlspecialchars($turno['hora']); ?></td>
            </tr>
            <tr>
                <th>Médico:</th>
                <td>Dr./Dra. <?php echo htmlspecialchars($turno['nombre_medico']); ?></td>
            </tr>
            <tr>
                <th>Tipo de Turno:</th>
                <td><?php echo htmlspecialchars($turno['tipo_turno']); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($turno['email']); ?></td>
            </tr>
            </table>
        <p style='margin-top: 30px; font-size: 14px;'>Por favor, llegue 30 minutos antes para confirmar su asistencia con la secretaría.</p>

        <div class="actions">
            <form action="generarPDF.php" method="POST" style="display: inline;">
                <button type="submit" class="btn-download">Descargar como PDF</button>
            </form>
        </div>
    </div>
</body>
</html>

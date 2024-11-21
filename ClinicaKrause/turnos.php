<?php
// Configuración de conexión
$host = 'localhost';
$dbname = 'clinica';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta para obtener los turnos
$sql = "
    SELECT 
        DAYNAME(fecha_hora) AS dia,
        TIME(fecha_hora) AS hora,
        COUNT(*) AS cantidad
    FROM Turnos
    GROUP BY dia, hora
    ORDER BY fecha_hora
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$horas = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
$dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Semanales</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h2>Turnos Semanales</h2>
    <table>
        <thead>
            <tr>
                <th>Hora/Día</th>
                <?php foreach ($dias as $dia): ?>
                    <th><?php echo $dia; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horas as $hora): ?>
                <tr>
                    <td><?php echo $hora; ?></td>
                    <?php foreach ($dias as $dia): ?>
                        <td>
                            <?php
                            $cantidad = 0;
                            foreach ($turnos as $turno) {
                                if ($turno['dia'] == $dia && $turno['hora'] == $hora) {
                                    $cantidad = $turno['cantidad'];
                                    break;
                                }
                            }
                            echo $cantidad ? $cantidad . ' turnos' : 'No hay turnos';
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
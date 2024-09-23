<!-- views/programarCitaView.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Programar Cita</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Programar Cita con <?php echo htmlspecialchars($medico['nombre'] . ' ' . $medico['apellido']); ?></h1>

    <form action="createAppointment.php" method="POST">
        <input type="hidden" name="id_medico" value="<?php echo $medico['id_medico']; ?>">

        <div class="form-group">
            <label for="id_paciente">Seleccionar Paciente:</label>
            <select name="id_paciente" id="id_paciente" required>
                <option value="" selected disabled>Selecciona un paciente</option>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?php echo htmlspecialchars($paciente['id_paciente']); ?>">
                        <?php echo htmlspecialchars($paciente['nombre'] . ' ' . $paciente['apellido']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_turno">Tipo de Turno:</label>
            <select name="tipo_turno" id="tipo_turno" required onchange="toggleObraSocial()">
                <option value="" selected disabled>Selecciona el tipo de turno</option>
                <option value="particular">Particular</option>
                <option value="obra_social">Obra Social</option>
            </select>
        </div>

        <div class="form-group" id="obra_social_group" style="display: none;">
            <label for="id_obra_social">Obra Social:</label>
            <select name="id_obra_social" id="id_obra_social">
                <option value="" selected disabled>Selecciona una obra social</option>
                <?php foreach ($obras as $obra): ?>
                    <option value="<?php echo htmlspecialchars($obra['id_obra_social']); ?>">
                        <?php echo htmlspecialchars($obra['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_hora">Seleccionar Fecha y Hora:</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" required>
        </div>

        <div class="form-group">
            <label for="sobre_turno">¿Es un Sobre Turno?</label>
            <input type="checkbox" name="sobre_turno" id="sobre_turno" value="1">
        </div>

        <button type="submit">Confirmar Cita</button>
    </form>

    <a href="../index.php">Volver a la búsqueda</a>

    <script>
        function toggleObraSocial() {
            var tipoTurno = document.getElementById('tipo_turno').value;
            var obraSocialGroup = document.getElementById('obra_social_group');
            if (tipoTurno === 'obra_social') {
                obraSocialGroup.style.display = 'block';
                document.getElementById('id_obra_social').required = true;
            } else {
                obraSocialGroup.style.display = 'none';
                document.getElementById('id_obra_social').required = false;
            }
        }
    </script>
</body>
</html>

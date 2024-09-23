<form action="../controller/selectObraSocial.php" method="POST">
    <label for="paciente">¿Para quién es el turno?</label>
    <select name="paciente" id="paciente">
        <option value="mi">Para mí</option>
        <option value="familiar">Para un familiar</option>
    </select>

    <label for="cobertura">Cobertura Médica:</label>
    <select name="cobertura" id="cobertura">
        <!-- Aquí llenas las coberturas dinámicamente desde la base de datos -->
        <?php foreach ($coberturas as $cobertura): ?>
            <option value="<?php echo $cobertura['id_obra_social']; ?>"><?php echo $cobertura['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="fecha">¿Qué día prefieres?</label>
    <input type="date" name="fecha" id="fecha" min="<?php echo date('Y-m-d'); ?>">

    <label for="horario">¿Qué horario prefieres?</label>
    <select name="horario" id="horario">
        <!-- Llenas horarios dinámicamente dependiendo de la disponibilidad -->
    </select>

    <button type="submit">Continuar</button>
</form>

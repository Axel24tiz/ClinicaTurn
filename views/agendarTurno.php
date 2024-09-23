<!-- Selector de fecha (Calendario) -->
<input type="date" id="fecha" name="fecha" onchange="obtenerHorariosDisponibles()">

<!-- Selector de médico -->
<select id="id_medico_modal" name="id_medico">
  <!-- Opciones de médicos -->
</select>

<!-- Selector de horario -->
<select id="hora_disponible" name="hora">
    <option value="" disabled selected>Selecciona una hora</option>
</select>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function obtenerHorariosDisponibles() {
    var fecha = $('#fecha').val();
    var idMedico = $('#id_medico_modal').val();

    if (fecha && idMedico) {
        $.ajax({
            url: 'controllers/obtenerHorariosDisponibles.php',
            type: 'GET',
            data: {
                fecha: fecha,
                id_medico: idMedico
            },
            success: function(response) {
                // Limpiar el select de horarios
                $('#hora_disponible').empty().append('<option value="" disabled selected>Selecciona una hora</option>');

                // Agregar las opciones disponibles
                $.each(response.horarios, function(index, hora) {
                    $('#hora_disponible').append('<option value="' + hora + '">' + hora + '</option>');
                });
            },
            error: function() {
                alert('Error al obtener los horarios disponibles.');
            }
        });
    }
}
</script>

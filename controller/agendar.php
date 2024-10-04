<?php

require_once '../config/database.php';
require_once '../models/PacienteModel.php';
require_once '../models/ObraSocialModel.php';
require_once '../models/MedicoModel.php';
require_once '../models/TurnoModel.php';

// Crear instancias de los modelos
$pacienteModel = new PacienteModel($conn);
$obraSocialModel = new ObraSocialModel($conn);
$medicoModel = new MedicoModel($conn);
$turnoModel = new TurnoModel($conn);

// Obtener el ID del médico desde GET
$id_medico = isset($_GET['id_medico']) ? intval($_GET['id_medico']) : 0;

if ($id_medico <= 0) {
    echo "Médico no válido.";
    exit;
}

$year = date("Y");

// Obtener feriados de Argentina usando la API de Nager.Date
$feriados = [];
$api_url = "https://date.nager.at/api/v3/PublicHolidays/$year/AR";

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar errores
if(curl_errno($ch)){
    echo 'Error al obtener feriados: ' . curl_error($ch);
    $feriados = [];
} else {
    $feriados = json_decode($response, true);
}

curl_close($ch);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Turno</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../style.css">
    
    <!-- Bootstrap CSS (para el modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <!-- Bootstrap JS (para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>

        .fc-day-available {
            background-color: #cfffca !important; /* Verde para turnos disponibles */
            cursor: pointer;
        }

        .fc-day-occupied {
            background-color: #FF6F61 !important; /* Rojo para turnos ocupados */
            cursor: not-allowed;
        }

        .fc-day-holiday {
            background-color: #D3D3D3 !important; /* Gris para feriados */
            cursor: not-allowed;
        }

        /* Estilos para los botones de horarios */
        .btn-horario {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            background-color: #f39c12;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-horario:hover {
            background-color: #e67e22;
        }

        /* Ocultar el contenedor de horarios inicialmente */
        #horariosDisponibles {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Seleccione un horario disponible</h2>

    <!-- Calendario donde se mostrarán los horarios disponibles -->
    <div id="calendar"></div>

    <!-- Modal para agendar turno -->
    <div class="modal fade" id="agendarModal" tabindex="-1" aria-labelledby="agendarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendarModalLabel">Agendar Turno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal de agendar turno -->
                    <form id="agendarForm" action="confirmarTurno.php" method="POST">
                        <input type="hidden" name="id_medico" id="id_medico_modal" value="<?php echo htmlspecialchars($id_medico); ?>">
                        <input type="hidden" name="fecha_hora" id="fecha_hora_modal">

                        <!-- Datos del paciente -->
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_paciente" class="form-label">Nombre del Paciente</label>
                            <input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_paciente" class="form-label">Apellido del Paciente</label>
                            <input type="text" class="form-control" id="apellido_paciente" name="apellido_paciente" required>
                        </div>

                        <!-- Selección del tipo de turno (particular u obra social) -->
                        <div class="mb-3">
                            <label for="tipo_turno" class="form-label">Tipo de Turno</label>
                            <select class="form-select" id="tipo_turno" name="tipo_turno" required>
                                <option value="" selected disabled>Selecciona el tipo de turno</option>
                                <option value="particular">Particular</option>
                                <option value="obra_social">Obra Social</option>
                            </select>
                        </div>

                        <!-- Obra social y número de carnet (ocultos inicialmente) -->
                        <div class="mb-3" id="divObraSocial" style="display:none;">
                            <label for="obra_social" class="form-label">Obra Social</label>
                            <select class="form-select" id="obra_social" name="obra_social">
                                <option value="" selected disabled>Selecciona una obra social</option>
                                <?php
                                $obrasSociales = $obraSocialModel->obtenerObrasSociales();
                                foreach ($obrasSociales as $obra) {
                                    echo '<option value="' . htmlspecialchars($obra['id_obra_social']) . '">' . htmlspecialchars($obra['nombre']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3" id="divNumeroCarnet" style="display:none;">
                            <label for="numero_carnet" class="form-label">Número de Carnet</label>
                            <input type="text" class="form-control" id="numero_carnet" name="numero_carnet">
                        </div>

                        <!-- Otros datos del paciente -->
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_paciente" class="form-label">Email del Paciente</label>
                            <input type="email" class="form-control" id="email_paciente" name="email_paciente" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sobre_turno" name="sobre_turno">
                            <label class="form-check-label" for="sobre_turno">¿Es un Sobre Turno?</label>
                        </div>

                        <!-- Mostrar horarios disponibles -->
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horario Disponible</label>
                            <select class="form-select" id="horario_seleccionado" name="horario_seleccionado" required>
                                <option value="" selected disabled>Seleccione un horario</option>
                                <!-- Horarios se cargarán dinámicamente vía JavaScript -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirmar Turno</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JS (para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
$(document).ready(function() {

    // Mostrar u ocultar el campo de obra social según la selección del tipo de turno
    $('#tipo_turno').change(function() {
        var tipoTurno = $(this).val();
        if (tipoTurno === 'obra_social') {
            $('#divObraSocial').show();
        } else {
            $('#divObraSocial').hide();
        }
    });

    $('#agendarModal').on('show.bs.modal', function() {
    const id_medico = $('#id_medico_modal').val();
    const fecha = $('#fecha_hora_modal').val();

    if (fecha) {
        $.ajax({
            url: '../controller/verificarDisponibilidadDia.php',
            type: 'GET',
            data: { id_medico: id_medico, fecha: fecha },
            success: function(response) {
                const data = JSON.parse(response);
                const horariosSelect = $('#horario_seleccionado');
                horariosSelect.empty();
                if (data.disponible) {
                    horariosSelect.append('<option value="" selected disabled>Seleccione un horario</option>');
                    data.horarios.forEach(function(horario) {
                        horariosSelect.append('<option value="' + horario + '">' + horario + '</option>');
                    });
                } else {
                    horariosSelect.append('<option value="" selected disabled>No hay horarios disponibles</option>');
                }
            },
            error: function() {
                $('#horario_seleccionado').html('<option value="" selected disabled>Error al cargar los horarios</option>');
            }
        });
    }
});

// Enviar el formulario con la hora seleccionada
$('#agendarForm').on('submit', function(event) {
    event.preventDefault(); // Evitar el envío por defecto

    // Obtener la hora seleccionada
    const horaSeleccionada = $('#horario_seleccionado').val();
    const fecha = $('#fecha_hora_modal').val();

    if (!horaSeleccionada) {
        alert('Debe seleccionar un horario');
        return;
    }

    // Combinar la fecha y la hora seleccionada
    const fechaHoraCompleta = fecha + ' ' + horaSeleccionada;

    // Asignar al campo oculto
    $('#fecha_hora_modal').val(fechaHoraCompleta);

    // Ahora enviar el formulario
    this.submit();
});

    
    var id_medico = $("#id_medico_modal").val();
    var calendarEl = document.getElementById('calendar');
    
    var eventosFeriados = <?php echo json_encode($feriados); ?>.map(function(feriado) {
        return {
            title: feriado.localName,
            start: feriado.date,
            allDay: true,
            display: 'background',
            color: '#281002',
            overlap: false,
            editable: false
        };
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        validRange: {
            start: new Date() 
        },
        selectable: true,
        selectMirror: true,
        eventSources: [
            // Feriados
            { events: eventosFeriados, color: '#281002', textColor: '#000' },
            { url: '../controller/obtenerDiasLaborales.php', color: '#008000', textColor: '#FFF', allDay: true },
            { url: '../controller/obtenerTurnosOcupados.php', color: '#FF0000', textColor: '#FFF', allDay: false }
        ],
        dateClick: function(info) {
            var fechaSeleccionada = info.dateStr;

            $.ajax({
                url: 'verificarDisponibilidadDia.php',
                type: 'GET',
                data: { fecha: fechaSeleccionada, id_medico: id_medico },
                success: function(response) {
                    var resultado = JSON.parse(response);

                    if (resultado.ocupado) {
                        alert('No hay turnos disponibles en esta fecha.');
                    } else if (resultado.disponible) {
                        mostrarModalAgendar(fechaSeleccionada);
                    }
                },
                error: function() {
                    alert('Error al verificar la disponibilidad del día.');
                }
            });
        },
        dayCellDidMount: function(info) {
    const fecha = info.date.toISOString().split('T')[0]; // YYYY-MM-DD
    $.ajax({
        url: 'verificarDisponibilidadDia.php',
        type: 'GET',
        data: { fecha: fecha, id_medico: id_medico },
        success: function(response) {
            const resultado = JSON.parse(response);

            if (resultado.es_feriado) {
                $(info.el).addClass('fc-day-holiday'); 
                info.el.style.pointerEvents = 'none'; 
                info.el.style.backgroundColor = '#f0f0f0'; 
            } else if (resultado.ocupado) {
                $(info.el).addClass('fc-day-occupied');
            } else if (resultado.disponible) {
                $(info.el).addClass('fc-day-available');
            }
        },
        error: function() {
            console.error('Error al verificar la disponibilidad del día.');
        }
    });
}


    });

    calendar.render();

    // Función para mostrar el modal de agendar turno
    function mostrarModalAgendar(fecha) {
        $('#fecha_hora_modal').val(fecha);  
        $('#agendarForm')[0].reset();  
        var myModal = new bootstrap.Modal(document.getElementById('agendarModal'));
        myModal.show();
    }
});

$(document).ready(function() {
    // Mostrar/ocultar campos de obra social y número de carnet
    $('#tipo_turno').change(function() {
        var tipoTurno = $(this).val();
        if (tipoTurno === 'obra_social') {
            $('#divObraSocial').show();  
            $('#divNumeroCarnet').show(); 
        } else {
            $('#divObraSocial').hide();  
            $('#divNumeroCarnet').hide();
        }
    });

    var id_medico = $("#id_medico_modal").val();
    
});
// Función que se ejecuta al seleccionar un día
function obtenerHorariosDisponibles(fecha, idMedico) {
    $.ajax({
        url: 'obtenerHorariosDisponibles.php', 
        type: 'GET',
        data: {
            fecha: fecha,
            id_medico: idMedico
        },
        success: function(response) {
            // Limpiar el select de horarios
            $('#hora_disponible').empty().append('<option value="" disabled selected>Selecciona una hora</option>');

            $.each(response.horarios, function(index, hora) {
                $('#hora_disponible').append('<option value="' + hora + '">' + hora + '</option>');
            });

            $('#horariosDisponibles').show();
        },
        error: function() {
            alert('Error al obtener los horarios disponibles.');
        }
    });
}

// Seleccionar un día en el calendario
calendar.on('dateClick', function(info) {
    var fecha = info.dateStr;
    var idMedico = $('#id_medico_modal').val();

    obtenerHorariosDisponibles(fecha, idMedico);
});




    </script>
</body>
</html>

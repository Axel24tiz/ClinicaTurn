<!doctype html>
<html lang="es">
<?php include('conexion.php');
//include('db.php');

// $fechaSeleccionada = $_POST['fecha'];
// $id_medico = $_POST['id_medico'];

if (empty($_POST['fecha'])) {
    $fechaSeleccionada = $_GET['fecha'];
} else {
    $fechaSeleccionada = $_POST['fecha'];
}

if (empty($_POST['id_medico'])) {
    $id_medico = $_GET['id_medico'];
} else {
    $id_medico = $_POST['id_medico'];
}

$sql = "select * from medico where id_medico = '$id_medico'";
$res = mysqli_query($conexion_mysql, $sql) or die(mysqli_error());

$medico = mysqli_fetch_assoc($res);

?>

<head>
    <!-- <script src="assets/js/color-modes.js"></script> -->

    <meta charset="utf-8">
    <title>Clinica Krause</title>

    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="styles.css" rel="stylesheet">

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables_custom/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="datatables_custom/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/27464e646d.js" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sl-1.3.4/sr-1.1.0/datatables.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sl-1.3.4/sr-1.1.0/datatables.min.js">
    </script>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="stylesgrillas.css">

    <!-- Java Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydatatable tfoot th ').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Filtrar.." />');
            });
            var table = $('#mydatatable').DataTable({
                "dom": 'B<"float-left"i>t<"float-left"l><"float-right"p><"clearfix">',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel" id="excel" ></i>  ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success',
                        messageTop: "Listado de Turnos "
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf" id="pdf" ></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        messageTop: "Listado de Turnos"
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" id="print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info',
                        messageTop: "Listado de Turnos"
                    },
                    {
                        extend: null, // No especificamos un tipo de extensión, porque usaremos un botón personalizado
                        text: '<input type="button" class="w-100 btn btn-lg btn-primary" value="Agregar Nuevo Turno">',
                        titleAttr: 'Agregar Nuevo Turno',

                        action: function(e, dt, node, config) {
                            // Llamar a la URL cuando se hace clic en el botón
                            window.location.href = 'turnoAlta.php?fecha=<?php echo $fechaSeleccionada; ?>&id_medico=<?php echo $id_medico; ?>';
                        }


                    },
                ],
                "responsive": false,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                "order": [
                    [0, "desc"]
                ],
                "initComplete": function() {
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    })
                }
            });
        });

        $(function() {

            var $body = $(document);
            $body.bind('scroll', function() {
                // "Desactivar" el scroll horizontal
                if ($body.scrollLeft() !== 0) {
                    $body.scrollLeft(0);
                }
            });

        });
    </script>

    <link href="navbars-offcanvas.css" rel="stylesheet">


</head>

<body>

    <header>
        <?php include('banner.html'); ?>
    </header>
    <?php
    include('navbar.html');
    ?>
    <main>
        <div class="bg-body-tertiary p-4 rounded">
            <div class="wrapper">

                <div class="table-responsive" id="mydatatable-container">

                    <table class="table table-secondary" id="mydatatable" style="width:100%">

                        <thead>
                            <tr>
                                <td colspan="8">
                                    <div style="display: flex; justify-content: center; ">
                                        <div>
                                            <h5><strong>Turnos dados con fecha:
                                                    <?php
                                                    // Supongamos que $fechaSeleccionada es una cadena en formato 'Y-m-d'
                                                    // $fechaSeleccionada = '2024-11-03';

                                                    // Crear un objeto DateTime a partir de la fecha
                                                    $date = new DateTime($fechaSeleccionada);

                                                    // Crear un formateador para la fecha
                                                    $formatter = new IntlDateFormatter(
                                                        'es_ES', // Idioma
                                                        IntlDateFormatter::LONG, // Formato de fecha
                                                        IntlDateFormatter::NONE, // Sin formato de hora
                                                        null, // Zona horaria, null para usar la configuración por defecto
                                                        IntlDateFormatter::GREGORIAN, // Calendario gregoriano
                                                        'EEEE, d \'de\' MMMM \'de\' yyyy' // Formato personalizado
                                                    );

                                                    // Formatear la fecha
                                                    $fechaFormateada = $formatter->format($date);

                                                    // Mostrar la fecha formateada
                                                    echo ucfirst($fechaFormateada); // Esto mostrará 'domingo, 3 de noviembre de 2024'
                                                    ?>
                                                </strong></h5>
                                        </div>
                                        <div style="display: flex; justify-content: center; width: 30px; justify-content: center;"> - </div>
                                        <div>
                                            <h5><strong>Profesional: <?php echo $medico['apellido'] . ", " . $medico['nombre']; ?> </strong></h5>
                                        </div>
                                        <!-- <div>
                                            <a href="turnoAlta.php?fecha=<?php echo $fechaSeleccionada; ?>&id_medico=<?php echo $id_medico; ?>">
                                                <input type="button" class="w-100 btn btn-lg btn-primary" value="Agregar Nuevo Turno">
                                            </a>
                                        </div> -->
                                    </div>
                                    <?php

                                    $sql1 = "SELECT t.id_turno,t.fecha, t.hora, t.estado, t.sobre_turno, t.tipo_turno, CONCAT(m.apellido, ', ', m.nombre) AS medico, 
                                    CONCAT(p.apellido, ', ', p.nombre) AS paciente FROM turno t INNER JOIN medico m INNER JOIN paciente p 
                                    ON t.id_medico = m.id_medico AND t.id_paciente = p.id_paciente AND t.fecha = '$fechaSeleccionada' AND t.id_medico = '$id_medico' ORDER BY t.hora ";
                                    $res1 = mysqli_query($conexion_mysql, $sql1) or die(mysqli_error());

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-md-1 well">Hora</th>
                                <th class="col-md-1 well">Estado</th>
                                <th class="col-md-2 well">Medico</th>
                                <th class="col-md-2 well">Paciente</th>
                                <th class="col-md-1 well">Tipo Turno</th>
                                <th class="col-md-1 well">Sobre Turno</th>
                                <th class="col-md-1 well">-</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="col-md-1 well">Hora</th>
                                <th class="col-md-1 well">Estado</th>
                                <th class="col-md-2 well">Medico</th>
                                <th class="col-md-2 well">Paciente</th>
                                <th class="col-md-1 well">Tipo Turno</th>
                                <th class="col-md-1 well">Sobre Turno</th>
                                <td class="col-md-1 well">-</td>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php

                            while ($turnos = mysqli_fetch_array($res1)) {

                            ?>
                                <tr>
                                    <td><?php echo $turnos['hora']; ?>
                                    <td>
                                        <?php
                                        if ($turnos['estado'] == 'confirmado') {
                                        ?>
                                            <button class=" w-100 btn btn-success" disabled> <strong> Confirmado</strong></button>
                                        <?php
                                        }
                                        if ($turnos['estado'] == 'pendiente') {
                                        ?>
                                            <button class=" w-100 btn btn-warning" disabled> <strong> Pendiente</strong></button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $turnos['medico']; ?>
                                    <td title="<?php echo $turnos['paciente']; ?>"><?php echo $turnos['paciente']; ?></td>
                                    <td><?php echo $turnos['tipo_turno']; ?></td>
                                    <td>
                                        <?php
                                        if ($turnos['sobre_turno'] == '1') {
                                        ?>
                                            <button class=" w-100 btn btn-danger" disabled><strong>Sobre Turno</strong></button>
                                        <?php
                                        }
                                        if ($turnos['sobre_turno'] == '0') {
                                        ?>
                                            <button class=" w-100 btn btn-info" disabled> <strong> Normal</strong></button>
                                        <?php
                                        }
                                        ?>
                                    </td>

                                    <td align="center"><a href="#">
                                            <!-- <input type="button" class="w-100 btn btn-sm btn-outline-primary" value="Editar-Borrar"></a></td> -->
                                            <button class="w-100 btn  btn-outline-primary" disabled><strong>Editar-Borrar</strong></button></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <!-- para usar botones en datatables JS -->
    <script src="datatables_custom/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="datatables_custom/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="datatables_custom/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="datatables_custom/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables_custom/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer>
        <?php
        include('footer.html');
        ?>
    </footer>
</body>

</html>
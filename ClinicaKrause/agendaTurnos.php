<!DOCTYPE html>
<html lang="es">
<?php
error_reporting(E_ERROR);
include 'db.php';

$id_medico = $_GET['profesional']; // ID del médico
// Obtener el mes y año actual o desde el formulario
$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('n');
$anio = isset($_GET['anio']) ? (int)$_GET['anio'] : date('Y');

$sql = "SELECT * FROM turno WHERE id_medico = ? AND MONTH(fecha) = ? AND YEAR(fecha) = ? order by hora";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_medico, $mes, $anio]);
$turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>


    <!-- <link rel="stylesheet" href="styles.css"> -->

    <script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyecto de Programación III">
    <meta name="author" content="Nalaniz">

    <title>clinica Krause</title>

    <link href="styles.css" rel="stylesheet">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <!-- Custom styles for this template -->
    <link href="navbars-offcanvas.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .turno {
            cursor: pointer;
        }

        .modal {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Contenedor del formulario */
        .form-container {
            display: flex;
            justify-content: space-between;
            /* Distribuye los elementos de manera equitativa */
            gap: 10px;
            /* Espacio entre los inputs */
            flex-wrap: wrap;
            /* Si hay muchos inputs, hace que se ajusten a una nueva fila */
            max-width: 100%;
            /* Asegura que el formulario ocupe todo el ancho del contenedor */
        }

        /* Estilo de los inputs */
        /* .form-container input {
            flex: 1;
            /* Los inputs ocupan el mismo espacio disponible */
        /* padding: 8px;
        margin: 0;
        box-sizing: border-box; */
        /* Para que el padding no afecte el tamaño del input */
        /* } */

        */

        /* Estilo del formulario */
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
            /* Asegura que el formulario ocupe el 100% del contenedor */
        }
    </style>

</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>


    <?php
    include('botonFondo.html');
    ?>

    <header>
        <?php include('banner.html');
        ?>

    </header>
    <?php
    include('navbar.html');
    ?>
    <main class=" p-4 rounded">

        <div class="wrapper">
            <div class="bg-body-tertiary" style="width: 70%; border-radius: 10px; border: 1px solid #adb5bd; padding: 10px; margin-block: 5px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3); ">

                <h5>Agenda Médica</h5>

                <form method="get" action="">
                    <label for="mes">Mes:</label>
                    <select name="mes" style="width: 70px;">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo $i == $mes ? 'selected' : ''; ?>><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>

                    <label style="width: 10px;"></label>

                    <label for="año">Año: </label>
                    <input type="number" name="anio" value="<?php echo $anio; ?>" required>

                    <label style="width: 10px;"></label>

                    <label for="profesional"> Profesional </label>
                    <select name="profesional" required>
                        <?php
                        include('conexion.php');
                        $sql = "select * from medico";
                        $res = mysqli_query($conexion_mysql, $sql) or die(mysqli_error());
                        ?>
                        <option value="">Seleccione un Profesional </option>
                        <?php
                        while ($profesional = mysqli_fetch_assoc($res)) {
                        ?>
                            <option value="<?php echo $profesional['id_medico']; ?>"><?php echo $profesional['apellido'] . " " . $profesional['nombre']; ?></option>
                        <?php } ?>
                    </select>

                    <label style="width: 10px;"></label>

                    <button class="w-25 btn btn-lg btn-outline-primary" type="submit">Ver Agenda</button>
                </form>
            </div>
            <br>
            <?php
            $sql2 = "select * from medico where id_medico = '$id_medico'";
            $prof = mysqli_query($conexion_mysql, $sql2) or die(mysqli_error());

            $doctor = mysqli_fetch_assoc($prof);
            ?>
            <div class="bg-body-tertiary" style="width: 100%; border-radius: 10px; border: 1px solid #adb5bd; padding: 10px; margin-block: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">
                <h3> Profesional: <b><?php echo $doctor['apellido'] . ", " . $doctor['nombre']; ?></b> </h3>
            </div>
            <?php
            function generateCalendar($month, $year, $turnos)
            {
                $firstDay = date('w', strtotime("$year-$month-01")); // Primer día del mes
                $daysInMonth = date('t', strtotime("$year-$month-01")); // Total de días en el mes

                // Nombres de los días en español
                $dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

                // Nombres de los meses en español
                $monthNames = [
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Septiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                ];

                $table = '<table style="width: 100%; border-radius: 10px; border: 1px solid #adb5bd; padding: 10px; margin-block: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);"><thead>';
                $table .= "<tr class='bg-body-tertiary'><td colspan='7'><h3><b>{$monthNames[$month]} $year</b></h3></td></tr>"; // Encabezado del mes y año
                $table .= '<tr>';

                // Agregar los nombres de los días
                foreach ($dayNames as $dayName) {
                    $table .= "<td class='bg-body-tertiary'><strong>$dayName</strong></td>";
                }

                $table .= '</tr></thead><tbody>';

                // Crea filas para los días del mes
                $dayCounter = 1;
                for ($i = 0; $i < 6; $i++) { // Hasta 6 filas
                    $table .= '<tr>';
                    for ($j = 0; $j < 7; $j++) { // 7 días
                        if ($i === 0 && $j < $firstDay) {
                            $table .= '<td></td>'; // Celdas vacías
                        } elseif ($dayCounter > $daysInMonth) {
                            break; // Salir si ya no hay más días
                        } else {
                            // Filtra los turnos por fecha completa
                            $turnosDelDia = array_filter($turnos, function ($turno) use ($dayCounter, $month, $year) {
                                $turnoDate = new DateTime($turno['fecha']);
                                return (
                                    $turnoDate->format('j') == $dayCounter &&
                                    $turnoDate->format('n') == $month &&
                                    $turnoDate->format('Y') == $year
                                );
                            });

                            $turnosText = implode('<br>', array_map(function ($turno) {
                                // Aplica un color especial si sobre_turno es 1
                                $color = ($turno['sobre_turno'] == 1) ? 'red' : 'black'; // Cambia 'red' por el color que desees

                                // Aquí construimos la cadena con el color aplicado
                                //return $turno['hora'] . ' - ' . $turno['estado'] . ' - <span style="color: ' . $color . ';">' . $turno['sobre_turno'] . '</span>';

                                //$sobreTurnoTexto = ($turno['sobre_turno'] == 1) ? '<span style="color: ' . $color . ';">' . $turno['sobre_turno'] . '</span>' : '';

                                // Aquí construimos la cadena con el color aplicado y el formato deseado
                                //return $turno['hora'] . ' - ' . $turno['estado'] . ' ' . $sobreTurnoTexto;


                                return $turno['hora'] . ' - ' . $turno['estado'] . ' - ' . $turno['sobre_turno'];
                            }, $turnosDelDia));

                            $fechaCompleta = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);
                            $table .= "<td onclick=\"openModal('$dayCounter', '{$monthNames[$month]} $dayCounter, $year', '$turnosText', '$fechaCompleta')\">$dayCounter<br>$turnosText</td>";



                            $dayCounter++;
                        }
                    }
                    $table .= '</tr>';
                }
                $table .= '</tbody></table>';

                return $table;
            }

            // Suponiendo que tienes las variables $mes y $anio definidas y $turnos es un array de turnos
            echo generateCalendar($mes, $anio, $turnos);


            ?>
        </div>

        <script>
            function openModal(day, dateText, turnosText, fechaCompleta) {
                document.getElementById('modalText').textContent = dateText;
                // document.getElementById('modalDate').textContent = turnosText;
                // document.getElementById('modalDatabaseDate').textContent = "Fecha en formato de base de datos: " + fechaCompleta;

                // Aquí podrías guardar la fecha en un campo oculto si necesitas enviarla luego
                document.getElementById('fecha').value = fechaCompleta;

                // Mostrar el modal
                document.getElementById('myModal').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('myModal').style.display = 'none'; // Cierra el modal
            }

            // Cierra el modal si se hace clic fuera de él
            window.onclick = function(event) {
                const modal = document.getElementById('myModal');
                if (event.target === modal) {
                    closeModal();
                }
            }
        </script>

        <!-- Modal -->
        <div id="myModal" class="modal" style="display:none;">

            <div class="modal-content bg-body-tertiary" style="width:400px">

                <span class="close" onclick="closeModal()">&times;</span>
                <b>
                    <h3 id="modalText"></h3>
                </b>
                <!-- <p id="modalDate"></p> -->
                <!-- <p id="modalDatabaseDate"></p> -->

                <form id="myForm" method="post" action="turnos_lista.php">
                    <input type="hidden" name="fecha" id="fecha">
                    <input type="hidden" name="id_medico" value="<?php echo $id_medico; ?>">
                    <button class="w-100 btn btn-lg btn-outline-primary" type="submit">Agregar Turnos</button>
                </form>


            </div>


        </div>




    </main>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    include("footer.html");
    ?>

</body>

</html>
<!doctype html>
<html>
<?php include('conexion.php');
//include('db.php');
?>
<?php
session_start();

// if ($_SESSION['rol_personal'] == 2) {
$fecha = $_GET['fecha'];
$id_medico = $_GET['id_medico'];
?>

<head>
    <script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <title>Documento sin título</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Headers · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>

    <link href="navbars-offcanvas.css" rel="stylesheet">
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

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>




    <header>
        <?php include('banner.html'); ?>
    </header>
    <nav>
        <?php
        include('navbar.html');
        ?>
    </nav>
    <main class="d-flex flex-nowrap">


        <div class="m-auto" style="width: 60%;">
            <form action="turnoAlta2.php" class="bg-body-tertiary p-4 rounded" method="post">

                <h2>Alta De Turno</h2>
                <br>
                <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">

                <!-- <div class="form-floating mb-3">
                    <input type="number" name="dniPaciente" maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">DNI *</label>
                </div> -->

                <div class="form-floating mb-3">
                    <select name="id_paciente" class="form-select" required>
                        <?php
                        $sql = "select * from paciente";
                        $res = mysqli_query($conexion_mysql, $sql) or die(mysqli_error());
                        ?>
                        <option value="">Elija un Paciente</option>
                        <?php
                        while ($paciente = mysqli_fetch_assoc($res)) {
                        ?>
                            <option value="<?php echo $paciente['id_paciente']; ?>"><?php echo $paciente['apellido'] . ", " . $paciente['nombre']; ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingInput">Seleccione al Paciente *</label>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $sql = "select * from medico where id_medico = '$id_medico'";
                    $res = mysqli_query($conexion_mysql, $sql) or die(mysqli_error());

                    $medico = mysqli_fetch_assoc($res);
                    ?>
                    <input type="hidden" name="id_medico" value="<?php echo $medico['id_medico']; ?>">
                    <input type="text" name="id" value="<?php echo $medico['apellido'] . ", " . $medico['nombre']; ?>" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingInput">Doctor </label>
                </div>

                <!-- <div class="form-floating mb-3">
                    <input type="time" name="hora" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Seleccione la Hora *</label>
                </div> -->
                <?php
                // Definir el rango de horas
                $horas = [];
                for ($h = 8; $h <= 21; $h++) {
                    for ($m = 0; $m < 60; $m += 30) { // Cada 30 minutos
                        $horas[] = sprintf("%02d:%02d", $h, $m);
                    }
                }
                ?>
                <div class="form-floating mb-3">
                    <select name="hora" class="form-select" required>
                        <?php
                        foreach ($horas as $hora) {
                            echo "<option value='$hora'>$hora</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingInput">Seleccione la Hora *</label>
                </div>



                <div class="form-floating mb-3">
                    <select name="tipo_turno" class="form-select" required>
                        <option value="">Elija un tipo</option>
                        <option value="Particular">Particular</option>
                        <option value="obra_social">Con Obra Social</option>
                    </select>
                    <label for="floatingInput">Seleccione un Tipo *</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="estado" class="form-select" required>
                        <option value="">Elija un Estado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmado">Confirmado</option>
                    </select>
                    <label for="floatingInput">Selección de Estado *</label>
                </div>

                <div class="form-floating mb-3">
                    <!-- <input type="text" name="sobre_turno" class="form-control" id="floatingPassword" placeholder="Password"> -->

                    <select name="sobre_turno" class="form-select">
                        <option value="0">Elija una opción</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <label for="floatingPassword">Sobre turno </label>
                </div>
                <div style="display: flex; justify-content: end; padding: 8px;">
                    <button class="w-25 btn btn-lg btn-outline-primary" type="submit" style="margin: 10px;">Agregar Turno</button>
                    <button class="w-25 btn btn-lg btn-outline-secondary" style="margin: 10px;" onclick="history.back()">Cancelar</button>
                </div>
            </form>
        </div>

    </main>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>




</body>

</html>
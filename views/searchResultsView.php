<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Búsqueda</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<hero17-wrapper class="hero17-wrapper">
    <div class="hero17-header78">
        <div class="hero17-column thq-section-padding thq-section-max-width">
            <div class="hero17-content1 text-center">
                <h1>
                    <fragment class="home-fragment27">
                        <span class="home-text27 thq-heading-1">
                            Reserve sus citas médicas con facilidad
                        </span>
                    </fragment>
                </h1>
                <p>
                    <fragment class="home-fragment26">
                        <span class="home-text26 thq-body-large">
                            Bienvenido a nuestra aplicación de programación de citas donde puede reservar, administrar y monitorear fácilmente citas con médicos específicos. Diga adiós a la molestia de realizar un seguimiento manual de sus citas médicas.
                        </span>
                    </fragment>
                </p>
                <div class="hero17-actions">
                    <section class="search-form-section py-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-xl-8">
                                    <div class="search-container">
                                    <form action="" method="get">
                                    <div class="field-container">
                                                <div class="input-group">
                                                    <label for="name">Nombre</label>
                                                    <input id="name" name="name" autocomplete="off" type="text" placeholder="Por nombre..." value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>" />
                                                    </div>
                                                <div class="input-group">
                                                    <label for="specialty">Especialidad</label>
                                                    <select id="specialty" name="specialty">
                                                        <option value="" selected disabled>Selecciona una especialidad</option>
                                                        <?php foreach ($especialidades as $especialidad): ?>
                                                            <option value="<?php echo htmlspecialchars($especialidad['nombre']); ?>"
                                                                <?php if (isset($_GET['specialty']) && $_GET['specialty'] == $especialidad['nombre']) echo 'selected'; ?>>
                                                                <?php echo htmlspecialchars($especialidad['nombre']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <label for="obra_social">Cobertura Médica</label>
                                                    <select id="obra_social" name="obra_social">
                                                        <option value="" selected disabled>Selecciona una cobertura médica</option>
                                                        <?php foreach ($coberturas as $cobertura): ?>
                                                            <option value="<?php echo htmlspecialchars($cobertura['id_obra_social']); ?>"
                                                                <?php if (isset($_GET['obra_social']) && $_GET['obra_social'] == $cobertura['id_obra_social']) echo 'selected'; ?>>
                                                                <?php echo htmlspecialchars($cobertura['nombre']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn-naranja" type="submit">Buscar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</hero17-wrapper>

<div class="resultados-busqueda">
    <?php if (!empty($resultados)): ?>
        <h2>Resultados de la Búsqueda:</h2>
        <table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Obras Sociales</th>
            <th>Horario Disponible</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultados as $medico): ?>
            <tr>
                <td><?php echo htmlspecialchars($medico['nombre']); ?></td>
                <td><?php echo htmlspecialchars($medico['especialidad']); ?></td>
                <td><?php echo htmlspecialchars($medico['obras_sociales']); ?></td>
                <td><?php echo htmlspecialchars($medico['hora_inicio']) . " - " . htmlspecialchars($medico['hora_fin']); ?></td>
                <td>
                    <form action="agendar.php" method="GET">
                        <input type="hidden" name="id_medico" value="<?php echo $medico['id_medico']; ?>">
                        <button type="submit" class="btn-naranja">Agendar Turno</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <?php else: ?>
        <p>No se encontraron resultados para los criterios de búsqueda.</p>
    <?php endif; ?>
</div>
<script>
    // Capturar el evento de envío del formulario
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que se envíe el formulario de manera predeterminada

        // Obtener los valores de los campos del formulario
        var name = document.getElementById('name').value;
        var specialty = document.getElementById('specialty').value;
        var obra_social = document.getElementById('obra_social').value;

        // Construir la nueva URL con los parámetros de búsqueda
        var url = window.location.pathname + '?';  // Obtener el path actual sin los parámetros

        if (name) {
            url += 'name=' + encodeURIComponent(name) + '&';
        }
        if (specialty) {
            url += 'specialty=' + encodeURIComponent(specialty) + '&';
        }
        if (obra_social) {
            url += 'obra_social=' + encodeURIComponent(obra_social) + '&';
        }

        // Eliminar el último ampersand "&" si existe
        url = url.slice(0, -1);

        // Redirigir al usuario a la nueva URL con los parámetros de búsqueda
        window.location.href = url;
    });
</script>

</body>
</html>

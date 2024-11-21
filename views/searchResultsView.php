<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../clinicastyle.css">
    <link rel="stylesheet" href="../clinicaindex.css">

</head>
<body>

    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Reserve sus citas médicas</h1>
            <p class="text-muted">Encuentre al médico ideal según sus necesidades.</p>
        </header>

        <!-- Formulario de búsqueda -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="searchForm" action="" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Por nombre..." 
                               value="<?php echo htmlspecialchars($_GET['name'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="specialty" class="form-label">Especialidad</label>
                        <select id="specialty" name="specialty" class="form-select">
                            <option value="" selected>Selecciona una especialidad</option>
                            <?php foreach ($especialidades as $especialidad): ?>
                                <option value="<?php echo htmlspecialchars($especialidad['nombre']); ?>"
                                    <?php echo ($_GET['specialty'] ?? '') == $especialidad['nombre'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($especialidad['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="obra_social" class="form-label">Cobertura Médica</label>
                        <select id="obra_social" name="obra_social" class="form-select">
                            <option value="" selected>Selecciona una cobertura</option>
                            <?php foreach ($coberturas as $cobertura): ?>
                                <option value="<?php echo htmlspecialchars($cobertura['id_obra_social']); ?>"
                                    <?php echo ($_GET['obra_social'] ?? '') == $cobertura['id_obra_social'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cobertura['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resultados -->
        <div>
            <?php if (!empty($resultados)): ?>
                <h2 class="mb-3">Resultados de la Búsqueda:</h2>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
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
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-calendar-plus"></i> Agendar Turno
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-circle"></i> No se encontraron resultados para los criterios de búsqueda.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const params = new URLSearchParams(new FormData(this)).toString();
            window.location.href = `${window.location.pathname}?${params}`;
        });
    </script>
</body>
</html>

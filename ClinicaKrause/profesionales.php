<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Profesionales</title>
    <link rel="stylesheet" href="stylesGestiones.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h1>Gestión de Profesionales</h1>
        <div id="task-form" class="form-container" style="width: 100%; background-color:#f4f4f4; border-radius: 10px; border: 1px solid #adb5bd; padding: 10px; margin-block: 20px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">

            <!-- <div id="task-form" class="form-container"> -->
            <h2>Agregar/Actualizar Profesionales</h2>
            <input type="hidden" id="form_id" />

            <label for="form_apellido">APELLIDO:</label>
            <input type="text" id="form_apellido" placeholder="Apellido del Profesional" required />
            <label for="form_nombre">NOMBRE:</label>
            <input type="text" id="form_nombre" placeholder="Nombre del Profesional" required />
            <label for="form_especialidad">ESPECIALIDAD:</label>
            <select id="form_especialidad" required>
                <option value="">Especialidad del Profesional</option>
                <option value="1">Cardiología</option>
                <option value="2">Dermatología</option>
                <option value="3">Pediatría</option>
                <option value="4">Neurología</option>
            </select>
            <div class="button-group">
                <button onclick="saveTask()">Ingresar Datos</button>
                <button onclick="clearForm()">Limpiar Formulario</button>
            </div>
        </div>

        <div id="task-form" class="form-container" style="width: 100%; background-color:#f4f4f4; border-radius: 10px; border: 1px solid #adb5bd; padding: 10px; margin-block: 20px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">

            <h2>Listado de Profesionales</h2>
            <ul id="tasks"></ul>
        </div>
    </div>

    <script src="scriptsProfesionales.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Ejemplo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Contenedor principal -->
    <div class="thq-section-padding">
        <div class="thq-section-max-width">
            <h1 class="thq-heading-1">Bienvenido</h1>
            <p class="thq-body-large">Este es un ejemplo de página utilizando el CSS proporcionado.</p>

            <!-- Formulario simple -->
            <form action="process.php" method="post">
                <div class="thq-flex-column">
                    <input class="thq-input" type="text" name="nombre" placeholder="Ingresa tu nombre">
                    <textarea class="textarea" name="mensaje" placeholder="Escribe tu mensaje"></textarea>
                    <button class="thq-button-filled" type="submit">Enviar</button>
                </div>
            </form>

            <!-- Botones adicionales -->
            <div class="thq-flex-row">
                <a href="#" class="thq-button-outline">Botón 1</a>
                <a href="#" class="thq-button-flat">Botón 2</a>
            </div>
        </div>
    </div>

    <!-- Lista de ejemplo -->
    <ul class="list">
        <li class="list-item">Elemento de lista 1</li>
        <li class="list-item">Elemento de lista 2</li>
        <li class="list-item">Elemento de lista 3</li>
    </ul>

</body>
</html>

<?php
define('BASE_PATH', __DIR__ . '/../'); // Define la ruta base del proyecto

try {
    $conn = new PDO("mysql:host=localhost;dbname=clinicaturn;port=3308", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

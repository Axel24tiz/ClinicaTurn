<?php
define('BASE_PATH', __DIR__ . '/../');
try {
    $conn = new PDO("mysql:host=localhost;dbname=clinicaturn;port=3306", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
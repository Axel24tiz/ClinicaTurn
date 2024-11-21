<?php
$host = 'localhost';
$db = 'clinicaTurn';
$user = 'root';  // Cambia si usas otro usuario
$pass = '';      // Cambia si usas otra contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

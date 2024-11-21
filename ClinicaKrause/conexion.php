<?php
// se iniciliza  las variables de conexion

$conexion_mysql_host        = "localhost";
$conexion_mysql_usuario     = "root";
$conexion_mysql_contrasena  = "";
$mysql_basededatos          = "clinicaTurn";


// se conecta al motor de base de datos
if (!($conexion_mysql = mysqli_connect($conexion_mysql_host, $conexion_mysql_usuario, $conexion_mysql_contrasena, $mysql_basededatos))) {
    //.....................................................................
    echo "no se pudo conectar";
    exit;
}

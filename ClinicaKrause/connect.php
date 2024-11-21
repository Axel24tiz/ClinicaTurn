<?php

$conexion_mysql_host       = "localhost";
$conexion_mysql_usuario    = "root";
$conexion_mysql_contrasena = "";
$mysql_basededatos         = "clinicaTurn";

// conecta al servidor
if (!($conexion_mysql = mysqli_connect($conexion_mysql_host, $conexion_mysql_usuario, $conexion_mysql_contrasena))) {
    //.....................................................................
    // informa del error producido

    $cuerpo1  = "al intentar conectar al servidor con los parametros:";
    $cuerpo2  = "";
    $asunto   = "[MYSQL-Error 1]";

    //.....................................................................
}

// selecciona la base de datos
if (!mysqli_select_db($conexion_mysql, $mysql_basededatos)) {
    //.....................................................................
    // informa del error producido

    $cuerpo1  = "al intentar seleccionar la base de datos";
    $asunto   = "[MYSQL-Error 2]";

    //.....................................................................
}

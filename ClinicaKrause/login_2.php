<?php
include('connect.php');
error_reporting(E_ERROR);
session_start();

$usu = $_POST['usuario'];
$clave = $_POST['clave'];

$ssql = "SELECT * FROM personal WHERE dni_personal = '$usu' AND clave = '$clave'";
if (!($r_personal = mysqli_query($conexion_mysql, $ssql))) {
    $cuerpo1  = "Error al intentar buscar un personal";
    echo $cuerpo1;
    exit;
    //.....................................................................
}

$cant = mysqli_num_rows($r_personal);

$personal = mysqli_fetch_array($r_personal);

$_SESSION["usuario"] = $personal['apellido_personal'] . ", " . $personal['nombre_personal'];
$_SESSION['dni_usuario'] = $personal['dni_personal'];
$_SESSION['rol_personal'] = $personal['rol_personal'];

//$_SESSION[$usuario]= $personal['apellido_personal'].", ".$personal['nombre_personal'];
//$usuario = $personal['apellido_personal'].", ".$personal['nombre_personal'];


if ($cant > 0) {
    //include('inicio_sesion.php');
    header('Location: index.php');
} else {
?>
    <div class="content">
        <div class="form-body">
            <center>
                <h1>Error!</h1>
            </center>
            <center>
                <h2>
                    El usuario o la contraseña, son incorrecto.
                </h2>
            </center>
            <center>
                <h3>
                    Haga click <b><a href="javascript:history.back()">aqu&iacute;</a></b> para regresar al Inicio de Sesión.
                </h3>
            </center>
        </div>
    </div>
<?php

}

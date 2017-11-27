<?php

include '../../php/conexion.php';
$usuario = $_POST['usuario'];
$clave = $_POST['password'];

$consulta = "select * from usuarios where correo='$usuario' and contrasena='$clave'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_num_rows($resultado);

if ($filas > 0) {
    
session_start();

$_SESSION['usuario'] = $usuario;
    echo '<script type="text/javascript">
alert("=== *Sus datos fueron aprobados. Se le enviará a su Panel de Administración. ===");
window.location.assign("../../panel_control.php");</script>';
} else {
    echo '<script> alert("=== ***Error en la autenticación de Datos. ===");window.history.go(-1);</script>';
}
?>
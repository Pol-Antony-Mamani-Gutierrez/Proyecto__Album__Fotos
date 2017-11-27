<?php
include ("../../php/conexion.php");
$id = $_POST['info_usuario_id'];
$nombre = $_POST['info_usuario_nombre'];
$correo = $_POST['info_usuario_correo'];
$password = $_POST['info_usuario_contraseña'];
$feca_nac = $_POST['info_usuario_fechanac'];
$ciudad = $_POST['info_usuario_ciudad'];
$pais = $_POST['pais'];

$modificar = "update usuarios set nombre='$nombre',correo='$correo',contrasena='$password',fech_nac='$feca_nac',ciudad='$ciudad',pais='$pais' where id='$id'";
$resultado = mysqli_query($conexion, $modificar);



if (!$resultado) {
    echo '<script> alert("=== ***Error en el Proceso de Modificación de Datos.!!! Vuelva a intentarlo. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *Tu Información se actualizó de manera Correcta. ===");
window.location.assign("../../panel_control.php");
</script>';
}

?>

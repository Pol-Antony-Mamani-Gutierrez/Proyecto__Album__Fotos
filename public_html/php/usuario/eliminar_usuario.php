<?php
include ("../../php/conexion.php");
$id = $_REQUEST['id'];

$eliminar = "DELETE  FROM `usuarios`  where id='$id'";
$eliminar_album = "DELETE  FROM `album`  where usuario='$id'";
$eliminar_imagenes = "DELETE  FROM `fotografias`  where idusuario='$id'";

$resultado = mysqli_query($conexion, $eliminar);
$result_album = mysqli_query($conexion, $eliminar_album);
$result_imagen = mysqli_query($conexion, $eliminar_imagenes);

if (!$resultado) {
    echo '<script> alert("=== *Nuestro Servidor esta en Mantenimiento.!!! Vuelva a Intentarlo dentro de unos minutos. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *Tu Cuenta ha sido eliminada de nuestros Servidores WEB. ===");
window.location.assign("../../index.php");
</script>';
}
?>

<?php

include ("../../php/conexion.php");
$id = $_REQUEST['id'];

//OBTENEMOS LOS DATOS DEL album
include("../../php/conexion2.php");
$album = $_REQUEST['id'];
$consulta_album = "SELECT * FROM album WHERE id = '$album'";
$consulta_ok = mysql_query($consulta_album, $link);
$resultado_album = mysql_fetch_array($consulta_ok);
$nombre_album = $resultado_album["titulo"];



$eliminar_album = "DELETE  FROM `album`  where id='$id'";
$eliminar_imagenes = "DELETE  FROM `fotografias`  where album='$nombre_album'";

$result_album = mysqli_query($conexion, $eliminar_album);
$result_imagen = mysqli_query($conexion, $eliminar_imagenes);





if (!$result_album || !$result_imagen) {
    echo '<script> alert("=== *Nuestro Servidor esta en Mantenimiento.!!! Vuelva a Intentarlo dentro de unos minutos. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *Tu Album ha sido eliminada de nuestros Servidores WEB. ===");
window.location.assign("../../panel_control.php");
</script>';
}
?>
<?php
include ("../../php/conexion.php");
$id = $_REQUEST['foto'];

$eliminar = "DELETE  FROM `fotografias`  where id='$id'";

$resultado = mysqli_query($conexion, $eliminar);


if (!$resultado) {
    echo '<script> alert("=== *Nuestro Servidor esta en Mantenimiento.!!! Vuelva a Intentarlo dentro de unos minutos. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *Tu Fotografía ha sido eliminada. ===");
window.location.assign("../../panel_control.php");
</script>';
}
?>

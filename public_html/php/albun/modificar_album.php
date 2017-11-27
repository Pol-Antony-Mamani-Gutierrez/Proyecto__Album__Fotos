<?php
include ("../../php/conexion.php");
$id = $_POST['modif_album_id'];
$titulo = $_POST['modif_album_titulo'];
$descripcion = $_POST['modif_album_descrip'];
$fecha = $_POST['modif_album_fecha'];
$pais = $_POST['modif_album_pais'];

$modificar = "update album set titulo='$titulo',descripcion='$descripcion',fecha='$fecha',pais='$pais' where id='$id'";
$resultado = mysqli_query($conexion, $modificar);



if (!$resultado) {
    echo '<script> alert("=== ***Error en el Proceso de Modificación de Datos.!!! Vuelva a intentarlo. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *La Información del Album se actualizó de manera Correcta. ===");
window.location.assign("../../panel_control.php");
</script>';
}

?>
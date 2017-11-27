<?php
include ("../../php/conexion.php");
$id = $_POST['id_modificar_foto'];
$foto = addslashes(file_get_contents($_FILES['foto_modificar']['tmp_name']));

$modificar = "update usuarios set foto='$foto' where id='$id'";
$resultado = mysqli_query($conexion, $modificar);



if (!$resultado) {
    echo '<script> alert("=== ***Error en el Proceso de Modificación de Datos.!!! Vuelva a intentarlo. ===");window.history.go(-1);</script>';
} else {
    echo '<script type="text/javascript">
alert("=== *Tu Foto de Perfil se actualizó de manera Correcta. ===");
window.location.assign("../../panel_control.php");
</script>';
}

?>

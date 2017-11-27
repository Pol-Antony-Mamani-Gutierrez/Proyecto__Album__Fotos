<?php

include ("../../php/conexion.php");

$nombre = $_POST['registro_imagen_fomulario_input'];
$album = $_POST['registro_imagen_fomulario_select'];
$idusuario = $_POST['registro_imagen_fomulario_idusuario'];
$foto = addslashes(file_get_contents($_FILES['registro_imagen_fomulario_file']['tmp_name']));

$insertar =  "insert into fotografias(nombre,fotografia,album,idusuario) values ('$nombre','$foto','$album','$idusuario')";

$verificar_nombre_foto = mysqli_query($conexion, "select * from fotografias where nombre='$nombre'");

if (mysqli_num_rows($verificar_nombre_foto) > 0) {
    echo '<script> alert("=== ***El nombre de la fotografía ya existe en tu Colección. ===");window.history.go(-1);</script>';
    exit;
}
 else {
    $resultado = mysqli_query($conexion, $insertar);
            echo '<script type="text/javascript">
alert("=== *Tu Fotografía se subió de Manera Correcta ===");
window.location.assign("../../panel_control.php");
</script>';
    }

mysqli_close($conexion);
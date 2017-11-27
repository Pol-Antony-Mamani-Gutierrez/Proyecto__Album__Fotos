<?php
include ("../../php/conexion.php");
$titulo = $_POST['registro_album_titulo'];
$descripcion = $_POST['registro_album_descripcion'];
$fecha = $_POST['registro_album_fecha'];
$pais = $_POST['registro_album_pais'];
$usuario = $_POST['registro_album_id_usuario'];
$insertar =  "insert into album(titulo,descripcion,fecha,pais,usuario) values ('$titulo','$descripcion','$fecha','$pais','$usuario')";

$verificar_album = mysqli_query($conexion, "select * from album where titulo='$titulo' and usuario='$usuario' ");
if(mysqli_num_rows($verificar_album) > 0){
    echo '<script> alert("== ***Ya Tienes un Album con ese Título. ===");window.history.go(-1);</script>';
    exit;
}
 else {
    $resultado = mysqli_query($conexion, $insertar);
            echo '<script type="text/javascript">
alert("=== *El Album se Registró de manera exitosa. ===");
window.location.assign("../../panel_control.php");
</script>';
}


mysqli_close($conexion);
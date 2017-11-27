<?php
include ("../../php/conexion.php");
$nombres = $_POST['nombres'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$genero = $_POST['genero'];
$fecha_nac = $_POST['fecha_nac'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
$insertar =  "insert into usuarios(nombre,correo,contrasena,fech_nac,ciudad,pais,genero,foto) values ('$nombres','$correo','$contraseña','$fecha_nac','$ciudad','$pais','$genero','$foto')";

$verificar_correo = mysqli_query($conexion, "select * from usuarios where correo='$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script> alert("== ***El Correo ya esá Registrado  en Nuestra Base de Datos. ===");window.history.go(-1);</script>';
    exit;
}

if ($_POST['contraseña'] == $_POST['contraseña2']) {
    $resultado = mysqli_query($conexion, $insertar);
    if (!$resultado) {
        echo '<script> alert("=== ***Error en su Proceso de Registro.!!! Vuelva a intentarlo. ===");window.history.go(-1);</script>';
    } else {
        echo '<script type="text/javascript">
alert("=== *Tu Registro fue todo un éxito. Ya puedes Iniciar Session. ===");
window.location.assign("../../index.php");
</script>';
    }
} else {
    echo '<script> alert("=== ***Error en la Verificación de la Contraseña. ===");window.history.go(-1);</script>';
}
mysqli_close($conexion);
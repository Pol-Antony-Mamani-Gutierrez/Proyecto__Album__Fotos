<!-- validar inicio de sesion -->
<?php
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    echo '<script type="text/javascript">
alert("===  * Inicie Sesion para Ingresar a su Panel de Administración. ===");
window.location.assign("index.php");
</script>';
    die();
}
?>
<!-- finnnn validar inicio de sesion -->
<!DOCTYPE html>
<html>
    <head>
        <title>Tus_Album_de_Fotografías</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/png" href="imagenes/logo_512_512-300x300.png"/>

        <link rel="stylesheet" type="text/css" href="css/stilo_control_fotografìas.css">

        <!--  APIS DE GOOGLE PARA LAS FUENTES -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">

        <!-- PERSONALIZAR LAS ALERTAS -->
        <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">
        <script src="js/sweetalert/sweetalert.min.js"></script>
        <!-- VALIDACIÓN DE FORMULARIOS -->

        <!-- PLUGINS DE METRO IU CSS -->
        <link href="css/docs/css/metro.css" rel="stylesheet">
        <script src="css/docs/js/jquery-3.1.0_1.js"></script>
        <script src="css/docs/js/metro.js"></script>
        <link href="css/docs/css/metro-icons.css" rel="stylesheet">
        <link href="css/docs/css/metro-schemes.css" rel="stylesheet">
        <script src="js/datatables.js"></script>
        <!-- FIN DE LOS PLUGINS DE METRO IU CSS -->
        <script>
            $(document).ready(function () {
                $('#tabla_imagenes_datatable').DataTable();
            });
        </script>
    </head>
    <?php
    //OBTENEMOS LOS DATOS DEL USUARIO 
    include("./php/conexion2.php");
    $correo = $_SESSION['usuario'];
    $consulta_usuario = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $consulta_ok = mysql_query($consulta_usuario, $link);
    $resultado_usuario = mysql_fetch_array($consulta_ok);
    ?>


    <?php
    //OBTENEMOS LOS DATOS DEL ALBUM
    include("./php/conexion2.php");
    $id = $_REQUEST['id'];
    $consulta_album = "select * from album where id='$id' ";
    $respuesta_album = mysql_query($consulta_album, $link);
    $resultado_album = mysql_fetch_array($respuesta_album);
    ?>

    <?php
    include("./php/conexion2.php");
    //FILTRO PARA OBTENER EL PAIS
    $pais = $resultado_album["pais"];
    $consulta_pais = "select * from paises where id='$pais' ";
    $respuesta_pais = mysql_query($consulta_pais, $link);
    $resultado_pais = mysql_fetch_array($respuesta_pais);
    ?>
    <body>
        <header class="menu_horizontal " id="menu_horizontal">
            <input type="checkbox" id="btn_menu_hori">
            <label for="btn_menu_hori"> <img src="imagenes/menu_icono2.png" alt=""></label>
            <nav class="menu">
                <ul>
                    <li> <a href="panel_control.php">Mi Perfil</a> </li>  
                    <li> <a href="php/sesion_star/cerrar_session.php"> Cerrar Sesion</a> </li>
                </ul>
            </nav>
        </header>
        <div class="info_usuario">
            <ul class="breadcrumbs2">
                <li><a href="panel_control.php"><span class="icon mif-home"></span></a></li>
                <li><a href="#"><?php echo $resultado_usuario["nombre"] ?></a></li>
                <li><a href="#"><?php echo $resultado_album["titulo"] ?></a></li>
                <li><a href="#">Colección de tus Fotografías</a></li>
                <li><a href="#" style="display: none">2017</a></li>
            </ul>
        </div>
        <script type="text/javascript">
            function eliminar_album(value)
            {
                if (value === true)
                {
                    document.getElementById("eliminar_album_button").style.visibility = 'visible';
                    document.getElementById("eliminar_album_button").style.opacity = '1';
                } else if (value === false) {
                    document.getElementById("eliminar_album_button").style.visibility = 'hidden';
                    document.getElementById("eliminar_album_button").style.opacity = '0';
                }
            }

        </script>

        <div class="datos_usuario">
            <input type="text" placeholder="id" style="display: none">
            <label class="datos_usuario_label">- Administrado por :</label>
            <input class="datos_usuario_nombre" type="text" value="<?php echo $resultado_usuario["nombre"] ?>" readonly="">
            <label class="datos_usuario_album">- Datos del Album de Fotos :</label>
            <label class="datos_usuario_album_tit">Título :</label> 
            <input class="datos_usuario_album_tit_data" type="text" value="<?php echo $resultado_album["titulo"] ?>" readonly="">
            <label class="datos_usuario_album_desc">Descripción :</label> 
            <textarea class="datos_usuario_album_desc_data" readonly="">
                <?php echo $resultado_album["descripcion"] ?>
            </textarea>
            <label class="datos_usuario_album_tit_fecha">Fecha :</label>
            <input class="datos_usuario_album_fech_data" type="date" value="<?php echo $resultado_album["fecha"] ?>" readonly="">
            <label class="datos_usuario_album_pais">Pais :</label>
            <input class="datos_usuario_album_pais_data" type="text" value="<?php echo $resultado_pais["nombre"] ?>" readonly="">

            <label class="switch-original">
                <input type="checkbox" onchange="eliminar_album(this.checked);" >
                <span class="check"></span>
                Eliminar Album
            </label>

            <input name="eliminar_album_button" id="eliminar_album_button"  class="eliminar_album_button" type="button" value="Eliminar Album" onClick="
                    swal({
                        title: 'Estás seguro de eliminar su Album ???',
                        text: 'Después no podrás recuperarla !!!  ..... Ten en Cuenta que al eliminar tu Album se borraran todas tus fotografías que hayas almacenado en nuestra Web. ¿Deseas eliminar tu Album de todas formas? ...',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borralo!',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                            function (isConfirm)
                            {
                                if (isConfirm)
                                {
                                    window.location = 'php/albun/eliminar_album.php?id=<?php echo $resultado_album["id"] ?>';
                                } else {
                                    swal(
                                            'Cancelado.',
                                            'Tu Album está a Salvo.',
                                            'error'
                                            );
                                }
                            });">
        </div>

        <div class="tabla_imagenes">

            <table id="tabla_imagenes_datatable" class="table striped hovered cell-hovered border bordered" data-role="datatable" >

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>FOTOGRAFÍA</th>
                        <th>ACCIÓN</th>
                    </tr>
                </thead>



                <tbody>
                    <tr>
                        <?php
                        include("./php/conexion2.php");
                        $idalbum = $resultado_album["titulo"];
                        $selecciòn_fotografias = "SELECT * FROM fotografias WHERE album='$idalbum' ORDER BY id desc";
                        $consulta_fotografías = mysql_query($selecciòn_fotografias, $link);
                        while ($result_fotografías = mysql_fetch_array($consulta_fotografías)) {
                            ?>
                            <td class="resultado_fotografia_tabl_name"><?php echo $result_fotografías["id"] ?></td>
                            <td class="resultado_fotografia_tabl_album"><?php echo $result_fotografías["nombre"] ?></td>
                            <td class="resultado_fotografia_tabl_image"><img class="resultado_fotografia_tabla"  src="data:image/jpg;base64,<?php echo base64_encode($result_fotografías['fotografia']); ?>"></td> 
                            <td style="cursor: pointer"> <input type="button" value="Eliminar Fotografía" onClick="
                    swal({
                        title: 'Estás seguro de eliminar su Fotografía ???',
                        text: 'Después no podrás recuperarla !!!  ..... ¿Desea Continuar? ...',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borralo!',
                        cancelButtonText: 'Cancelar',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                            function (isConfirm)
                            {
                                if (isConfirm)
                                {
                                    window.location = 'php/imagenes/eliminar_imagen.php?foto=<?php echo $result_fotografías["id"]; ?>';
                                } else {
                                    swal(
                                            'Cancelado.',
                                            'Tu Fotografía está a Salvo.',
                                            'error'
                                            );
                                }
                            });"></td>
                        </tr>
                 <?php
                }
                ?>
                    </tbody>
            </table> 
        </div>


    </body>
</html>

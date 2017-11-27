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
        <title>Panel_Administración</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/png" href="imagenes/logo_512_512-300x300.png"/>

        <link rel="stylesheet" type="text/css" href="css/stilo_panel_control.css">
        <!--  APIS DE GOOGLE PARA LAS FUENTES -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet">
        <!-- PERSONALIZAR LAS ALERTAS -->
        <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">
        <script src="js/sweetalert/sweetalert.min.js"></script>
        <!-- VALIDACIÓN DE FORMULARIOS -->
        <script src="js/validar_registro_usuario.js"></script>
        <script src="js/validar_registro_album.js"></script>
        <script src="js/validar_registro_imagen.js"></script>
        <!-- PLUGINS DE METRO IU CSS -->
        <link href="css/docs/css/metro-icons.css" rel="stylesheet">
        <!-- FIN DE LOS PLUGINS DE METRO IU CSS -->

    </head>

    <body>

        <header class="menu_horizontal " id="menu_horizontal">
            <input type="checkbox" id="btn_menu_hori">
            <label for="btn_menu_hori"> <img src="imagenes/menu_icono2.png" alt=""></label>
            <nav class="menu">
                <ul>
                    <li> <a href="#">Mi Perfil</a> </li>  
                    <li> <a href="php/sesion_star/cerrar_session.php"> Cerrar Sesion</a> </li>
                </ul>
            </nav>
        </header>

        <p class="titulo_general">Panel de Adminstración </p>
        <?php
        include("./php/conexion2.php");
        //OBTENEMOS LOS DATOS DEL USUARIO
        $correo = $_SESSION['usuario'];
        $consulta_usuario = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $consulta_ok = mysql_query($consulta_usuario, $link);
        $resultado_usuario = mysql_fetch_array($consulta_ok);

        //FILTRO PARA OBTENER EL NOMBRE DEL PAIS
        $pais_con = $resultado_usuario["pais"];
        $consulta_pais = "SELECT * FROM paises WHERE id = '$pais_con'";
        $obtener_pais = mysql_query($consulta_pais, $link);
        $resultado_país = mysql_fetch_array($obtener_pais);


        if ($resultado_usuario == 0) {
            echo '<script type="text/javascript">
            alert("===  ***Inicie Sesion para Concretar la Opración. ===");
             window.location.assign("index.php");
              </script>';
        }
        ?>

        <input type="checkbox" class="checkbox_mostrar_datos" id="checkbox_mostrar_datos" >
        <label class="div_mostrar_datos" for="checkbox_mostrar_datos" >|||</label>

        <script type="text/javascript">
            function modificar_foto(value)
            {
                if (value === true)
                {
                    document.getElementById("foto_btn").style.display = 'none';
                    document.getElementById("foto_modificar").style.display = 'none';
                    document.getElementById("imgSalida_modificar").style.display = 'none';
                    document.getElementById("label_foto").innerHTML = 'Actualizar Fotografía';
                    document.getElementById("check2_foto").checked = false;
                } else if (value === false) {
                    document.getElementById("foto_btn").style.display = 'block';
                    document.getElementById("foto_modificar").style.display = 'block';
                    document.getElementById("imgSalida_modificar").style.display = 'block';
                    document.getElementById("label_foto").innerHTML = 'Cancelar';
                    document.getElementById("check2_foto").checked = true;
                }
            }

        </script>

        <div class="info_usuario_SIDEBAR">

            <input class="check_foto" type="checkbox" id="prueba_check_foto" name="prueba_check_foto"  onchange="modificar_foto(this.checked);" checked>
            <input class="check2_foto" type="checkbox" id="check2_foto" name="check2_foto" disabled="false">
            <label class="label_foto" id="label_foto" for="prueba_check_foto">Actualizar Fotografía</label>

            <form action="php/usuario/modificar_usuario_foto.php" method="POST" enctype="multipart/form-data" >
                <input class="info_usuario_id" name="id_modificar_foto" id="id_modificar_foto" type="text" value="<? echo $resultado_usuario["id"] ?>">
                <input id="foto_modificar" name="foto_modificar" class="info_usuario_foto_vista" type="file" required=""> 
                <img  class="vista_foto_modificar" id="imgSalida_modificar"  src="" alt=""/>
                <script src='js/vista_previa_fotos/jquery_codepen.js'></script>
                <script  src="js/vista_previa_fotos/vista_previa_fotos_1.js"></script>
                <input class="foto_btn" id="foto_btn" name="foto_btn" type="submit" value="Listo">
            </form>

            <form action="php/usuario/modificar_usuario.php" method="POST" enctype="multipart/form-data" class="info_usuario" onsubmit="return modificar_usuario()">
                <input class="info_usuario_id" name="info_usuario_id" id="info_usuario_id" type="text" value="<? echo $resultado_usuario["id"] ?>">
                <label  class="info_usuario_nombre_label">- Nombre(s) y Apellidos :</label>
                <input class="info_usuario_nombre" id="info_usuario_nombre" name="info_usuario_nombre" type="text" value="<? echo $resultado_usuario["nombre"] ?>" placeholder="Nombre(s) y Apellidos" disabled="false">
                <label  class="info_usuario_correo_label">- Correo :</label>
                <input class="info_usuario_correo" id="info_usuario_correo" name="info_usuario_correo" type="text" value="<? echo $resultado_usuario["correo"] ?>" placeholder="Correo" disabled="false">
                <label class="info_usuario_password_label">- Password :</label>
                <input class="info_usuario_contraseña" id="info_usuario_contraseña" name="info_usuario_contraseña" type="password" value="<? echo $resultado_usuario["contrasena"] ?>" placeholder="Contraseña" disabled="false">
                <label  class="info_usuario_fechanac_label">- Fecha Nacimiento :</label>
                <input class="info_usuario_fechanac" id="info_usuario_fechanac" name="info_usuario_fechanac" type="date" value="<? echo $resultado_usuario["fech_nac"] ?>" placeholder="Fecha Nacimiento" disabled="false">
                <label  class="info_usuario_ciudad_label">- Ciudad :</label>
                <input class="info_usuario_ciudad" id="info_usuario_ciudad" name="info_usuario_ciudad" type="text" value="<? echo $resultado_usuario["ciudad"] ?>" placeholder="Ciudad" disabled="false">
                <label  class="info_usuario_pais_label">- País :</label>
                <input class="info_usuario_pais" name="info_usuario_pais" id="info_usuario_pais" type="text" value="<? echo $resultado_país["nombre"] ?>" placeholder="País"  disabled="false">
                <label  class="info_usuario_genero_label">- Género :</label>
                <input class="info_usuario_genero" type="text" value="<? echo $resultado_usuario["genero"] ?>" placeholder="Nombre(s) y Apellidos" disabled="false">
                <select id="pais" name="pais" class="info_usuario_pais_mod">

                    <option value="<? echo $resultado_país["id"] ?>"><? echo $resultado_país["nombre"] ?></option>
                    <?php
                    include ("./php/cn.php");
                    $consulta_pais_modificar = "select id,nombre FROM paises ORDER by nombre asc";
                    mysql_query($consulta_pais_modificar);
                    $resultado_pais_modif = mysql_query($consulta_pais_modificar);
                    ?>
                    <?php
                    while ($filas = mysql_fetch_row($resultado_pais_modif)) {
                        echo "<option value='" . $filas['0'] . "'>" . $filas['1'] . "</option>";
                    }
                    ?>

                </select>
                <img class="info_usuario_foto"  src="data:image/jpg;base64,<?php echo base64_encode($resultado_usuario['foto']); ?>">

                <input class="info_usuario_btn" type="submit" value="Guardar"  name="info_usuario_btn" id="info_usuario_btn">
            </form>

            <script type="text/javascript">
                function habilitar(value)
                {
                    if (value === true)
                    {
                        document.getElementById("info_usuario_nombre").disabled = true;
                        document.getElementById("info_usuario_correo").disabled = true;
                        document.getElementById("info_usuario_contraseña").disabled = true;
                        document.getElementById("info_usuario_fechanac").disabled = true;
                        document.getElementById("info_usuario_ciudad").disabled = true;
                        document.getElementById("pais").style.display = 'none';
                        document.getElementById("info_usuario_btn").style.display = 'none';
                        document.getElementById("label-check-facebook").innerHTML = 'Clic Aquí Para Modificar sus Datos';
                        document.getElementById("check2").checked = false;
                    } else if (value === false) {
                        document.getElementById("label-check-facebook").innerHTML = 'Clic Aquí Para Cancelar';
                        document.getElementById("info_usuario_nombre").disabled = false;
                        document.getElementById("info_usuario_correo").disabled = false;
                        document.getElementById("info_usuario_contraseña").disabled = false;
                        document.getElementById("info_usuario_fechanac").disabled = false;
                        document.getElementById("info_usuario_ciudad").disabled = false;
                        document.getElementById("pais").style.display = 'block';
                        document.getElementById("info_usuario_btn").style.display = 'block';
                        document.getElementById("check2").checked = true;
                    }
                }

            </script>
            <input class="check" type="checkbox" id="prueba_check" name="prueba_check" onchange="habilitar(this.checked);" checked>
            <input class="check2" type="checkbox" id="check2" name="check2" disabled="false">
            <label class="label" id="label-check-facebook" for="prueba_check">Clic Aquí Para Modificar sus Datos</label>


            <form action="php/usuario/eliminar_usuario.php" method="POST">
                <input name="id" id="id" type="text" value="<? echo $resultado_usuario["id"] ?>" style="display: none">

                <input class="info_usuario_eliminar_cuenta" type="button" value="Eliminar Mi Cuenta" onClick="
                        swal({
                            title: 'Estás seguro de eliminar tu Cuenta ???',
                            text: 'Después no podrás recuperarla !!!  ..... Ten en Cuenta que al eliminar tu cuenta se darán de baja a todos tus álbunes y fotos que hayas almacenado en nuestra Web. ¿Deseas elimina tu cuenta de todas formas? ...',
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
                                        window.location = 'php/usuario/eliminar_usuario.php?id=<?php echo $resultado_usuario["id"] ?>';
                                    } else {
                                        swal(
                                                'Cancelado.',
                                                'Tu Cuenta está a Salvo.',
                                                'error'
                                                );
                                    }
                                });">
            </form>
        </div>







        <script type="text/javascript">
            function agregar_album(value)
            {
                if (value === true)
                {
                    document.getElementById("checkbox_reg_album_label").innerHTML = 'Cancelar';
                } else if (value === false) {
                    document.getElementById("checkbox_reg_album_label").innerHTML = 'Crear un Nuevo Album';
                }
            }
        </script>

        <input type="checkbox" class="checkbox_reg_album" id="checkbox_reg_album" onchange="agregar_album(this.checked);" >
        <label id="checkbox_reg_album_label" class="checkbox_reg_album_label" for="checkbox_reg_album">Crear un Nuevo Album</label>

        <div class="registro_album">
            <p class="registro_album_titulo">Agregar Album</p>

            <form action="php/albun/registrar_album.php" method="POST" class="form_registro_album" onsubmit="return  val_album();">
                <input name="registro_album_id_usuario" id="registro_album_id_usuario" class="info_usuario_id" name="" id="" type="text" value="<? echo $resultado_usuario["id"] ?>">
                <label class="form_registro_album_ti_la">- Título:</label>
                <input name="registro_album_titulo" id="registro_album_titulo" class="form_registro_album_ti_data" type="text" placeholder="Título" required="" maxlength="200">
                <label class="form_registro_album_des_la">- Descripción:</label>
                <textarea name="registro_album_descripcion" id="registro_album_descripcion" class="form_registro_album_descrip_data" placeholder="Breve Descripción acerca del Album(300 caracteres)......." required="" maxlength="300"></textarea>
                <label class="form_registro_album_fech_la">- Fecha de Creación:</label>
                <input name="registro_album_fecha" id="registro_album_fecha" class="form_registro_album_fech_data" type="date" required="">
                <label class="form_registro_album_pais_la">- País</label>
                <select name="registro_album_pais" id="registro_album_pais" class="form_registro_album_pais_data" >
                    <option value="seleccion_pais">Seleccione</option>
                    <?php
                    include ("./php/cn.php");
                    $consulta = "select id,nombre FROM paises ORDER by nombre asc";
                    mysql_query($consulta);
                    $result = mysql_query($consulta);
                    ?>
                    <?php
                    while ($fila = mysql_fetch_row($result)) {
                        echo "<option value='" . $fila['0'] . "'>" . $fila['1'] . "</option>";
                    }
                    ?>
                </select>
                <input class="form_registro_btn" type="submit" value="Registrar Album">
            </form>
        </div>



        <script type="text/javascript">
            function agregar_imagen(value)
            {
                if (value === true)
                {
                    document.getElementById("checkbox_reg_images_label").innerHTML = 'Cancelar';
                    document.getElementById("registro_imagen_fomulario_label_fot").style.display = 'block';
                    document.getElementById("fotografía_file").style.display = 'block';
                    document.getElementById("registro_imagen_fomulario_button").style.display = 'block';
                } else if (value === false) {
                    document.getElementById("checkbox_reg_images_label").innerHTML = 'Insertar Nueva Fotografía';
                    document.getElementById("registro_imagen_fomulario_label_fot").style.display = 'none';
                    document.getElementById("fotografía_file").style.display = 'none';
                    document.getElementById("registro_imagen_fomulario_button").style.display = 'none';
                }
            }
        </script>
        <input type="checkbox" class="checkbox_reg_imagen" id="checkbox_reg_imagen" onchange="agregar_imagen(this.checked);"> 
        <label id="checkbox_reg_images_label" class="checkbox_reg_images_label" for="checkbox_reg_imagen">Insertar Nueva Fotografía</label>
        <div class="registro_imagen">

            <form action="php/imagenes/registrar_imagen.php" class="registro_imagen_fomulario" method="POST" enctype="multipart/form-data" onsubmit="return  val_imagen();">
                <input type="text" name="registro_imagen_fomulario_idusuario" id="registro_imagen_fomulario_idusuario" value="<? echo $resultado_usuario["id"] ?>" style="display: none">
                <label class="registro_imagen_fomulario_label">- Ingrese el Nombre de la Fotografía :</label>
                <input class="registro_imagen_fomulario_input" name="registro_imagen_fomulario_input" id="registro_imagen_fomulario_input" type="text" placeholder="Nombre de la Fotografía" required="">
                <label class="registro_imagen_fomulario_label_fot" id="registro_imagen_fomulario_label_fot">- Seleccionar Imagen :</label>

                <input class="registro_imagen_fomulario_file"  name="registro_imagen_fomulario_file" id="fotografía_file" type="file" required>

                <img class="vista_fotografias" id="vista_fotografias"  src="imagenes/fotografia.jpg" alt=""/>
                <label class="registro_imagen_fomulario_label_select">- Seleccione el Album : </label>
                <select name="registro_imagen_fomulario_select" id="registro_imagen_fomulario_select" class="registro_imagen_fomulario_select" >
                    <option value="seleccion_album">Seleccione</option>
                    <?php
                    include ("./php/cn.php");
                    $IDUSUARIO_imagen = $resultado_usuario["id"];
                    $consulta_album_img = "select id,titulo FROM album where usuario = '$IDUSUARIO_imagen' ORDER by titulo asc";
                    mysql_query($consulta_album_img);
                    $resultado_album_img = mysql_query($consulta_album_img);
                    ?>
                    <?php
                    while ($fila_album = mysql_fetch_row($resultado_album_img)) {
                        echo "<option value='" . $fila_album['1'] . "'>" . $fila_album['1'] . "</option>";
                    }
                    ?>
                </select>

                <input class="registro_imagen_fomulario_button" id="registro_imagen_fomulario_button" type="submit" value="Subir Imagen">

                <script src='js/vista_previa_fotos/jquery_codepen.js'></script>
                <script  src="js/vista_previa_fotos/vista_fotografia.js"></script>
            </form>

        </div>


        <form class="listado_album_usuario">
            <table class="listado_album_usuario_tabla">
                <thead class="listado_album_usuario_tabla_head">
                <td class="listado_album_usuario_tabla_head_tit" colspan="5">>> Lista de tus Álbunes Creados <<</td>
                </thead>
                <tbody>
                    <tr>                       
                        <td class="tabla-album-titulos_tit">Titulo</td>
                        <td class="tabla-album-titulos_des">Descripción</td>
                        <td class="tabla-album-titulos_fech">Fecha</td>
                    </tr>
                    <?php
                    include("./php/conexion2.php");
                    $IDUSUARIO = $resultado_usuario["id"];
                    $seleccion_album = "SELECT * FROM album WHERE usuario = '$IDUSUARIO' order by id desc";
                    $consulta_album = mysql_query($seleccion_album, $link);



                    while ($reg = mysql_fetch_array($consulta_album)) {
                        ?>
                        <tr>
                            <td class="tabla-album-datos_id" style="display: none"><? echo $reg["id"] ?></td>
                            <td class="tabla-album-datos_tit"><? echo $reg["titulo"] ?></td>
                            <td class="tabla-album-datos_des"><input class="tabla-album-datos_des_input" type="text"  maxlength="300" value="<? echo $reg["descripcion"] ?> " readonly=""></td>
                            <td class="tabla-album-datos_fech"><? echo $reg["fecha"] ?></td>
                            <td class="tabla-album-datos_elim"><a class="tabla-album-datos_elim_a" href="control_fotografias.php?id=<?php echo $reg['id']; ?>">Ver Album</a></td>
                        </tr>
                        <?php
                    }
                    ?>  
                </tbody>

            </table>
        </form>


        <form class="listado_imagenes_usuario">
            <table class="listado_imagenes_usuario_tabla">
                <thead>
                <td class="listado_imagenes_usuario_tabla_tit" colspan="3">>> Lista de tus Últimas 6 Fotografías <<</td>
                </thead>
                <tbody>
                    <tr>
                        <td class="listado_imagenes_usuario_name">Nombre</td>
                        <td class="listado_imagenes_usuario_album">Album</td>
                        <td class="listado_imagenes_usuario_img">Imagen</td>
                    </tr>
                    <?php
                    include("./php/conexion2.php");
                    $IDUSUARIO_fotografia = $resultado_usuario["id"];
                    $selecciòn_fotografias = "SELECT * FROM fotografias WHERE idusuario='$IDUSUARIO_fotografia' ORDER BY id desc LIMIT 6";
                    $consulta_fotografías = mysql_query($selecciòn_fotografias, $link);



                    while ($result_fotografías = mysql_fetch_array($consulta_fotografías)) {
                        ?>
                        <tr>
                            <td class="resultado_fotografia_tabl_name"><?php echo $result_fotografías["nombre"] ?></td>
                            <td class="resultado_fotografia_tabl_album"><?php echo $result_fotografías["album"] ?></td>
                            <td class="resultado_fotografia_tabl_image"><img class="resultado_fotografia_tabla"  src="data:image/jpg;base64,<?php echo base64_encode($result_fotografías['fotografia']); ?>"></td> 
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </form>









        <div class="busqueda_imagen">
            <input class="check_album"   type="checkbox" id="check_album" name="check_album" onchange="habilitar_datos_album(this.checked);" checked>
            <input class="check2_album"  type="checkbox" id="check2_album" name="check2_album" disabled="false">
            <label class="label_album"   id="label-check_album" for="check_album">Modificar</label>


            <label class="busqueda_imagen_titulo">Buscar / Modificar Album</label>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <input class="busqueda_imagen_input" type="text" required="" name="titulo_album" placeholder="Titulos del Album......."> 
                <button class="busqueda_imagen_btn" name="button_consulta_album" type="submit"><span class="mif-search prepend-icon"></span></button>  
            </form>

            <?php
            if (isset($_POST['button_consulta_album'])) {

                include("./php/conexion2.php");
                $IDUSUARIO_album = $resultado_usuario["id"];
                $titulo_album = $_POST['titulo_album'];
                $consulta_datos_album = "SELECT * FROM album WHERE titulo = '$titulo_album' and usuario = '$IDUSUARIO_album'";
                $consulta_album_ok = mysql_query($consulta_datos_album, $link);
                $resultado_consulta_album = mysql_fetch_array($consulta_album_ok);
                if ($resultado_consulta_album == 0) {
                    echo '<script type="text/javascript">
            alert("===  ***Usted no tiene un Album Registrado con ese Título. ===");
             window.location.assign("panel_control.php");
              </script>';
                }
            }
            ?>


            <?php
            include("./php/conexion2.php");
            //FILTRO PARA OBTENER EL NOMBRE DEL PAÌS DEL ALBUM
            $pais_consu_album = $resultado_consulta_album["pais"];
            $consulta_pais_album = "SELECT * FROM paises WHERE id = '$pais_consu_album'";
            $obtener_pais_album = mysql_query($consulta_pais_album, $link);
            $resultado_país_album = mysql_fetch_array($obtener_pais_album);
            ?>


            <form action="php/albun/modificar_album.php" method="POST">
                <label class="busqueda_imagen_label_info"> - Información :</label>
                <input     name="modif_album_id" type="text" value="<? echo $resultado_consulta_album["id"] ?>" style="display: none">
                <label     class="busqueda_imagen_label_tit">Titulo :</label>
                <input     name="modif_album_titulo" id="album_titulo" class="busqueda_imagen_data_tit" type="text" value="<? echo $resultado_consulta_album["titulo"] ?>" disabled="true" required=""> 
                <label     class="busqueda_imagen_label_desc">Descripción :</label>   
                <textarea  name="modif_album_descrip" id="album_descripcion" class="busqueda_imagen_data_desc" disabled="true" required=""><? echo $resultado_consulta_album["descripcion"] ?></textarea> 
                <label     class="busqueda_imagen_label_fech">Fecha :</label>
                <input     name="modif_album_fecha" id="album_fecha" class="busqueda_imagen_data_fech" type="date" value="<? echo $resultado_consulta_album["fecha"] ?>" disabled="true" required="">
                <label     class="busqueda_imagen_label_pais">País:</label>
                <input     class="album_pais" id="album_pais" type="text" value="<? echo $resultado_país_album["nombre"] ?>" disabled="true">
                <select    name="modif_album_pais" class="busqueda_imagen_data_pais" id="busqueda_imagen_data_pais" required="" style="display: none">
                    <option value="<? echo $resultado_país_album["id"] ?>"><? echo $resultado_país_album["nombre"] ?></option>
                    <?php
                    include ("./php/cn.php");
                    $consulta_pais_modificar_album = "select id,nombre FROM paises ORDER by nombre asc";
                    mysql_query($consulta_pais_modificar_album);
                    $resultado_pais_modif_album = mysql_query($consulta_pais_modificar_album);
                    ?>
                    <?php
                    while ($filas_pais = mysql_fetch_row($resultado_pais_modif_album)) {
                        echo "<option value='" . $filas_pais['0'] . "'>" . $filas_pais['1'] . "</option>";
                    }
                    ?>
                </select>
                <button class="busqueda_imagen_submit" name="button_consulta_album" type="submit" >Guardar  <span class="mif-checkmark prepend-icon"></span></button>  
            </form>

            <script type="text/javascript">
                function habilitar_datos_album(value)
                {
                    if (value === true)
                    {
                        document.getElementById("album_pais").style.display = 'block';
                        document.getElementById("busqueda_imagen_data_pais").style.display = 'none';
                        document.getElementById("album_fecha").disabled = true;
                        document.getElementById("album_descripcion").disabled = true;
                        document.getElementById("album_titulo").disabled = true;
                        document.getElementById("label-check_album").innerHTML = 'Modificar';
                        document.getElementById("check2_album").checked = false;
                    } else if (value === false) {
                        document.getElementById("album_pais").style.display = 'none';
                        document.getElementById("busqueda_imagen_data_pais").style.display = 'block';
                        document.getElementById("album_fecha").disabled = false;
                        document.getElementById("album_descripcion").disabled = false;
                        document.getElementById("album_titulo").disabled = false;
                        document.getElementById("label-check_album").innerHTML = 'Cancelar';
                        document.getElementById("check2_album").checked = true;
                    }
                }

            </script>
        </div>













        <footer class="footer">
            <p class="pol">Pol Antony Mamani Gutiérrez</p>
            <p class="pol2">@Pol1398</p>
            <p class="año">2017</p>
            <a target="_blank" href="https://www.facebook.com/PolAntonyMamaniGutierrez"><div class="mif-facebook mif-2x" style="color: white"></div></a>
            <a target="_blank" href="https://twitter.com/Pol1398"><div class="mif-twitter mif-2x" style="color: white"></div></a>
            <a target="_blank" href="https://www.instagram.com/polantonymamanigutierrez"><div class="mif-instagram mif-2x" style="color: white"></div></a>
            <a target="_blank" href="https://github.com/Pol-Antony-Mamani-Gutierrez"><div class="mif-github mif-2x" style="color: white"></div></a>
            <a target="_blank" href="https://www.linkedin.com/in/polantonymamaniguti%C3%A9rrez"><div class="mif-linkedin mif-2x" style="color: white"></div></a>
        </footer>
        <!-- 
        colores para las redes sociales+
        face: style="color: #3B5998; background: white; border-radius: 10px"
        instagram: style="    color: #93786D; border-radius: 5px"
        twitter: style="color: white; background: #1DA1F2; border-radius: 5px"
        github:  style="color: white; background: transparent;border-radius: 1px;"
        linkedin: style="background: white;color: #0077B5;border-radius: 5px;"
        -->
    </body>
</html>

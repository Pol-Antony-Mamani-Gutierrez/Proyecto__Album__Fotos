
<!DOCTYPE html>
<html>
    <head>
        <title>Register_New_User</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="imagenes/logo_512_512-300x300.png"/>
        <link rel="stylesheet" type="text/css" href="css/stilo_nuevo_usuario.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">
        <script src="js/sweetalert/sweetalert.min.js"></script>
        <script src="js/validar_registro_usuario.js"></script>
       
        <link href="css/docs/css/metro-icons.css" rel="stylesheet">
    </head>
    <body>
        <header class="menu_horizontal " id="menu_horizontal">
            <input type="checkbox" id="btn_menu_hori">
            <label for="btn_menu_hori"> <img src="imagenes/menu_icono2.png" alt=""></label>
            <nav class="menu">
                <ul>
                    <li> <a href="index.php">Inicio</a> </li>  
                    <li> <a href="#">Dashboard</a> </li>
                </ul>
            </nav>
        </header>
        
        <p class="frase">“En la fotografía hay una realidad tan sutil que llega a ser más real que la realidad” –Alfred Stieglitz.</p>
        
        <form name="fvalida" action="php/usuario/registrar_usuario.php" method="POST" enctype="multipart/form-data" class="form_registro_nuevo"  onsubmit="return  java_pruebas();">
            <p class="titulo_registro">Ingrese sus datos para su Registro</p>
            <label class="form_registro_nuevo_label_nombre">-Nombre(s) y Apellidos :</label>
            <input id="nombre" name="nombres" class="form_registro_nuevo_dato" type="text" placeholder="Nombre(s) y Apellidos" required="">
            <label class="form_registro_nuevo_label_correo">-Correo :</label>
            <input name="correo" class="form_registro_nuevo_dato_correo" type="email" placeholder="Correo(@email.com)" required="">
            <label class="form_registro_nuevo_label_pass">-Password :</label>
            <input name="contraseña" class="form_registro_nuevo_dato_pass" type="password" placeholder="Contraseña" required="">
            <label class="form_registro_nuevo_label_pass2">-Confirmar Password :</label>
            <input  name="contraseña2" class="form_registro_nuevo_dato_pass2" type="password" placeholder="Confirme su Contraseña" required="">
            <label class="form_registro_nuevo_label_genero">-Seleccione su Género :</label>
            <select id="genero" name="genero" class="form_registro_nuevo_dato_genero" required="">
                <option value="seleccion_genero">Seleccione</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
            <label label class="form_registro_nuevo_label_nacimiento">-Fecha de Nacimiento :</label>
            <input name="fecha_nac" class="form_registro_nuevo_dato_nacimiento" type="date" required="">
            <label class="form_registro_nuevo_label_ciudad">-Ciudad :</label>
            <input name="ciudad" class="form_registro_nuevo_dato_ciudad" type="text" placeholder="Ciudad" required="">
            <label class="form_registro_nuevo_label_pais">-País :</label>
            <select id="pais" name="pais" class="form_registro_nuevo_dato_pais">
                <option value="seleccion_pais">Seleccione</option>
                <?php
                include ("../public_html/php/cn.php");
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
            <label class="form_registro_nuevo_label_foto">-Foto de Perfil :</label>
            <input id="foto" name="foto" class="form_registro_nuevo_dato_foto" type="file" required=""> 

            <img class="vista_foto" id="imgSalida"  src="imagenes/avatar.png" alt=""/>
            <script src='js/vista_previa_fotos/jquery_codepen.js'></script>
            <script  src="js/vista_previa_fotos/vista_previa_fotos.js"></script>

            <input class="form_registro_nuevo_btn" type="submit" value="Concretar Registro">
        </form>


        <img src="imagenes/PCC_Fotografia-2TM-050917.jpg" alt="" class="imagen_refer">
        
        

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
    </body>
</html>

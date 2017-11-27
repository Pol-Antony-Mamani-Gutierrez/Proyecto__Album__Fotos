
<!DOCTYPE html>
<html>
    <head>
        <title>PHOTOGRAPHY_ADMINISTRATION</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="imagenes/logo_512_512-300x300.png" />
        <link rel="stylesheet" type="text/css" href="css/stilo_index.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="css/docs/css/metro-icons.css" rel="stylesheet">
    </head>
    <body>
        <header class="menu_horizontal " id="menu_horizontal">
            <input type="checkbox" id="btn_menu_hori">
            <label for="btn_menu_hori"> <img src="imagenes/menu_icono2.png" alt=""></label>
            <nav class="menu">
                <ul>
                    <li> <a href="index.php">Inicio</a> </li>  
                    <li> <a href="panel_control.php">Dashboard</a> </li>
                </ul>
            </nav>
        </header>
        <p class="titulo_general">Administración ||| Album de Fotos</p>
        <form class="form_logeo" action="php/sesion_star/inicio_session.php" method="post">
            <p class="form_login_titulo">Ingrese sus Datos para Acceder</p>
            <input name="usuario" type="text" class="form_login_text" placeholder="&#128272; Usuario (Correo@)" required="">
            <input name="password" type="password" class="form_login_pass" placeholder="&#128272; Contraseña" required="">
            <input type="submit" value="Ingresar" class="form_login_btn" >
            <p class="form_login_nuevo">Nuevo??.... Crea tu Cuenta. |||<a href="nuevo_usuario.php" class="form_login_nuevo_link"> ---Aquí---</a></p>
        </form>



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

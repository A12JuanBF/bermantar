<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>

        <title>BermAntar finder</title>


        <link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Buenard' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tienne' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Coda+Caption:800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <LINK REL=StyleSheet HREF="../css1/estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/filestyle.js"></script>
        <script>
            $(document).ready(function () {
                $("#registro form input").blur(function ()
                {
                    if ($(this).val() == "")
                    {
                        campo = $(this).attr('name');
                        if (campo == "usuario")
                        {
                            campo = "Nick de Usuario";
                        }
                        else if (campo == "pwd")
                        {
                            campo = "password";
                        }
                        else if (campo == "passusu")
                        {
                            campo = "password de tipo de usuario";
                        }
                        $("#registro").append("<p>El campo " + campo + " sin rellenar</p>");
                        $("#registro p").fadeOut(2000);
                        //$(this).css('border','1px solid red');
                    }
                });

            });
        </script>

    </head>
    <body>
        <header >

            <nav class="navbar navbar-default" role="navigation">
                <!-- El logotipo y el icono que despliega el menú se agrupan
                     para mostrarlos mejor en los dispositivos móviles -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Desplegar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="../img1/dibeflogo.jpg" alt="dibef.com" title="dibef.com"/>
                </div>

                <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                     otro elemento que se pueda ocultar al minimizar la barra -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href='../'>Inicio</a></li>

                    </ul>



                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Login <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="login.php">Login usuario</a></li>
                                <li><a href="../administrador/">Login administrador</a></li>
                                <li><a href="registro.php">Registro</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <section >
            <?php
            include 'conexion.php';


            if (empty($_POST)) {
                ?>
                <div id="registro">
                   <!-- <img src="../img1/crearcuenta.png"/> -->
                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group col-lg-6">
                            <label>Nombre:</label><input type="text" class="form-control" id="nombre" name="nombre" />
                            <label>Apellidos:</label><input type="text" class="form-control" id="apellidos" name="apellidos" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Nick de Usuario:</label><input type="text" class="form-control" id="usuario" name="usuario" />
                            <label>Password:</label><input type="password" class="form-control" id="pwd" name="pwd" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Password de tipo de Usuario:</label><input class="form-control" type="password" name="passusu" />

                            
                        </div>
                        <div class="form-group">
                            <label>Subir imagen de perfil</label><input type="file" name="imagen" id="imagen"/>
                            Para crear un tipo de usuario es obligatorio poner una password 
                            proporcionada por los administradores de la web en el campo "Password de tipo de Usuario".
                        </div>

                        <div class="form-group col-lg-6">
                        <input class="btn btn-default" type="reset" value="Borrar"/>
                        <input class="btn btn-primary" type="submit" value="Enviar"/>
                        </div>


                    </form>
                </div>

                <?php
            } else

            if (!empty($_POST['passusu']) && !empty($_POST['usuario']) && !empty($_POST['apellidos']) && !empty($_POST['pwd'])) {
                $clave = crypt($_POST['passusu'], 'xunta');
                $sql = sprintf("select * from password where password='%s'", $clave);
                $result = $mysqli->query($sql);
                if ($mysqli->affected_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tipo_usuario = $row['valor'];
                    }


                    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                    $limite_kb = 16384;

                    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024 || $_FILES['imagen']['size'] == 0) {

                        // Archivo temporal
                        $imagen_temporal = $_FILES['imagen']['tmp_name'];
                        $usuario = $_POST['usuario'];

                        // Tipo de archivo
                        $tipo = $_FILES['imagen']['type'];
                        if ($_FILES['imagen']['size'] != 0) {
                            @$data = file_get_contents($imagen_temporal);
                            @$data = mysql_escape_string($data);
                            @$sql = "INSERT INTO imagenes_web (imagen, tipo, usuario) VALUES ('$data', '$tipo','$usuario')";
                            @$resultado = $mysqli->query($sql);
                        }
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $nick = $_POST['usuario'];
                        $password = crypt($_POST['pwd'], 'xunta');
                        $nombretabla = 'temporal_' . $nick;


                        $sql = "INSERT INTO usuarios_web (nombre, apellidos, nick, password, tipo, tabla) VALUES ('$nombre', '$apellidos','$nick','$password','$tipo_usuario', '$nombretabla')";
                        $resultado1 = $mysqli->query($sql);

                        $sql = " CREATE TABLE " . $nombretabla . " ( titulo varchar(345) DEFAULT NULL, unid int(21) DEFAULT NULL, Ubic_c varchar(8) DEFAULT NULL, isbn_10 varchar(54) DEFAULT NULL, isbn_13 varchar(13) DEFAULT NULL, fecha varchar(10) DEFAULT NULL, autor varchar(302) DEFAULT NULL, editorial varchar(187) DEFAULT NULL, tipo varchar(59) DEFAULT NULL, pag varchar(5) DEFAULT NULL, idioma varchar(14) DEFAULT NULL, pais varchar(7) DEFAULT NULL, dimen varchar(28) DEFAULT NULL, comentario varchar(27) DEFAULT NULL, extra1 varchar(14) DEFAULT NULL, extra2 varchar(17) DEFAULT NULL, extra3 varchar(9) DEFAULT NULL, extra4 varchar(9) DEFAULT NULL, pale varchar(2) DEFAULT NULL, grupo varchar(2) DEFAULT NULL, id int(9) NOT NULL AUTO_INCREMENT, PRIMARY KEY (id) );";
                        //$sql=" CREATE TABLE ".$nombretabla."( titulo varchar(345) DEFAULT NULL, unid int(21) DEFAULT NULL );";
                        $resultado2 = $mysqli->query($sql);


                        if ($resultado1 == true && $resultado2 == true) {
                            echo '<div id="mensaje_login">';
                            echo "<h2>Usuario creado</h2>";
                            echo '</div>';
                        } else {
                            echo '<div id="mensaje_login">';
                            echo "<h2>Ocurrió algun error</h2>"
                            . "<a href='registro.php'>Volver</a>";
                            echo '</div>';
                        }
                    } else {
                        echo '<div id="mensaje_login">';
                        echo "<h2>Formato de archivo no permitido o excede el tamaño de $limite_kb Kbytes.</h2>"
                        . "<a href='registro.php'>Volver</a>";
                        echo '<div id="mensaje_login">';
                    }
                } else {
                    echo '<div id="mensaje_login">';
                    echo '<h2>Password de tipo de usuario incorrecto</h2>'
                    . '<a href="registro.php">Volver</a>';
                    echo '</div>';
                }
            } else {
                echo '<div id="mensaje_login">';
                echo '<h2>Campos vacíos</h2>'
                . '<a href="registro">Volver</a>';
                echo '</div>';
            }
            ?>





        </section>








    </body>
</html>
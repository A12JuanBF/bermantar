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

                // Desactivación de la caché en peticiones Ajax.
                $.ajaxSetup({cache: false});
                $("#login form").submit(function (evento)
                {
                    evento.preventDefault();
                    if ($("#login form input:eq(0)").val() != '' && $("#login input:eq(1)").val() != '')
                    {
                        $.post("peticiones.php?op=1", {usuario: $("#login form input:eq(0)").val(), password: $("#login form input:eq(1)").val()}, function (resultados)
                        {
                            if (resultados == 'ok')
                            {
                                $("#mensaje_login span").css("background", "linear-gradient(to bottom, #b2e1ff 0%,#66b6fc 100%)");
                                $("#mensaje_login span").fadeIn(300).html("Login correcto");
                                window.location = "../index.php";
                                $("#mensaje_login span").fadeOut(2000);
                            }
                            else
                            {
                                $("#mensaje_login span").css("background", "linear-gradient(to bottom, rgba(207,4,4,1) 0%,rgba(255,48,25,1) 75%)");
                                $("#mensaje_login span").fadeIn(2000).html("Login Incorrecto");
                                $("#mensaje_login span").fadeOut(3000);
                            }
                        });
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
                    <img src="img1/dibeflogo.jpg" alt="dibef.com" title="dibef.com"/>
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



                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <section>
            <div id="login" class="container">
              <!--  <img src="../img1/LOGIN.png" alt="login"/> -->
                <form   class="form-horizontal">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Usuario</label> 
                        <div class="col-lg-6">
                            <input name="nick" type="text" class="form-control"/>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label> 
                        <div class="col-lg-6">
                            <input name="password" type="password" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-6">
                            <input class="btn btn-default" type="reset" value="Cancelar"/>
                            <input class="btn btn-primary" type="submit" value="Entrar"/>
                            <div id="mensaje_login">
                                <span></span>
                            </div>
                        </div>

                    </div>



                </form>

            </div>
        </section>



        




    </body>
</html>
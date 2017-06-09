<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>





<header >

    <nav class="navbar navbar-default" role="navigation">
        <?php
                    include 'peticiones.php';
                    

                    if ($_SESSION['tipo_usuario'] == 'a') {
                        echo "<h6><i class='glyphicon glyphicon-user'></i> " . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] ." Tipo de usuario: Administrador</h6>";
                    } else
                        echo "<h6>" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] ." Tipo de usuario: Usuario</h6>";
                    ?>

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
                <li><a href='index.php'>Inicio</a></li>
                <li></li>
                <li><a href='listar.php'>Generador de listados</a></li>
                <li></li>
                <li><a href='insert.php'>Introducir Publicación</a></li>
                <li></li>
                <li ><a href='buscar.php'>Buscar Publicación</a></li>
                <li></li>
                <li ><a href='modificar.php'>Modificar Publicación</a></li>
                <li></li>
                <li><a href="entsal.php">Almacenar Entradas/Salidas</a></li>
                <li></li>
                <li><a href="busentsal.php">Buscar Entradas/Salidas</a></li>
                <li></li>
                <li><a href="notas.php">Notas<?php
                        /*$notificacion = new notas($_SESSION['id']);
                        if ($notificacion->notificaciones() != 0) {
                            echo '<span class="pull-right badge">';
                            echo $notificacion->notificaciones();
                            echo '</span>';
                        }*/
                        ?>


                    </a></li>

            </ul>



            <ul class="nav navbar-nav navbar-right">
                    

                <li><a href="inc_bermantar/logout.php"><span class="glyphicon glyphicon-log-out"></span>Desconectar</a>
                
                </li>
                    

            </ul>


        </div>
    </nav>

</header>

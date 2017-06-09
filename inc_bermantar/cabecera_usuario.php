<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>





<header >

    <nav class="navbar navbar-default" role="navigation">
        <?php
                    include 'peticiones.php';
                    

                    if ($_SESSION['tipo_usuario'] == 'a') {
                        echo "<h6>" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] ." Tipo de usuario: Administrador</h6>";
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
                <!-- <li><a href='listar.php'>Generador de listas</a></li>
                <li></li> -->
                <li ><a href='buscar.php'>Buscar Publicación</a></li>
                <li></li>
                <li><a href="busentsal.php">Buscar Entradas/Salidas</a></li>

            </ul>



            <ul class="nav navbar-nav navbar-right">


                <li><a href="inc_bermantar/logout.php"><span class="glyphicon glyphicon-log-out"></span>Desconectar</a></li>


            </ul>


        </div>
    </nav>
<?php
include 'peticiones.php';
echo "<div class='pull-right'><ul><li>Usuario:" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "</li>";

if ($_SESSION['tipo_usuario'] == 'a') {
    echo "<li>Tipo de usuario: Administrador</li>";
} else
    echo "<li>Tipo de usuario: Usuario</li></ul></div>";
?>
</header>

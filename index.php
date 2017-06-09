<?php
session_start();
include 'inc_bermantarOO/vistas/vista_bermantar.php';
include 'inc_bermantarOO/notasOO.php';
$vista = new vista_bermantar;
?>
<!DOCTYPE html>
<html>
    <head>

        <title>BermAntar finder</title>
        <link href='http://fonts.googleapis.com/css?family=Buenard' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tienne' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Coda+Caption:800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
        <link rel="icon" type="image/ico" href="img1/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="ISO-8859-1">
        <link REL=StyleSheet href="css1/estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/filestyle.js"></script>
        

    </head>
    <body>
        <?php
        include 'inc_bermantar/conexion.php';
        if (@$_SESSION['tipo_usuario'] == "a") {
            require 'inc_bermantar/cabecera_login.php';
        } elseif (@$_SESSION['tipo_usuario'] == "u")
            require 'inc_bermantar/cabecera_usuario.php';
        else
            require 'inc_bermantar/cabecera_logout.php';
        ?>


        <section>
            <div class="container">
                <h3 class="text-center">Página web diseñada y desarrollada para el almacén de Cultura en el Polígono del Tambre en Santiago de Compostela.</h3>


<!-- <p class="">Diseñadores: Juan Diego Bermejo Fernández y Simón Antar Nieto</p> -->
            </div>
        </section>



        




    </body>
</html>
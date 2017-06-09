

<?php
session_start();
include 'inc_bermantar/conexion.php';
include 'inc_bermantarOO/notasOO.php';

?>
<!DOCTYPE html>
<html>
    <head>

        <title>BermAntar finder</title>

        <link href='http://fonts.googleapis.com/css?family=Tienne' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Buenard' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tienne' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Coda+Caption:800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link REL=StyleSheet href="css1/estilos.css" TYPE="text/css" MEDIA=screen>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/filestyle.js"></script>
        <script src="js/entsal.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <style>
            footer span{
                color:black;
                font-size: 11px;
                font-family: 'Tauri', sans-serif;
            }  
            header h1,footer a{
                font-family: 'Coda Caption', sans-serif;
            }
            .btn{
                margin: 3px;
            } 
        </style>
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
            <?php
            if (@$_SESSION['tipo_usuario'] == "a") {
                require 'inc_bermantar/section_entsal.html';
            } elseif (@$_SESSION['tipo_usuario'] == "u") {
                require 'inc_bermantar/denegado.php';
            } else
                require 'inc_bermantar/denegado.php';
            ?>

        </section>



        




    </body>
</html>
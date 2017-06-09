<?php
session_start();

include 'inc_bermantar/conexion.php';
include 'inc_bermantarOO/vistas/vista_bermantar.php';
include 'inc_bermantarOO/notasOO.php';
$vista = new vista_bermantar;
?>
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
        <link REL=StyleSheet href="css1/notas_estilo.css" TYPE="text/css" MEDIA=screen>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/filestyle.js"></script>

        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
        <!-- polyfiller file to detect and load polyfills -->
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
        <script>
            $(document).ready(function () {

                $("#post_it form").submit(function (e) {
                    e.preventDefault();
                    parametros = {
                        "asunto": $("#post_it form input:eq(0)").val(),
                        "texto": $("#post_it form textarea").val()
                        
                    };
                    ruta="inc_bermantar/peticion_salent.php?op=9";
                    peticion_ajax(ruta, parametros);
                });
                $(".check ").on("click","a:eq(0)", function(e){
                    e.preventDefault();
                    check=$(this).attr("name");
                    if(check=="ok")
                    {
                        check=1;
                    }
                    if(check=="no_ok")
                    {
                        check=0;
                    }
                    padre=$(this).parent().parent();
                    id=padre.attr("id");
                   
                    parametros = {
                        "id": id,
                        "check": check  
                    };
                    ruta="inc_bermantar/peticion_salent.php?op=10";
                    peticion_ajax(ruta, parametros);
                    
                });
                $(".check ").on("click","a:eq(1)", function(e){
                    e.preventDefault();
                    padre=$(this).parent().parent();
                    id=padre.attr("id");
                    parametros = {
                        "id": id
                        
                    };
                    ruta="inc_bermantar/peticion_salent.php?op=11";
                    peticion_ajax(ruta, parametros);
                });

                function peticion_ajax(dest, param) {

                    $.ajax({
                        url: dest,
                        data: param,
                        type: 'POST',
                        beforeSend: function () {

                            //$("#contenedor_respuesta").html("Procesando, espere por favor...");

                        },
                        success: function (respuesta) {
                            
                            if(respuesta){
                                location.reload();
                            }



                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                }
            });
        </script>
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
            #tabla_busqueda{
                margin-top: 20px;
            }
            .table a{
                color:black;
            }
            #post_it{

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
                require 'inc_bermantar/postit.php';
            } elseif (@$_SESSION['tipo_usuario'] == "u") {
                require 'inc_bermantar/denegado.php';
            } else
                require 'inc_bermantar/denegado.php';
            ?>

        </section>
       
    </body>
</html>
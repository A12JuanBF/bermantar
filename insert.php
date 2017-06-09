<?php
session_start();

include 'inc_bermantar/conexion.php';
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <LINK REL=StyleSheet HREF="css1/estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css1/jquery-filestyle.css" rel='stylesheet' type='text/css'>
        <script src="js/jquery-filestyle.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                
                var selflink;
                $("#enviar").click(function () {
                    $.ajaxSetup({cache: false});
                    $("#mensaje_grabar >p").addClass("mensaje_oculto");
                    isbn = $("#isbn1").val();

                    $.getJSON("https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn, function (result) {
                        totalItems = result.totalItems;

                        $("#link").val(result);
                        if (totalItems == 0)
                        {
                            $("#mensaje_google").fadeIn(2000).addClass("incorrecto").html("Libro no encontrado en google books");
                            $("#mensaje_google").fadeOut(4000);

                        }
                        else
                        {
                            $("#mensaje_google").removeClass("incorrecto");
                            selflink = result.items[0].selfLink;
                            //$("#selflink").html(selflink);
                            $("#mensaje_google").fadeIn(2000).addClass("correcto").html("Libro encontrado");
                            $("#mensaje_google").fadeOut(4000);
                            $("#enviar2").attr("disabled", false);
                            $("#enviar2").css("opacity", "1");
                        }
                    });

                });
                $("#enviar2").click(function () {
                    $.getJSON(selflink, function (result) {

                        titulo = result.volumeInfo.title;
                        autor = result.volumeInfo.authors;
                        fech_pub = result.volumeInfo.publishedDate;
                        isbn_10 = result.volumeInfo.industryIdentifiers[0].identifier;
                        isbn_13 = result.volumeInfo.industryIdentifiers[1].identifier;
                        num_pag = result.volumeInfo.pageCount;
                        dimensiones1 = result.volumeInfo.dimensions.height;
                        dimensiones2 = result.volumeInfo.dimensions.width;
                        dimensiones3 = result.volumeInfo.dimensions.thickness;
                        tipo = result.volumeInfo.printType;
                        if (tipo == 'BOOK')
                        {
                            tipo = 'Libro';
                        }
                        lang = result.volumeInfo.language;
                        pais = result.accessInfo.country;
                        //descripcion=result.volumeInfo.description;
                        preview = result.volumeInfo.previewLink;
                        editorial = result.volumeInfo.publisher;

                        $("#titulo").val(titulo);
                        $("#autor").val(autor);
                        $("#editorial").val(editorial);
                        $("#fecha_publi").val(fech_pub);
                        //$("#unid").val();
                        //$("#ubicacion").val(ubicacion);
                        $("#isbn_10").val(isbn_10);
                        $("#isbn_13").val(isbn_13);
                        //$("#extra1").val(extra1);
                        //$("#extra2").val(extra2);
                        //$("#extra3").val(extra3);
                        //$("#extra4").val(extra4);
                        $("#dimensiones").val(dimensiones);
                        $("#num_pag").val(num_pag);
                        $("#idioma").val(lang);
                        $("#pais").val(pais);
                        $("#tipo").val(tipo);
                        //$("#coment").val(comentario);
                        //$("#pale").val(pale);
                        //$( "#grupo option:selected" ).text();


                        $("#dimensiones").val(dimensiones1 + " " + dimensiones2 + " " + dimensiones3);
                        /*li de descripcion
                         $("#descripcion li:eq(0) span").html(titulo);
                         $("#descripcion li:eq(1) span").html(autor);
                         $("#descripcion li:eq(2) span").html(editorial);
                         $("#descripcion li:eq(3) span").html(fech_pub);
                         $("#descripcion li:eq(4) span").html(isbn_13);
                         $("#descripcion li:eq(5) span").html(isbn_10);
                         $("#descripcion li:eq(6) span").html(tipo);
                         $("#descripcion li:eq(7) span").html(lang);
                         $("#descripcion li:eq(8) span").html(pais);
                         $("#descripcion li:eq(9) span").html(num_pag);
                         $("#descripcion li:eq(10) span").html(dimensiones1 + " " + dimensiones2 + " " + dimensiones3);
                         $("#descripcion li:eq(11) a").attr("href", preview);
                         $("#descripcion div").show("slow");
                         */
                        $("#selflink").html("");
                        $("#isbn1").val("");
                        selflink = "";
                    });
                });



                $("#unid").blur(function () {
                    if ($("#unid").val() == "")
                    {
                        $("#mensajes span").fadeIn(1000).addClass("incorrecto").html("El campo unidades es obligatorio");
                        $("#mensajes span").fadeOut(5000);

                    }
                });
                $("#ubicacion").blur(function () {
                    if ($("#ubicacion").val() == "")
                    {
                        $("#mensajes span").fadeIn(1000).addClass("incorrecto").html("El campo Ubicación es obligatorio");
                        $("#mensajes span").fadeOut(5000);

                    }
                });
                $("#caja_input form").submit(function (evento) {
                    evento.preventDefault();
                    $("#descripcion div").hide("slow");
                    $("#enviar2").attr("disabled", true);
                    $("#enviar2").css("opacity", "0.2");
                    if ($("#unid").val() == "" || $("#ubicacion").val() == "")
                    {
                        alert('Los campos unidades y ubicación son obligatorios');
                    }
                    else
                    {
                        $.ajaxSetup({cache: false});
                        $.post("inc_bermantar/peticiones.php?op=8", {titulo: $("#titulo").val(), unid: $("#unid").val(), ubic: $("#ubicacion").val(), isbn_10: $("#isbn_10").val(), isbn_13: $("#isbn_13").val(), fecha: $("#fecha_publi").val(), autor: $("#autor").val(), editorial: $("#editorial").val(), tipo: $("#tipo").val(), num_pag: $("#num_pag").val(), lang: $("#idioma").val(), pais: $("#pais").val(), dimen: $("#dimensiones").val(), comen: $("#coment").val(), extra1: $("#extra1").val(), extra2: $("#extra2").val(), extra3: $("#extra3").val(), extra4: $("#extra4").val(), pale: $("#pale").val(), grupo: $("#grupo").val(), caratula: $("#img_libro").val()}, function (resultados)
                        {
                            if (resultados == 'ok')
                            {
                                /*$("#mensaje_grabar p").fadeIn(1000).html("Datos introducidos");
                                 $("#mensaje_grabar p").fadeOut(2000);*/
                                alert('Datos introducidos');
                            }
                            else
                                $("#mensaje_grabar p").fadeIn(1000).html("Error de inserción");
                            $("#mensaje_grabar p").fadeOut(2000);
                        });

                    }
                });
                $(function () {

                    $("#file_img").change(function () {

                        var formData = new FormData($("#caja_input form")[0]);

                        ruta = "inc_bermantar/peticion_salent.php?op=5";

                        $.ajax({
                            url: ruta,
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (datos)

                            {
                                $("#img_libro").val(datos);


                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert("Status: " + textStatus);
                                alert("Error: " + errorThrown);
                            }
                        });

                    });
                });

            });

        </script>
        
    </head>
    <body>

        <?php
        if (@$_SESSION['tipo_usuario'] == "a") {
            require 'inc_bermantar/cabecera_login.php';
        } elseif (@$_SESSION['tipo_usuario'] == "u")
            require 'inc_bermantar/cabecera_usuario.php';
        else
            require 'inc_bermantar/cabecera_logout.php';
        ?>
        <section class="container-fluid">
            <?php
            if (@$_SESSION['tipo_usuario'] == "a") {
                require 'inc_bermantar/section_insertar.php';
            } elseif (@$_SESSION['tipo_usuario'] == "u") {
                require 'inc_bermantar/denegado.php';
            } else
                require 'inc_bermantar/denegado.php';
            ?>


        </section>

        



    </body>
</html>
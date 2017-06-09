<?php
@session_start();
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
        <LINK REL=StyleSheet HREF="css1/estilos.css" TYPE="text/css" MEDIA=screen>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/filestyle.js"></script>

        <script>
            $(document).ready(function () {
                var padre;
                $.ajaxSetup({cache: false});
                $("#borrar_buscar").click(function () {
                    $("#resultado_busqueda table").html("");
                });
                $("#buscador form").submit(function (evento) {

                    evento.preventDefault();
                    $.post("inc_bermantar/peticiones.php?op=2", {titulo: $("#titulo").val(), editorial: $("#editorial").val(), autor: $('#autor').val(), cod: $("#cod").val(), grupo: $("#grupo").val()}, function (resultados)
                    {

                        $("#resultado_busqueda table").html(resultados);


                    });
                });
                $("#resultado_busqueda").on("click", "a[name*='list_edit']", function (e)
                {
                    e.preventDefault();
                    padre = $(this).parent().parent();
                    id = padre.attr('id');
                    $("input", padre).attr('disabled', false);
                    padre.css("border", "2px solid green");
                    $("td>input").focus(function () {

                        var d = $(this).parent("td");

                        var col = d.parent().children().index(d);
                        
                        //var row = d.parent().parent().children().index(d.parent());


                        $("th:eq(" + col + ")").css("width", "40%");
                        $("td>input").blur(function () {
                            td1 = $(this).parent();
                            td1.css("width", "auto");
                            $("th:eq(" + col + ")").css("width", "auto");
                            col = 0;
                        });
                    });
                    $("td:eq(20) input[type='file']", padre).change(function ()
                    {
                        //alert('bien' + id);
                        var formData = new FormData($("td:eq(20) form", padre)[0]);
                        formData.append("id", id);

                        dest = "inc_bermantar/peticion_salent.php?op=8";

                        $.ajax({
                            url: dest,
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            beforeSend: function () {



                            },
                            success: function (respuesta) {

                                if (respuesta)
                                {
                                    $("td:eq(20) input[type='text']", padre).val(respuesta);
                                    //alert(respuesta);

                                }
                                else {
                                    alert("Ha ocurrido un error ");
                                }

                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert("Ha ocurrido un error .");
                            }
                        });

                    });

                    $("a[name*='ok']", padre).click(function (e) {
                        e.preventDefault();
                        $.post("inc_bermantar/peticiones.php?op=11", {titulo: $("td:eq(0)>input", padre).val(), unid: $("td:eq(1)>input", padre).val(), ubic: $("td:eq(2)>input", padre).val(), isbn_10: $("td:eq(3)>input", padre).val(), isbn_13: $("td:eq(4)>input", padre).val(), fecha: $("td:eq(5)>input", padre).val(), autor: $("td:eq(6)>input", padre).val(), editorial: $("td:eq(7)>input", padre).val(), tipo: $("td:eq(8)>input", padre).val(), num_pag: $("td:eq(9)>input", padre).val(), lang: $("td:eq(10)>input", padre).val(), pais: $("td:eq(11)>input", padre).val(), dimen: $("td:eq(12)>input", padre).val(), comen: $("td:eq(13)>input", padre).val(), extra1: $("td:eq(14)>input", padre).val(), extra2: $("td:eq(15)>input", padre).val(), extra3: $("td:eq(16)>input", padre).val(), extra4: $("td:eq(17)>input", padre).val(), pale: $("td:eq(18)>input", padre).val(), grupo: $("td:eq(19)>input", padre).val(), id: id, nombre_caratula: $("td:eq(20) input:eq(1)", padre).val()}, function (resultados)
                        {
                            //alert(resultados);
                            if (resultados == 'ok')
                            {
                                padre.fadeOut(1000);

                            }
                            else
                                alert('error');
                        });
                    });
                    $("a[name*='remove']", padre).click(function (e) {
                        e.preventDefault();
                        confirmacion = confirm("¿Confirma que quieres borrar esta publicación de la base de datos del almacén?");
                        parametros = {
                            "id": id
                        };
                        if (confirmacion)
                        {
                            dest = "inc_bermantar/peticion_salent.php?op=6";
                            ajax(dest, parametros);

                        }

                    });
                });
                function ajax(dest, param) {

                    $.ajax({
                        url: dest,
                        data: param,
                        type: 'POST',
                        beforeSend: function () {



                        },
                        success: function (respuesta) {

                            if (respuesta)
                            {

                                padre.fadeOut(1000);
                            }
                            else {
                                alert("Ha ocurrido un error ");
                            }

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Ha ocurrido un error .");
                        }
                    });


                }
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
        <section>
            <?php
            if (@$_SESSION['tipo_usuario'] == "a") {
                require 'inc_bermantar/section_modificar.php';
            } elseif (@$_SESSION['tipo_usuario'] == "u") {
                require 'inc_bermantar/denegado.php';
            } else
                require 'inc_bermantar/denegado.php';
            ?>
        </section>



        




    </body>
</html>
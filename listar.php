<?php
session_start();
include 'inc_bermantarOO/notasOO.php';
include 'inc_bermantarOO/vistas/vista_bermantar.php';

if (@$_SESSION['tabla'] == "") {
    @$_SESSION['tabla'] = 'anonimo_temporal';
}
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
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/filestyle.js"></script>
        <script type="text/javascript" src="js/editoriales.js"></script>
        <script type="text/javascript" src="js/jquery.confirm.js"></script>
        <script>
            $(document).ready(function () {
                var selflink;
                var fichero;
                var fichero_mod;
                $("#enviar").submit(function (e) {
                    $("#mensaje_google").fadeOut();
                    e.preventDefault();
                    $.ajaxSetup({cache: false});
                    isbn = $("#isbn1").val();
                    $("#caja_input1 input").val("");
                    dest = "inc_bermantar/peticion_salent.php?op=7";
                    param = {
                        "cod": isbn

                    };
                    $.ajax({
                        url: dest,
                        data: param,
                        dataType: "json",
                        type: 'POST',
                        beforeSend: function () {



                        },
                        success: function (respuesta) {

                            //console.log(respuesta);
                            //console.log(respuesta.publicacion[0]);
                            if (respuesta.publicacion != false)
                            {
                                titulo = respuesta.publicacion[0].titulo;
                                autor = respuesta.publicacion[0].autor;
                                fech_pub = respuesta.publicacion[0].fecha;
                                isbn_10 = respuesta.publicacion[0].isbn_10;
                                isbn_13 = respuesta.publicacion[0].isbn_13;
                                num_pag = respuesta.publicacion[0].pag;
                                dimen = respuesta.publicacion[0].dimen;
                                editorial = string_editorial(respuesta.publicacion[0].editorial);
                                tipo = respuesta.publicacion[0].tipo;
                                lang = respuesta.publicacion[0].idioma;
                                pais = respuesta.publicacion[0].pais;
                                //descripcion=result.volumeInfo.description;
                                //preview = result.volumeInfo.previewLink;
                                //editorial = result.volumeInfo.publisher;
                                //editorial = string_editorial(respuesta.editorial);
                                extra1 = respuesta.publicacion[0].extra1;
                                extra2 = respuesta.publicacion[0].extra2;
                                extra3 = respuesta.extra3;
                                extra4 = respuesta.publicacion[0].extra4;
                                $("#titulo").val(titulo);
                                $("#autor").val(autor);
                                $("#fecha_publi").val(fech_pub);
                                $("#isbn_10").val(isbn_10);
                                $("#isbn_13").val(isbn_13);
                                $("#num_pag").val(num_pag);
                                $("#tipo").val(tipo);
                                $("#idioma").val(lang);
                                $("#pais").val(pais);
                                $("#editorial").val(editorial);
                                $("#dimensiones").val(dimen);
                                $("#extra1").val(extra1);
                                $("#extra2").val(extra2);
                                $("#extra3").val(extra3);
                                $("#extra4").val(extra4);
                                //$("#descripcion1 div:first-child").show("slow");
                                //$("#descripcion1 li:eq(0) span").html(titulo);
                                //$("#descripcion1 li:eq(1) span").html(autor);
                                //$("#descripcion1 li:eq(2) span").html(editorial);
                                //$("#descripcion1 li:eq(3) span").html(fech_pub);
                                //$("#descripcion1 li:eq(4) span").html(isbn_13);
                                //$("#descripcion1 li:eq(5) span").html(isbn_10);
                                //$("#descripcion1 li:eq(6) span").html(tipo);
                                //$("#descripcion1 li:eq(7) span").html(lang);
                                //$("#descripcion1 li:eq(8) span").html(pais);
                                //$("#descripcion1 li:eq(9) span").html(num_pag);
                                //$("#descripcion1 li:eq(10) span").html(dimen);
                            }
                            else
                            {
                                $.getJSON("https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn, function (result) {
                                    totalItems = result.totalItems;
                                    $("#link").val(result);
                                    if (totalItems == 0)
                                    {
                                        $("#mensaje_google").fadeIn(2000).addClass("incorrecto").html("Publicación no encontrada en la base de datos de Bermantar ni en google books");
                                    }
                                    else
                                    {
                                        selflink = result.items[0].selfLink;
                                        $.getJSON(selflink, function (result) {
                                            $("#descripcion1 div:first-child").show("slow");
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
                                            //editorial = result.volumeInfo.publisher;
                                            editorial = string_editorial(result.volumeInfo.publisher);
                                            $("#titulo").val(titulo);
                                            $("#autor").val(autor);
                                            $("#fecha_publi").val(fech_pub);
                                            $("#isbn_10").val(isbn_10);
                                            $("#isbn_13").val(isbn_13);
                                            $("#num_pag").val(num_pag);
                                            $("#tipo").val(tipo);
                                            $("#idioma").val(lang);
                                            $("#pais").val(pais);
                                            $("#editorial").val(editorial);
                                            $("#dimensiones").val(dimensiones1 + " " + dimensiones2 + " " + dimensiones3);
                                            //li de descripcion
                                            $("#descripcion1 li:eq(0) span").html(titulo);
                                            $("#descripcion1 li:eq(1) span").html(autor);
                                            $("#descripcion1 li:eq(2) span").html(editorial);
                                            $("#descripcion1 li:eq(3) span").html(fech_pub);
                                            $("#descripcion1 li:eq(4) span").html(isbn_13);
                                            $("#descripcion1 li:eq(5) span").html(isbn_10);
                                            $("#descripcion1 li:eq(6) span").html(tipo);
                                            $("#descripcion1 li:eq(7) span").html(lang);
                                            $("#descripcion1 li:eq(8) span").html(pais);
                                            $("#descripcion1 li:eq(9) span").html(num_pag);
                                            $("#descripcion1 li:eq(10) span").html(dimensiones1 + " " + dimensiones2 + " " + dimensiones3);
                                            $("#descripcion1 li:eq(11) a").attr("href", preview);
                                            $("#selflink").html("");
                                            $("#isbn1").val("");
                                            selflink = "";
                                        });
                                    }
                                });
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                });
                $("#borrar").click(function () {
                    $("#caja_input1 input").val("");
                    $("#descripcion1 li >span").html("");
                });
                $("#fila_excel").click(function () {

                    editorial = $("#editorial").val();
                    editorial = string_editorial(editorial);
                    titulo = $("#titulo").val();
                    autor = $("#autor").val();
                    fech_pub = $("#fecha_publi").val();
                    isbn_10 = $("#isbn_10").val();
                    isbn_13 = $("#isbn_13").val();
                    num_pag = $("#num_pag").val();
                    tipo = $("#tipo").val();
                    lang = $("#idioma").val();
                    pais = $("#pais").val();
                    unidades = $("#unid").val();
                    ubicacion = $("#ubicacion").val();
                    dimensiones = $("#dimensiones").val();
                    comentario = $("#coment").val();
                    extra1 = $("#extra1").val();
                    extra2 = $("#extra2").val();
                    extra3 = $("#extra3").val();
                    extra4 = $("#extra4").val();
                    //9788432250828
                    if (unidades == "")
                    {
                        $("#mensajes span").fadeIn(2000).addClass("incorrecto").html("El campo unidades es obligatorio");
                        $("#mensajes span").fadeOut(4000);
                    }
                    if ($("#unid").val() != "")
                    {
                        $("#excel").css("border", "solid 1px black");
                        $("#descripcion1 div:first-child").hide("slow");
                        $("#head_excel").show("slow");
                        $("#enviar2").attr("disabled", true);
                        $("#enviar2").css("opacity", "0.2");
                        // codigo para generar filas csv
                        //   $("#excel").append("<span>\""+titulo+"\",\""+unidades +"\",\""+ubicacion+"\","+"\""+isbn_10+"\","+"\""+isbn_13+"\","+
                        //   "\""+fech_pub+"\",\""+autor+"\",\""+editorial+"\",\""+tipo+"\",\""+num_pag+"\",\""+lang+"\",\""+ pais+"\",\""+dimensiones+"\",\""+comentario+"\",\""+extra1+"\",\""+extra2 +"\",\""+extra3 +"\",\""+extra4 +"\"</span></br>");
                        // $("#caja_input1 input").val("");
                        $.post("inc_bermantar/peticiones.php?op=3", {tabla: $("#tabla_csv span").html(), titulo: titulo, unid: unidades, ubic: ubicacion, isbn_10: isbn_10, isbn_13: isbn_13, fecha: fech_pub, autor: autor, editorial: editorial, tipo: tipo, num_pag: num_pag, lang: lang, pais: pais, dimen: dimensiones, comen: comentario, extra1: extra1, extra2: extra2, extra3: extra3, extra4: extra4}, function (resultados)
                        {
                            $.ajaxSetup({cache: false});
                            if (resultados != "")
                            {
                                $("#tabla_csv table").html(resultados);
                            }
                            else
                                $("#tabla_csv table").html('error');
                        });
                        $("#isbn1").val("");
                    }
                    /* Ventana que aparece al restar unidades */
                    if ($("#unid").val() != "" && ($("#isbn_10").val() != "" || $("#isbn_13").val() != "" || $("#extra1").val() != "" || $("#extra2").val() != "" || $("#extra3").val() != "" || $("#extra4").val() != ""))
                    {
                        $.post("inc_bermantar/peticiones.php?op=12", {isbn_10: $("#isbn_10").val(), isbn_13: $("#isbn_13").val(), unid: $("#unid").val(), extra1: $("#extra1").val(), extra2: $("#extra2").val(), extra3: $("#extra3").val(), extra4: $("#extra4").val(), seccion: $("#seccion").val()}, function (resultados)
                        {
                            if (resultados != "")
                            {
                                $("#enviar button,#fila_excel").attr("disabled", true);
                                $("#enviar button,#fila_excel").css("opacity", "0.3");
                                $("#head_excel").hide();
                                $(".restar-listar").show();
                                $(".restar-listar").html(resultados);
                                $(".restar-listar button:eq(0)").click(function ()
                                {
                                    $("#enviar button,#fila_excel").attr("disabled", false);
                                    $("#enviar button,#fila_excel").css("opacity", "1");
                                    $(".restar-listar").fadeOut(2000);
                                    $("#head_excel").show('slow');
                                    $(".restar-listar").html("");
                                    $(".restar-listar").hide();
                                });
                                $(".restar-listar button:eq(1)").click(function ()
                                {
                                    $.post("inc_bermantar/peticiones.php?op=13", {unid: $(".restar-listar p > span").text(), id: $("#idpubli").text()}, function (resultados)
                                    {
                                        if (resultados == "ok")
                                        {
                                            $("#enviar button,#fila_excel").attr("disabled", false);
                                            $("#enviar button,#fila_excel").css("opacity", "1");
                                            $(".restar-listar").fadeOut(2000);
                                            $("#head_excel").show('slow');
                                            $(".restar-listar table").append("<span>Unidades restadas</span>");
                                            $(".restar-listar span").fadeOut(2000);
                                            $(".restar-listar").html("");
                                            $(".restar-listar").hide();
                                        }
                                    });
                                });
                            }

                        });
                    }

                });
                $("#botones button:eq(0)").click(function () {
                    $.ajaxSetup({cache: false});
                    $("#head_excel").hide("slow");
                    // jquery para borrar todas las filas en csv
                    //$("#excel").css("border","none");
                    //$("#excel span").remove();
                    //$("#excel br").remove();
                    $("#tabla_csv table").html("");
                    $("#tabla_csv a").fadeOut(1000);
                    $.get("inc_bermantar/peticiones.php?op=6", function (resultados)
                    {
                        if (resultados == 'ok')
                        {

                        }
                    });
                });
                $("#botones button:eq(1)").click(function () {
                    $.post("inc_bermantar/peticiones.php?op=7", {tabla: $("#tabla_csv span").html()}, function (resultados)
                    {
                        $.ajaxSetup({cache: false});
                        if (resultados == 'ok')
                        {
                            $("#tabla_csv table tr:last").remove();
                        }
                        else {
                            alert('No existen filas que borrar');
                        }
                    });
                    // jquery para borrar la última fila en csv
                    //$("#excel span:last").remove();
                    //$("#excel br:last").remove();

                });
                $("#unid").blur(function () {
                    if ($("#unid").val() == "")
                    {
                        $("#mensajes span").fadeIn(2000).addClass("incorrecto").html("El campo unidades es obligatorio");
                        $("#mensajes span").fadeOut(4000);
                        $("#unid").focus();
                    }
                });
                $("#tabla_csv button").click(function () {


                    fichero = prompt('¿A quién va dirigido el pack de libros?');
                    fichero_mod = fichero.replace(/ /g, "_");
                    $('#fichero').html(fichero_mod);
                    tabla = $("#table").html();
                    $("#pdf").attr("href", "generarpdf.php?tabla=" + tabla + "&fichero=" + $('#fichero').html());
                    $.post("inc_bermantar/peticiones.php?op=5", {nombre_fich: fichero}, function (resultados)
                    {
                        $.ajaxSetup({cache: false});
                        if (resultados == 'ok')
                        {
                            $("#crearpdf").show('slow');
                            $("#crearpdf a").show('slow');
                            $("#pdfNO").click(function () {
                                $("#crearpdf").hide('slow');
                                $("#crearpdf a").hide('slow');
                                $("#csv").show('slow');
                            });
                            $("#pdf").click(function () {
                                $("#crearpdf").hide('slow');
                                $("#crearpdf a").hide('slow');
                                $("#csv").show('slow');
                            });
                            $("#csv").click(function () {
                                $("#crearpdf").hide('slow');
                                $("#crearpdf a").hide('slow');
                                $("#csv").hide('slow');
                            });
                        }
                    });
                });
                $("#csv").click(function () {
                    $("#tabla_csv table").html("");
                    $("#tabla_csv a").fadeOut(1000);
                });
                $("#pdfNO").click(function (e) {
                    e.preventDefault()

                });
                $("#continuar form").submit(function (e) {
                    e.preventDefault();
                    $.post("inc_bermantar/peticiones.php?op=15", {tabla: $("#table").text()}, function (resultados)
                    {
                        $("#tabla_csv table").html(resultados);
                        $("#continuar").html("");
                    });
                });
            });


        </script>
        <style>

            footer span{
                color:black;
                font-size: 11px;

            }

            #tabla_csv a{
                display: none;

                text-decoration: highlight;
            }
            #fichero{
                display: none;
            }

        </style>

    </head>
    <body>

        <?php
        $vista = new vista_bermantar();
        include 'inc_bermantar/conexion.php';
        if (@$_SESSION['tipo_usuario'] == "a") {
            require 'inc_bermantar/cabecera_login.php';
        } elseif (@$_SESSION['tipo_usuario'] == "u")
            require 'inc_bermantar/cabecera_usuario.php';
        else
            require 'inc_bermantar/cabecera_logout.php';
        ?>

        <section id="cuerpo" class="container-fluid">
            <article id="buscar-listar" class="col-lg-12">
                <h4><i class="glyphicon glyphicon-search"></i> Introduce ISBN del libro:</h4><form  id="enviar"><label></label><input id="isbn1">
                    <button type="submit" class="btn btn-danger">Buscar Publicación</button></form>
                <?php $vista->continuarListado($_SESSION['tabla']); ?>
                <br>
                <span id="mensaje_google"></span><br><br>
            </article>
            <div class="container">
                <div class="col-lg-2 hidden-xs hidden-sm" id="descripcion1">  
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <h5 class="text-center"></h5>
                        </div>
                        <div class="col-lg-12">

                            <img src="" class="img-thumbnail">
                        </div>
                        <div class="col-lg-12">
                            <h6></h6>
                            <p><span></span></p>
                        </div>

                        <!--<ul>
                            <li>Título:<span></span></li>  
                            <li>Autor:<span></span></li>
                            <li>Editorial:<span></span></li>
                            <li>Fecha de publicación:<span></span></li>
                            <li>ISBN 13: <span></span></li>
                            <li>ISBN 10:<span></span></li>
                            <li>Tipo de publicación:<span></span></li>
                            <li>Idioma:<span></span></li>
                            <li>País:<span></span></li>
                            <li>Num. Páginas:<span></span></li>
                            <li>Dimensiones:<span></span></li>
                            <li><a href="">Link a Google Books</a></li>
    
                        </ul>
                        -->
                    </div>
                </div>



                <section id="section2">
                    <div class="col-lg-10 panel panel-default" id="caja_input1">

                        <div class="panel-body">
                            <div  class="row form-group">
                                <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4">
                                    <label>Título</label><input class="form-control input-sm" id="titulo">
                                </div>
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Autor</label><input class="form-control input-sm" id="autor">
                                </div>
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Editorial</label><input class="form-control input-sm" id="editorial">
                                </div>
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Fecha</label><input class="form-control input-sm" id="fecha_publi">
                                </div>
                                <div class="col-lg-1 col-sm-1 col-xs-1 col-md-1">
                                    <label>Idioma</label><input class="form-control input-sm" id="idioma">
                                </div>
                                <div class="col-lg-1 col-sm-1 col-xs-1 col-md-1">
                                    <label>País</label><input class="form-control input-sm" id="pais">
                                </div>

                            </div>
                            <hr>
                            <div  class="row form-group ">
                                <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4">
                                    <label>ISBN 10</label><input class="form-control input-sm" id="isbn_10">
                                </div>
                                <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4">
                                    <label>ISBN 13</label><input class="form-control input-sm" id="isbn_13">

                                </div>
                            </div>
                            <div class="row form-group ">
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>EXTRA 1</label><input class="form-control input-sm" id="extra1">
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>EXTRA 2</label><input class="form-control input-sm" id="extra2">
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>EXTRA 3</label><input class="form-control input-sm" id="extra3">
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>EXTRA 4</label><input class="form-control input-sm" id="extra4">
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group ">
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>Dimensiones</label><input class="form-control input-sm" id="dimensiones">
                                </div>
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Num. páginas</label><input class="form-control input-sm" id="num_pag">
                                </div>


                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>Tipo publicación</label><input class="form-control input-sm" id="tipo">
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>Comentario</label><input class="form-control input-sm" id="coment">
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group ">
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Unidades</label><input class="form-control input-sm" id="unid">
                                </div>
                                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                                    <label>Ubicación</label><input class="form-control input-sm" id="ubicacion">
                                </div>
                                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                                    <label>Sección del almacén</label>
                                    <select id="seccion" class="form-control" >
                                        <option value=""></option>
                                        <option value="IZ">Lado izquierdo</option>
                                        <option value="v">Venales</option>
                                        <option value="t">Edgar Torre</option>
                                        <option value="x">Rúa X</option>
                                        <option value="D">Distribución a Bibliotecas</option>

                                    </select>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                                    <div id="mensajes"><span></span></div>
                                </div>
                            </div>
                            <article>
                                <button  id="borrar" class="btn btn-default">Borrar</button>
                                <button id="fila_excel" class="btn btn-primary">Añadir publicacion</button>
                            </article>
                        </div>
                    </div>         

                </section>

            </div>
            <div class="col-lg-10">

            </div>
        </section>
        <div class="restar-listar col-lg-10">
            
        </div>
        <div class="col-lg-10" id="head_excel">


            <h4><i class="glyphicon glyphicon-list-alt"></i> Crea un archivo csv a partir de la tabla que se genera debajo</h4>
            <div id="botones">

                <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar todo</button> 
                <button class="btn btn-warning"><i class="glyphicon glyphicon-remove-circle"></i> Borrar última línea</button>
                <span id="linea_borrada" style="display:none;">Último registro borrado</span>

            </div>   
        </div>
        <!--<div id="excel"> 
        contenedor que genera filas csv
    
        </div> -->

        <div class="col-lg-12" id="tabla_csv">
            <div class="row" id="down-lista">
                <button class="btn btn-default">¿A quién va dirigido el pack de libros?</button>
                <p id="crearpdf" class="well well-lg">¿Desea crear un listado en pdf?: <a id="pdf" href="#" target="blank">Si</a> | <a id="pdfNO" href="#">NO</a>
                </p>
                <a href="inc_bermantar/peticiones.php?op=4" id="csv"><i class="glyphicon glyphicon-cloud-download"></i> Descargar CSV</a>
                <span id="table" class="hiden"><?php echo @$_SESSION['tabla']; ?></span> 
                <span id="fichero"></span>
            </div>
            <div>
                <table class="table table-bordered table-condensed table-responsive table-striped" >

                </table>
            </div>

        </div>







    </body>
</html>
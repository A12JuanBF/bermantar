/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var idnum = "";
    $("#provincia").load("inc_bermantar/provincias.php", function (response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            alert(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $("#escoger select").change(function ()
    {
        valor = $('#escoger select').val();
        if (valor == 'Buscar Entrada')
        {
            $('#buscar_salida').hide();
            $('#buscar_entrada').show('slow');
        }
        else if (valor == 'Buscar Salida')
        {
            $('#buscar_entrada').hide();
            $('#buscar_salida').show('slow');
        }
        else
        {
            $('#buscar_salida').hide();
            $('#buscar_entrada').hide();
        }
    });

    $("#buscar_salida input[type='reset'] , #buscar_entrada input[type='reset']").click(function ()
    {
        $("#tabla_busqueda").html("");
    });


    $("#buscar_salida form").submit(function (e)
    {
        e.preventDefault();
        parametros = {
            "destinatario_org": $("#buscar_salida input:eq(0)").val(),
            "destinatario_pers": $("#buscar_salida input:eq(1)").val(),
            "localidad": $("#buscar_salida input:eq(2)").val(),
            "cod_correos": $("#buscar_salida input:eq(3)").val(),
            "fecha": $("#buscar_salida input:eq(4)").val(),
            "modo_salida": $("#buscar_salida select:eq(0)").val(),
            "tipo_envio": $("#buscar_salida select:eq(1)").val()
        };
        ruta = "inc_bermantar/bloque_buscarsalida.php";
        peticion_ajax(ruta, parametros);
    });

    $("#buscar_entrada form").submit(function (e)
    {

        e.preventDefault();
        parametros = {
            "empresa": $("#buscar_entrada input:eq(0)").val(),
            "persona": $("#buscar_entrada input:eq(1)").val(),
            "fecha": $("#buscar_entrada input:eq(2)").val(),
            "tipo_entrada": $("#buscar_entrada select").val()

        };
        ruta = "inc_bermantar/bloque_buscarentrada.php";
        peticion_ajax(ruta, parametros);
    });


    function peticion_ajax(dest, param) {

        $.ajax({
            url: dest,
            data: param,
            type: 'POST',
            cache: false,
            beforeSend: function () {

                $("#contenedor_respuesta").show();

            },
            success: function (respuesta) {
                $("#contenedor_respuesta").hide();

                $("#tabla_busqueda").html(respuesta);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    }

    $("#tabla_busqueda").on("click", "span", function (eve) {

        eve.preventDefault();
        $("#buscar_salida").css("opacity", "0.3");
        $("#tabla_busqueda").html("");
        $("#modificar").fadeIn("slow");
        id = $(this).parent().parent();
        idnum = id.attr("id");
        registro = id.attr("id");
        emp = $("td:eq(0)", id).text();
        pers = $("td:eq(1)", id).text();
        dir = $("td:eq(2)", id).text();
        loc = $("td:eq(3)", id).text();
        prov = $("td:eq(4)", id).text();
        cp = $("td:eq(5)", id).text();
        fech = $("td:eq(6)", id).text();
        mod = $("td:eq(7)", id).text();
        tipo = $("td:eq(8)", id).text();
        cod = $("td:eq(9)", id).text();
        coment = $("td:eq(10)", id).text();
        if ($("td:eq(11) a[name='pdf']", id).length > 0) {
            pdf = $("td:eq(11) a[name='pdf']", id).attr("href");
            pdf = pdf.split('/');
            pdfS = pdf[1];
            $("#subir_pdf label").text(pdfS);
            $("#pdfprov").val(pdfS);
        }
        if ($("td:eq(11) a[name='csv']", id).length > 0) {
            csv = $("td:eq(11) a[name='csv']", id).attr("href");
            csv = csv.split('/');
            csvS = csv[1];
            $("#subir_csv label").text(csvS);

            $("#csvprov").val(csvS);
        }


        $("#empresa").val(emp);
        $("#persona").val(pers);
        $("#direccion").val(dir);
        $("#localidad").val(loc);
        $("#provincia").val(prov);
        $("#cp").val(cp);
        $("#fecha").val(fech);
        $("#modo").val(mod);
        $("#tipo").val(tipo);
        $("#codigo").val(cod);
        $("#comentario").val(coment);





    });
    $("#actualizar").click(function () {


        parama = {
            "id": idnum,
            "destinatario_org": $("#empresa").val(),
            "destinatario_pers": $("#persona").val(),
            "direccion": $("#direccion").val(),
            "localidad": $("#localidad").val(),
            "provincia": $("#provincia").val(),
            "cp": $("#cp").val(),
            "fecha": $("#fecha").val(),
            "modo_salida": $("#modo").val(),
            "tipo_envio": $("#tipo").val(),
            "cod_correos": $("#codigo").val(),
            "comentario": $("#comentario").val(),
            "csv": $("#csvprov").val(),
            "pdf": $("#pdfprov").val()

        };
        destino = "inc_bermantar/peticion_salent.php?op=12";
        //peticion_ajax(destino, parama);
        $.ajax({
            url: destino,
            data: parama,
            type: 'POST',
            cache: false,
            beforeSend: function () {

                $("#respuesta_modificar").fadeIn("slow");

            },
            success: function (respuesta) {
                $("#respuesta_modificar input , #csvprov ,#pdfprov").val("");
                $("#subir_csv label").text("Selecciona csv");
                $("#subir_pdf label").text("listado/factura");
                $('#pdf_mod').val("");
                $('#csv_mod').val("");
                document.getElementById("subir_pdf").reset();
                document.getElementById("subir_csv").reset();
                
                $("#respuesta_modificar").fadeOut("slow");
                $("#buscar_salida").css("opacity", "1");
                if (respuesta)
                {
                    $("#modificar").fadeOut("slow");
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#respuesta_modificar").fadeOut("slow");
                $("#buscar_salida").css("opacity", "1");
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });
    $("#eliminar").click(function () {
        parama = {
            "id": idnum,
            "csv": $("#csvprov").val(),
            "pdf": $("#pdfprov").val()

        };
        destino = "inc_bermantar/peticion_salent.php?op=15";
        //peticion_ajax(destino, parama);
        $.ajax({
            url: destino,
            data: parama,
            type: 'POST',
            cache: false,
            beforeSend: function () {

                $("#respuesta_modificar").fadeIn("slow");

            },
            success: function (respuesta) {
                $("#respuesta_modificar input ,#csvprov ,#pdfprov").val("");
                $("#subir_csv label").text("Selecciona csv");
                $("#subir_pdf label").text("listado/factura");
                $('#pdf_mod').val("");
                $('#csv_mod').val("");
                document.getElementById("subir_pdf").reset();
                document.getElementById("subir_csv").reset();
               
                $("#respuesta_modificar input").val();
                $("#respuesta_modificar").fadeOut("slow");
                $("#buscar_salida").css("opacity", "1");
                if (respuesta)
                {
                    $("#modificar").fadeOut("slow");
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#respuesta_modificar").fadeOut("slow");
                $("#buscar_salida").css("opacity", "1");
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

    $("#pdf_mod").change(function () {
        //alert("ola");
        var formData = new FormData($("#subir_pdf")[0]);
        formData.append("id", idnum);
        ruta = "inc_bermantar/peticion_salent.php?op=13";

        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "html",
            success: function (datos)

            {

                if (datos != false)
                {
                    $("#pdfprov").val(datos);
                }
                else
                {
                    $("#pdfprov").val("");
                    alert('No es un archivo pdf');
                }
            }

        });

    });
    $("#csv_mod").change(function () {
        //alert("ola");
        var formData = new FormData($("#subir_csv")[0]);
        formData.append("id", idnum);
        ruta = "inc_bermantar/peticion_salent.php?op=14";

        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "html",
            success: function (datos)

            {

                if (datos != false)
                {
                    $("#csvprov").val(datos);
                }
                else
                {
                    $("#csvprov").val("");
                    alert('No es un archivo csv');
                }
            }

        });

    });
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    //$('#salida select:eq(0)').load('provincias.php');

    $("#salida select:eq(0)").load("inc_bermantar/provincias.php", function (response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            alert(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $('#escoger select').change(function ()
    {
        valor = $('#escoger select').val();
        if (valor == 'Registrar Entrada')
        {
            $('#salida').hide();
            $('#entrada').show('slow');
        }
        else if (valor == 'Registrar Salida')
        {
            $('#entrada').hide();
            $('#salida').show('slow');
        }
        else
        {
            $('#salida').hide();
            $('#entrada').hide();
        }
    });

    $("#salida button:eq(1)").click(function ()
    {
        if ($("#salida input:eq(4)").val() != "")
        {
            cp = $("#salida input:eq(4)").val();
        }
        else
        {
            cp = 0;
        }
        parametros = {
            "destinatario_org": $("#salida input:eq(0)").val(),
            "destinatario_pers": $("#salida input:eq(1)").val(),
            "direccion": $("#salida input:eq(2)").val(),
            "localidad": $("#salida input:eq(3)").val(),
            "provincia": $("#salida select:eq(0)").val(),
            "cp": cp,
            "fecha": $("#salida input:eq(5)").val(),
            "modo_salida": $("#salida select:eq(1)").val(),
            "tipo_envio": $("#salida select:eq(2)").val(),
            "cod_correos": $("#salida textarea:eq(0)").val(),
            "csv": $("#salida input:eq(10)").val(),
            "pdf": $("#salida input:eq(11)").val(),
            "comentario":$("#salida textarea:eq(1)").val()
        };
        ruta = "inc_bermantar/peticion_salent.php?op=1";
        if ($("#salida input:eq(5)").val() != "" && ($("#salida input:eq(10)").val() != "" || $("#salida input:eq(11)").val() != ""))
        {
            peticion_ajax(ruta, parametros);
        } else
        {
            alert("Revisa el formulario");
        }
    });

    $("#entrada button:eq(1)").click(function ()
    {
        parametros = {
            "empresa": $("#entrada input:eq(0)").val(),
            "persona": $("#entrada input:eq(1)").val(),
            "fecha": $("#entrada input:eq(2)").val(),
            "tipo_entrada": $("#entrada select").val(),
            "albaran": $("#entrada input:eq(5)").val(),
            "comentario": $("#entrada textarea").val()
        };
        ruta = "inc_bermantar/peticion_salent.php?op=4";
        if ($("#entrada input:eq(2)").val() != "" && $('#albaran input').val() != "")
        {
            peticion_ajax(ruta, parametros);
        } else
        {
            alert("Revisa el formulario");
        }
    });

    $("#albaran input").change(function () {

        var formData = new FormData($("#albaran")[0]);

        ruta = "inc_bermantar/peticion_salent.php?op=2";

        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos)

            {
                if (datos != false)
                {
                    $("#entrada input:eq(5)").val(datos);
                }
                else
                {
                    $("#albaran input").val("");
                    alert('No es un archivo pdf');
                }
            }

        });

    });

    $("#subir_pdf input").change(function () {

        var formData = new FormData($("#subir_pdf")[0]);

        ruta = "inc_bermantar/peticion_salent.php?op=2";
        //formData.append("dato", "valor");
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos)

            {
                if (datos != false)
                {
                    $("#salida input:eq(11)").val(datos);
                }
                else
                {
                    $("#subir_pdf input").val("");
                    alert('No es un archivo pdf');
                }
            }

        });

    });
    $("#subir_csv input").change(function () {

        var formData = new FormData($("#subir_csv")[0]);

        ruta = "inc_bermantar/peticion_salent.php?op=3";

        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos)

            {
                if (datos != false)
                {
                    $("#salida input:eq(10)").val(datos);
                }
                else
                {
                    $("#subir_csv input").val("");
                    alert('No es un archivo csv');
                }
            }

        });

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

                //alert(respuesta);
                if (respuesta)
                {
                    /*control = jQuery('#subir_pdf input');
                     control.replaceWith( control = control.val('').clone( true ) );
                     controlB = jQuery('#subir_csv input');
                     controlB.replaceWith( controlB = controlB.val('').clone( true ) );*/
                    $("#entrada input").val("");
                    $("#salida input").val("");
                    $("#salida textarea,#entrada textarea").val("");
                    alert('Datos introducidos correctamente');
                }


            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    }
    $(function () {
        //$("#salida input:eq(5)").datepicker();
        $("#datepicker").datepicker();
    });
});

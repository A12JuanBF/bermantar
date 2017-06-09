$(document).ready(function () {
    $.ajaxSetup({cache: false});

    /*   $('.image-popup-vertical-fit').magnificPopup({
     type: 'image',
     closeOnContentClick: true,
     mainClass: 'mfp-img-mobile',
     image: {
     verticalFit: true
     }
     
     });*/




    $("#buscador form").submit(function (evento)
    {
        if ($("#cod").val() != "")
        {
            $("#titulo").val("");
            $("#editorial").val("");
            $("#autor").val("");
        }
        $.ajaxSetup({cache: false});

        var abierto = false;
        var d;
        var col;


        $("#buscador div").show();
        evento.preventDefault();



       /* $.post("inc_bermantar/peticiones.php?op=9", {titulo: $("#titulo").val(), editorial: $("#editorial").val(), autor: $("#autor").val(), cod: $("#cod").val(), seleccion: $("#seleccion").val()}, function (resultado)
        {*/
            dest = "inc_bermantar/busqueda.php";
            param = {
                "titulo": $("#titulo").val(),
                "editorial": $("#editorial").val(),
                "autor": $("#autor").val(),
                "cod": $("#cod").val(),
                "seleccion": $("#seleccion").val(),
                "tipo":$("#tipo").val()
            };
            $.ajax({
                url: dest,
                data: param,
                type: 'POST',
                beforeSend: function () {

                   $("#preload").fadeIn(); 

                },
                success: function (resultado) {
                    $("#preload").fadeOut();
                    if (resultado != "")
                    {
                        //$("#buscador div").hide();
                        $("#resultado_busqueda").html(resultado);
                        $("#resultados tr:last").remove();
                        numero = $("#resultados").next().text();
                        numero = numero + 1;
                        col = 11;
                        //alert(numero,col);
                        if (abierto == false)
                        {
                            for (i = 0; i < numero; i++)
                            {
                                for (j = 11; j < 19; j++)
                                {
                                    $("#resultados tr:eq(" + i + ") td:eq(" + j + "),#resultados tr:eq(" + i + ") th:eq(" + j + ")").css("display", "none");
                                }
                            }
                        }
                        $('#extender').click(function () {

                            //alert("k ase");
                            numero = $("#resultados").next().text();
                            numero = numero + 1;

                            for (i = 0; i < numero; i++)
                            {
                                for (j = col; j < 19; j++)
                                {
                                    $("#resultados tr:eq(" + i + ") td:eq(" + j + "),#resultados tr:eq(" + i + ") th:eq(" + j + ")").show();

                                }
                            }
                            abierto = true;

                        });
                        $('#ocultar').click(function () {

                            //alert("k ase");
                            numero = $("#resultados").next().text();
                            numero = numero + 1;

                            for (i = 0; i < numero; i++)
                            {
                                for (j = col; j < 19; j++)
                                {
                                    $("#resultados tr:eq(" + i + ") td:eq(" + j + "),#resultados tr:eq(" + i + ") th:eq(" + j + ")").hide();

                                }
                            }
                            abierto = false;

                        });

                    }
                    else
                    {
                        //$("#buscador div").hide();
                        $("#resultado_busqueda").html("<p class='texto_centrar'>No encontrado</p>");
                    }


                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });




        
    });
    $("#borrar_buscar").click(function () {
        //$("#buscador div").hide();
        $("#resultado_busqueda").html("");
    });
    
    





});

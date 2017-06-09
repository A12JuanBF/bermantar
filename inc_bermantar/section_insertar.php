<article class="col-g-12 col-lg-offset-1">
    <h4><i class="glyphicon glyphicon-search"></i> Introduce ISBN del libro:</h4><input id="isbn1">
    <button id="enviar" class="btn btn-danger">Peticion a Google</button><span id="mensaje_google"></span><br/>
    <button id="enviar2" disabled class="btn btn-success"><span class="glyphicon glyphicon-collapse-down"></span>Enviar al formulario</button>
</article>

<section id="section2" class="col-lg-12">
    <div class="container panel panel-default"  id="caja_input">
        <h4>Datos de la publicación para intruducir en la base de datos</h4>
        <form role="form" enctype="multipart/form-data" class="panel-body">
            <div class="row form-group ">
                <div class="col-lg-4 col-sm-4 col-xs-4 col-md-4">
                    <label>Título</label><input class="form-control input-sm" name="titulo" id="titulo">
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                    <label>Autor</label><input class="form-control input-sm" id="autor">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>Editorial</label><input class="form-control input-sm" name="editorial" id="editorial">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>Fecha de publicación</label><input class="form-control input-sm" id="fecha_publi">
                </div>
            </div>
            <div class="row form-group ">

                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>Dimensiones</label><input class="form-control input-sm" id="dimensiones">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>Num. páginas</label><input class="form-control input-sm" id="num_pag">
                </div>
                <div class="col-lg-1 col-sm-2 col-xs-2 col-md-2">
                    <label>Idioma</label><input class="form-control input-sm" id="idioma">
                </div>
                <div class="col-lg-1 col-sm-2 col-xs-2 col-md-2">
                    <label>País</label><input class="form-control input-sm" id="pais">
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                    <label>Tipo publicación</label><input class="form-control input-sm" id="tipo">
                </div>



                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">

                    <label>Comentario</label><textarea class="form-control" rows="2" id="coment"></textarea>
                </div>
            </div>
            <hr>
            <div  class="row form-group ">
                <h6 class="text-center">ISBN , CÓDIGOS</h6>

                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>ISBN 10</label><input class="form-control input-sm" name="isbn_10" id="isbn_10">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>ISBN 13</label><input class="form-control input-sm" id="isbn_13">
                </div>

                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>EXTRA 1</label><input class="form-control input-sm" id="extra1">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>EXTRA 2</label><input class="form-control input-sm" id="extra2">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>EXTRA 3</label><input class="form-control input-sm" id="extra3">
                </div>
                <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                    <label>EXTRA 4</label><input class="form-control input-sm" id="extra4">
                </div>
            </div>
            <hr>


            <div class="row form-group ">
                <h6 class="text-center">CANTIDAD, UBICACIÓN</h6>
                <div class="col-lg-1 col-sm-2 col-xs-2 col-md-2">
                    <label>Unidades</label><input class="form-control input-sm" type="number"  name="unid" id="unid">
                </div>
                <div class="col-lg-1 col-sm-2 col-xs-2 col-md-2">
                    <label>Ubicación</label><input class="form-control input-sm" name="ubicacion" id="ubicacion">
                </div>
                <div class="col-lg-1 col-sm-2 col-xs-2 col-md-2">
                    <label>Pale</label><input class="form-control input-sm" type="text" id="pale"/>
                </div>
                <div class="col-lg-2 col-sm-3 col-xs-3 col-md-3">
                    <label>Sección del almacén</label>
                    <select class="form-control" id="grupo" name="seleccion">

                        <option value="IZ">Lado Izquierdo</option>    
                        <option value="x">Rúa X</option>
                        <option value="t">EgarTorre</option>
                        <option value="v">Venales</option>

                    </select>
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <div class="col-lg-5 col-sm-5 col-xs-5 col-md-5">

                    <label class="control-label" >Selecciona Imagen</label> 

                    <input  id="file_img" type="file" name="file" class="jfilestyle" data-buttonText="<span style='margin-right:8px;' class='glyphicon glyphicon-folder-open'></span><span>Subir Imagen</span>">

                    <input style="visibility: hidden;"  id="img_libro">
                </div>
                <div class="col-lg-7 col-sm-7 col-xs-7 col-md-7">
                    <div id="mensajes"><span></span></div>
                </div>
            </div>

            <div class="row form-group col-lg-8">
                <div class="centrar_botones">
                    <input class=" col-lg-5 btn btn-default" type="reset" id="borrar_form" value="Borrar">
                    <input class=" col-lg-5 btn btn-primary" type="submit" id="guardar" value="Guardar">
                </div>
            </div>




        </form>


    </div>
    <div id="mensaje_grabar">
        <p></p>
    </div>
    
</section>
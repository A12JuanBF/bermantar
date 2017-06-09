<div class="container" id="buscador">
    <form class="fondo_trans" role="form">
        <h3 class="text-center">Buscador para modificar Publicaciones</h3>
        <div class="row form-group ">
            <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                <label>Título</label><input class="form-control input-sm" name="titulo" id="titulo"> 
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-6 col-md-6">

                <label>Autor</label><input class="form-control input-sm" name="autor" id="autor">
            </div>
            <div class="col-lg-3 col-sm-5 col-xs-5 col-md-5"> 
                <label>Editorial</label><input class="form-control input-sm" name="editorial" id="editorial">
            </div>
        </div>

        <div class="row form-group ">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-6">
                <label>Sección del almacén</label>
                <select class="form-control input-sm" name="seleccion" id="grupo">
                    <option value="'%%'">Todo el almacén</option>
                    <option value="'x'">Rúa X</option>
                    <option value="'t'">EgarTorres</option>
                    <option value="'IZ'">Lado izquierdo</option>
                    <option value="'v'">Venales</option>
                </select>
            </div>
        </div>
        <div class="row form-group ">
            <div class="col-lg-6 col-sm-10 col-xs-10 col-md-10">
                <label>ISBN 10/ISBN 13/D.L./ISSN/NIPO <small>*Introduce cualquier código de los sugeridos en la casilla</small>
                </label>
                <input class="form-control " name="cod" id="cod"> 
            </div>
        </div>
        <div class="row form-group ">
            <div class="col-lg-4 col-sm-12 col-xs-12 col-md-12">
                <input class="btn btn-default" type="reset" id="borrar_buscar" value="Borrar">
                <input class="btn btn-primary" type="submit" id="buscar_tabla" value="Buscar">
            </div>
            <div id="preload" class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
                <p>Buscando...<img style="margin-left: 15px;"  src="img1/cargando.gif"/></p>
            </div>
        </div>
    </form>
</div>    
<div class="col-lg-12 table-responsive" id="resultado_busqueda">
    <table class="col-lg-12 table table-bordered table-striped  table-hover table-condensed">

    </table>
</div>
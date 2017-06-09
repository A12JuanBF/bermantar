<?php
$tipos=new crearListado();
$listatipos=$tipos->getTipoPubli();
?>
<div id="buscador" class="panel panel-default container">
    <form role="form" class="panel-body">

        <div class="row form-group ">
            <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                <label >Título</label><input class="form-control input-sm" name="titulo" id="titulo"> 
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-6 col-md-6">
                <label >Autor</label><input class="form-control input-sm" name="autor" id="autor">
            </div>
            <div class="col-lg-3 col-sm-5 col-xs-5 col-md-5"> 
                <label>Editorial</label><input class="form-control input-sm" name="editorial" id="editorial"></div>
        </div>
        <div class="row form-group ">
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-6">
                <label>Sección del almacén</label>
                <select class="form-control input-sm" id="seleccion" name="seleccion">
                    <option value="%%">Todo el almacén</option>
                    <option value="x">Rúa X</option>
                    <option value="t">EgarTorre</option>
                    <option value="IZ">Lado izquierdo</option>
                    <option value="v">Venales</option>
                </select>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6 col-md-6">
                <label>Tipo de publicación</label>
                <select class="form-control input-sm" id="tipo" name="tipo">
                    <option value="%%">Cualquiera</option>
                    <?php foreach ($listatipos as $valor): ?>
                    <option value="<?php echo $valor['tipo']; ?>"><?php echo $valor['tipo']; ?></option>
                    <?php endforeach;?>
                    
                </select>
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col-lg-6 col-sm-10 col-xs-10 col-md-10">
                <label>ISBN 10/ISBN 13/D.L./ISSN/NIPO <small>*Introduce cualquier código de los sugeridos en la casilla</small>
                </label>
                <input class="form-control " name="cod" id="cod" placeholder="Introduce código"> 
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-4 col-sm-12 col-xs-12 col-md-12">
                <input  class="btn btn-default" type="reset" id="borrar_buscar" value="Borrar">
                <input class="btn btn-primary" type="submit" id="buscar_tabla" value="Buscar" >
            </div>
            <div id="preload" class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
                <p>Buscando...<img style="margin-left: 15px;"  src="img1/cargando.gif"/></p>
            </div>
        </div>

    </form>
    <!--<div>
    <p>Cargando información...</p>
    <img src="img1/reloj.png" alt="preloader" />
    <p>Espere por favor</p>
    </div>-->
</div>

<div id="resultado_busqueda" class="col-lg-12">

</div>
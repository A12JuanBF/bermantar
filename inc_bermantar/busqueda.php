<?php
@session_start();
//include 'conexion.php';

include '../inc_bermantarOO/buscarsalEnt.php';
include '../inc_bermantarOO/vistas/vista_bermantar.php';
$paginador = new vista_bermantar;

$inicio = 0;
$fin = 20;

$busqueda = new buscarsalEnt($_POST);
$libros = $busqueda->buscarPubli();
?>
<table class="table table-bordered table-condensed table-striped" id="resultados"  > <thead>
    <thead class="bg-info"><th>Imagen</th><th>Título</th><th>Unid.</th><th>Ubicación (caja rua X)</th><th>ISBN 10</th><th>ISBN 13</th><th>Fecha</th><th>Autor</th><th>Editorial</th>
    <th>Tipo</th><th>Num. pag.</th><th>Idioma</th><th>País</th><th>Dimensiones</th><th>Comentario</th><th>Extra1</th><th>Extra2</th><th>Extra3</th><th>Extra4</th>
    <th>Pale</th><th>Grupo</th></tr> </thead>
<tbody>
    <?php if ($libros != false): ?>
        <?php foreach ($libros as $valor): ?>
            <?php if ($valor['nombre_caratula'] != ""): ?>
                <?php $portada = "<a  href='caratulas/" . $valor['nombre_caratula'] . "' target='blank'>
                <img src='caratulas/" . $valor['nombre_caratula'] . "' class='img-responsive'></a>"; ?>
            <?php else : ?>
                <?php $portada = "<span class='glyphicon glyphicon-picture'></span>"; ?>
            <?php endif; ?>
            <tr><td class='caratula' ><?php echo $portada; ?></td><td><?php echo $valor["titulo"] ?></td><td><?php echo $valor["unid"] ?></td><td><?php echo $valor["Ubic_c"] ?></td><td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["isbn_10"] ?>' target=_blank><?php echo $valor["isbn_10"] ?></a></td>
                <td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["isbn_13"] ?>' target=_blank><?php echo $valor["isbn_13"] ?></a></td><td><?php echo $valor["fecha"] ?></td><td><?php echo $valor["autor"] ?></td><td><?php echo $valor["editorial"] ?></td>
                <td><?php echo $valor["tipo"] ?></td><td><?php echo $valor["pag"] ?></td><td><?php echo $valor["idioma"] ?></td><td><?php echo $valor["pais"] ?></td>
                <td><?php echo $valor["dimen"] ?></td><td><?php echo $valor["comentario"] ?></td><td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["extra1"] ?>' target=_blank><?php echo $valor["extra1"] ?></a></td><td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["extra2"] ?>' target=_blank><?php echo $valor["extra2"] ?></a></td>
                <td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["extra3"]; ?>' target=_blank><?php echo $valor["extra3"]; ?></a></td><td><a href='inc_bermantar/codigobarras.php?cod=<?php echo $valor["extra4"] ?>' target=_blank><?php echo $valor["extra4"] ?></a></td><td><?php echo $valor["pale"] ?></td><td><?php echo $valor["grupo"] ?></td></tr>

        <?php endforeach; ?>
    <?php else : ?>
    <h3>No encontrado</h3>
<?php endif; ?>
<?php $num_filas = $libros['filas'] ?>
</tbody>
</table>

<span id="num_filas"><?php echo $num_filas ?></span>
<button class="btn btn-default" id="extender">Extender</button> <button class="btn btn-default"  id="ocultar">Ocultar</button>
<p>Haz click en extender/ocultar para mostrar o ocultar los campos: Dimensiones,Comentario, Extra1, Extra2, Extra3 y Extra4</p>
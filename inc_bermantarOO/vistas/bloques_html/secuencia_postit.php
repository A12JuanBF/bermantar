<?php
$postit = new notas($_SESSION['id']);
$resultado_notas = $postit->mostrarNotas();
?>
<div id="container_notas"  class="base_postit" >
    <?php if ($resultado_notas): ?>
    <?php foreach ($resultado_notas as $valor): ?>
     <?php if ($valor['visto']==1): ?>
            <?php  $opacidad="opaco"; ?>
     <?php endif; ?>
        <div id="<?php echo $valor['id']; ?>" class="container_notas row <?php echo $opacidad; ?>">
            <div class=" col-lg-12  col-md-12 col-sm-12 col-xs-12 ">
                <div class=" col-lg-12  col-md-12 col-sm-12 col-xs-12 ">
                    <h2 class="pull-right glyphicon glyphicon-pushpin"></h2>
                    <p><?php echo $valor['nombre']." "; echo $valor['apellidos'];  ?></p>
                    <p><?php echo $valor['fecha']; ?></p>

                </div>
                <h3 class="text-center"><?php echo $valor['asunto']; ?></h3>

                <p class="text-left"><?php echo nl2br($valor['texto']); ?></p>
            </div>

            <div  class="check col-lg-10  col-md-10 col-sm-10 col-xs-10 ">
                <?php if ($valor['visto']==0): ?>
                
                <a name="ok" class="no_visto pull-right" href="#"><span class="glyphicon glyphicon-ok"></span></a>
                <?php else : ?>
                <a name="no_ok" class="visto pull-right" href="#"><span class="glyphicon glyphicon-ok"></span></a>
                <?php endif; ?>
                <a class="papelera pull-left" href="#"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else : ?>
    <h2 class="row text-center ">No hay notas.</h2>
    <?php endif; ?>
    <?php
    $hora = time();


    
    ?>
    
</div>


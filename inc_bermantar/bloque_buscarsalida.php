<?php
include '../inc_bermantarOO/buscarsalEnt.php';

$buscar_salida = new buscarsalEnt($_POST);
$resultado_arr = $buscar_salida->buscarSal();
?>
<?php if ($resultado_arr): ?>
    <table class="table table-bordered">

        <thead class="bg-info"><th>Empresa, Institución...</th><th>Persona</th><th>Dirección</th><th>Localidad</th><th>Provincia</th><th>C.P.</th><th>Fecha</th><th>Modo de Salida</th><th>Tipo de envío</th><th>Cod. Correos</th><th>Comentario</th><th>Archivos CSV/PDF</th><th>Modificar registros</th></thead>  

        <?php foreach ($resultado_arr as $valor): ?>
            <?php if($valor['tipo_envio']=='Distribución a Bibliotecas')
            {
              $clase='active'  ;
            }
            if($valor['tipo_envio']=='Extraordinario')
            {
              $clase='success'  ;  
            }
            if($valor['tipo_envio']=='Librería institucional')
            {
              $clase='warning'  ;  
            }
            ?>
        <tr class="<?php echo $clase ?>" id="<?php echo $valor['id'] ?>"><td><?php echo $valor['destinatario_org'] ?></td><td><?php echo $valor['destinatario_pers'] ?></td><td><?php echo $valor['direccion'] ?></td><td><?php echo $valor['localidad'] ?></td><td><?php echo $valor['provincia'] ?></td><td><?php echo $valor['cp'] ?></td><td><?php echo $valor['fecha'] ?></td><td><?php echo $valor['modo_salida'] ?></td><td><?php echo $valor['tipo_envio'] ?></td><td><?php echo $valor['cod_correos'] ?></td><td><?php echo $valor['comentario']; ?></td><td><?php if ($valor['pdf'] != ""): ?><a name="pdf" href="pdf/<?php echo $valor['pdf']; ?>" target="_blank"><i class="glyphicon glyphicon-file"></i>PDF</a><?php endif; ?><?php if ($valor['csv'] != ""): ?><a name="csv" href="csv/<?php echo $valor['csv']; ?>"><i class="glyphicon glyphicon-list-alt"></i>CSV</a><?php endif; ?></td><td><span><a href="#"><i class="glyphicon glyphicon-edit"></i>Modificar registro</a></span></td></tr>

        <?php endforeach; ?>

    </table>
<?php else : ?>
    <p>No encontrado</p>
<?php endif; ?>

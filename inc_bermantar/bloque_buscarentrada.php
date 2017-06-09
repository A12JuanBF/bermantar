<?php
include '../inc_bermantarOO/buscarsalEnt.php';

$buscar_salida = new buscarsalEnt($_POST);
$resultado_arr = $buscar_salida->buscarEnt();
?>

<?php if ($resultado_arr): ?>
    <table class="table table-bordered">

        <thead class="bg-info"><th>Empresa, Institución...</th><th>Persona</th><th>Fecha</th><th>Tipo de entrada</th><th>Comentario</th><th>Albarán</th></thead>  

        <?php foreach ($resultado_arr as $valor): ?>
            <?php
            if ($valor['tipo_entrada'] == 'Distribución a Bibliotecas') {
                $clase = 'active';
            }
            if ($valor['tipo_entrada'] == 'Extraordinario') {
                $clase = 'success';
            }
            if ($valor['tipo_entrada'] == 'Librería institucional') {
                $clase = 'warning';
            }
            ?>
        <tr class="<?php echo $clase ?>" id="<?php echo $valor['id'] ?>"><td><?php echo $valor['empresa'] ?></td><td><?php echo $valor['persona'] ?></td><td><?php echo $valor['fecha'] ?></td><td><?php echo $valor['tipo_entrada'] ?></td><td> <?php echo $valor['comentario']; ?></td><td><?php if ($valor['albaran'] != ""): ?><a href="pdf/<?php echo $valor['albaran']; ?>" target="_blank"><i class="glyphicon glyphicon-file"></i>PDF</a><?php endif; ?></td></tr>

        <?php endforeach; ?>

    </table>
    <?php else : ?>
    <p>No encontrado</p>
<?php endif; ?>

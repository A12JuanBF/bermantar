<?php
include '../barcode/sample-gd.php';

$cod=@$_GET['cod'];
codigoBarras($cod);
header('Content-type: image/gif');
echo $img;
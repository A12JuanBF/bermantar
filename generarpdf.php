<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("inc_bermantar/dompdf/dompdf_config.inc.php");
$html = file_get_contents('http://almacendotambre.hol.es/inc_bermantar/peticiones.php?op=10&tabla='.$_GET['tabla'].'&fichero='.$_GET['fichero']);
// Obtenemos el código html de la página web que nos interesa
$dompdf = new DOMPDF();
// Creamos una instancia a la clase
$dompdf->load_html($html);
$dompdf->render();
header('Content-type: application/pdf');

echo $dompdf->output();
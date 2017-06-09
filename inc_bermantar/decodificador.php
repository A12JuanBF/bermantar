<?php
function decodificar($campo){
    $campo="'%".$campo."%'";
    //$campo=utf8_decode($campo);
    return $campo;
}
?>
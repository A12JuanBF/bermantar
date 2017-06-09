<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once  'conOOP.php';
/**
 * Description of uploadEntSal
 *
 * @author Diego
 */
class uploadEntSal extends conOOP {
    //put your code here
     public function cargarPdf($param) {
                    $file = $param["pdf"];
                    $fecha = new DateTime();
                    $tipo = $file["type"];
                    
                     if ($tipo == 'application/pdf')
                    {
                    $nombre = $fecha->getTimestamp().$file["name"];                    
                    $ruta_provisional = $file["tmp_name"];
                    $carpeta = "../pdf/";
                    $src = $carpeta.$nombre;
        
                    move_uploaded_file($ruta_provisional, $src);
                    return $nombre ;
                    }
                     else
                    {
                     return false;   
                    }
     }
    public function cargarCsv($param) {
                    $file = $param["csv"];
                    $fecha = new DateTime();
                    $tipo = $file["type"];
                    
                    if ($tipo == 'application/octet-stream')
                    {
                    $nombre = $fecha->getTimestamp().$file["name"];                    
                    $ruta_provisional = $file["tmp_name"];
                    $carpeta = "../csv/";
                    $src = $carpeta.$nombre;
        
                    move_uploaded_file($ruta_provisional, $src);
                    return $nombre ;
                    }
                     else
                    {
                     return false;   
                    }
     }
}

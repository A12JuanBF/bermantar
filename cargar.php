<?php

include 'inc_bermantar/conexion.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_FILES["file"]))
    {
    
    $file = $_FILES["file"];
    
    $nombre = $file["name"];
    
    $tipo = $file["type"];
    
    $ruta_provisional = $file["tmp_name"];
    
    $size = $file["size"];
    
    $dimensiones = getimagesize($ruta_provisional);
    
    $width = $dimensiones[0];
    
    $height = $dimensiones[1];
    
    $carpeta = "caratulas/";
    

    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
         {
        
        echo "Error, el archivo no es una imagen";
       
    }
    
    
    else
    {
        
        $src = $carpeta . $nombre;
        
        move_uploaded_file($ruta_provisional, $src);
        echo "<p>$nombre</p>";
        echo "<img src='$src'>";
        
    }
    
}




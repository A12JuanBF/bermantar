<?php
include 'conexion.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset ($_GET['usuario']))
{
    // Consulta de búsqueda de la imagen.
    $usuario=$_GET['usuario'];
    $usuario="'".$usuario."'";
    $sql = "select * from imagenes_web where usuario=".$usuario;
    $resultado = $mysqli->query($sql);
     if( $mysqli->affected_rows>0)
    { 
        
        while ($row = mysqli_fetch_assoc($resultado)){
       
        $imagen = $row['imagen']; // Datos binarios de la imagen.
        $tipo = $row['tipo'];  // Mime Type de la imagen.
        // Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
        header("Content-type: $tipo");
        // A continuación enviamos el contenido binario de la imagen.
        echo $imagen;
        }
    }
    else
        echo 'error';
}
?>
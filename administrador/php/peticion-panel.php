<?php
include "clases/gestionusuario.php";
include "clases/claves.php";
include "clases/subirImg.php";
/* 
 * archivo que gestiona las peticiones desde el cliente y la creación de objetos desde el servidor
 */

if (!empty($_GET['op'])) {
    $usuarios= new gestUsu;
    $claves= new claves;
    $img=new subirImg;
    switch ($_GET['op']){
        case 1:
           
            
            if($usuarios->eliminarUsu($_POST['id']))
            {
                echo 'borrado';
            }
            else
            {
                echo 'error';
            }
            
        break;
	case 2:		
		
		if($claves->cambiarClave($_POST['tipo'],$_POST['pswd']))
            	{
                echo 'clave_ok';
            	}
            	else
            	{
                echo 'error';
            	}

	break;
        case 3:
            
            echo $img->getId($_POST['titulo']);
                      
        break;
    
        case 4:           
             
            echo $img->cargarImg($_FILES);
                
            break;
        case 5:          
            
            $usuarios_arr= $usuarios->mostrarUsu();
            /*Lanzamos cabeceros th de la tabla antes del bucle */
            echo "<tr><th>Nombre de Usuario</th><th>Tipo de Usuario</th><th>Eliminar</th></tr>";
            foreach($usuarios_arr as $valor)
            {
             echo "<tr id=".$valor['id']."><td>".$valor['nombre']." ". $valor['apellidos']."</td><td>".$valor['tipo']."</td><td><span class='glyphicon glyphicon-trash'><span></td></tr>";   
            }
            
        break;
        case 6:
            
            if($img->setImg($_POST['id'],$_POST['caratula']))
            {
            echo 'img_ok';
            }
            else
            {
            echo 'error';   
            }
        break;
        
        }
    }
    

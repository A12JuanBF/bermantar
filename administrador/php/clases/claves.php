<?php
require_once  'conexionOOP.php';


/**
 * Description of claves
 *Clase que gestiona las claves de creación de usuarios 
 * @author JDBF
 */
class claves extends conexionOOP{
    
    private $tipo_campo="pwd";
    private $tipo;
    private $pwd;

    public function cambiarClave($tip,$password){

      if($tip=="Administrador")
      {
       $this->tipo="a";
      }
      if($tip=="Usuario")
      {
       $this->tipo="u";
      }
	/* pasar funcion crypt a $password */
      $password=crypt($password,'xunta');
      $sql="UPDATE password SET password='".$password."' where tipo='".$this->tipo_campo."' and valor='".$this->tipo."'";
      if($result=$this->con->query($sql))
	{
      	return $result;
        }
	else
        {
	return false;
        }
    }
     
}

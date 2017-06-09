<?php
require_once  'conexionOOP.php';
/**
 * Description of gestionusuario
 *Clase que muestra usuarios de la aplicación y su método para borrar usuarios 
 * @author JDBF
 */
class gestUsu extends conexionOOP {
	private $id;
        
	public function eliminarUsu($iden){
                $this->id=$iden;		
                                                                 
                $sql="delete from usuarios_web where id =".$this->id;
		$results = $this->con->query($sql);
		
		return $results;
                
	}
	
	public function mostrarUsu(){
		
		$sql="select nombre, apellidos , id , tipo from usuarios_web";
		$result=$this->con->query($sql);
        	
        	while ($res = $result->fetch_assoc()) {
           	 $usuarios[] = $res;
       		 }
            	       
        	return $usuarios;                    	

		}


}



?>
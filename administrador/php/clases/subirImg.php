<?php



/**
 * Description of subirImg
 *
 * @author JDBF
 */
class subirImg extends conexionOOP{
    private $titulo;
    
    public function getId($tit){
        $this->titulo=$tit;
		$sql="select  id  from almacen where titulo like '". $this->titulo."' and grupo like 'IZ'";
		
		$result=$this->con->query($sql);
                while ($res = $result->fetch_assoc()) {
           	 $id= $res['id'];
       		 }
               
                    
                    return $id;
                
		}
                
                public function cargarImg($param) {
                    $file = $param["file"];
                    $fecha = new DateTime();
                    $tipo = $file["type"];
                    if ($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/gif')
                    {
                   
                    $nombre = $fecha->getTimestamp().$file["name"];                    
                    $ruta_provisional = $file["tmp_name"];
                    $carpeta = "../../caratulas/";
                    $src = $carpeta.$nombre;
        
                    move_uploaded_file($ruta_provisional, $src);
                    return $nombre ;
                    }
                    else
                    {
                     return false;   
                    }
                    
                }
                 public function setImg($id,$imgName){
                 
                  $sql="UPDATE almacen SET nombre_caratula='".$imgName."' where id=".$id;
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
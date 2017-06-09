<?php
require_once'conOOP.php';


/**
 * Description of actualizarBD
 *
 * @author Diego
 */
class actualizarBD extends conOOP {
    private $id;
    private $tabla;
    function __construct($tabla) {
        parent::__construct();
        $this->tabla = $tabla;
    }
    public function borrarRegistro($id) {
        $this->id=$id;
        $sql="DELETE FROM ".$this->tabla." WHERE id=".$this->id;
        if($result=$this->con->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public function setSalida($param) {
        $this->id=$param['id'];
        $sql = "UPDATE ".$this->tabla." SET destinatario_org='" . $param['destinatario_org'] . "' , destinatario_pers='" . $param['destinatario_pers'] . "' , direccion='" . $param['direccion'] . "', localidad='" . $param['localidad'] . "', provincia='" . $param['provincia'] . "' , cp=" . $param['cp'] . ", fecha='" . $param['fecha'] . "',modo_salida='" . $param['modo_salida']. "' , tipo_envio='" . $param['tipo_envio']. "', cod_correos='" . $param['cod_correos']. "' , comentario='" . $param['comentario']. "' , pdf='" . $param['pdf']. "' , csv='" . $param['csv']. "' where id=" . $this->id;
        if($result=$this->con->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function cargarPdf($id,$param) {
        $this->id=$id;
        $file = $param["pdf"];
        $fecha = new DateTime();
        $tipo = $file["type"];
        if ($tipo == 'application/pdf') {
            $sql = "select  pdf  from ".$this->tabla." where id =" . $this->id ;
            $result = $this->con->query($sql);
            while ($res = $result->fetch_assoc()) {
                $pdf = $res['pdf'];
            }
            if($pdf=="")
            {
             $pdf =$fecha->getTimestamp().$file["name"];
            }
            $ruta_provisional = $file["tmp_name"];
            $carpeta = "../pdf/";
            $src = $carpeta . $pdf;
            move_uploaded_file($ruta_provisional, $src);           
        return $pdf;
        } else {
            return false;
        }
    }
    public function cargarCsv($id,$param) {
        $this->id=$id;
        $file = $param["csv"];
        $fecha = new DateTime();
        $tipo = $file["type"];
        if ($tipo == 'application/octet-stream') {
            $sql = "select  csv  from ".$this->tabla." where id =" . $this->id ;
            $result = $this->con->query($sql);
            while ($res = $result->fetch_assoc()) {
                $csv = $res['csv'];
            }
            if($csv=="")
            {
             $csv =$fecha->getTimestamp().$file["name"];
            }
            $ruta_provisional = $file["tmp_name"];
            $carpeta = "../csv/";
            $src = $carpeta . $csv;
            move_uploaded_file($ruta_provisional, $src);           
        return $csv;
        } else {
            return false;
        }
    }
    
    public function borrarSalidaEntrada($param) {
        if($param['csv']!="")
        {
        unlink('../csv/' . $param['csv']);
        }
        if($param['pdf']!="")
        {
        unlink('../pdf/' . $param['pdf']);
        }
        $this->id=$param['id'];
        $sql="DELETE FROM ".$this->tabla." WHERE id=".$this->id;
        if($result=$this->con->query($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

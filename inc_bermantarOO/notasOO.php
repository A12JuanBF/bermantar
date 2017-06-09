<?php

require_once 'conOOP.php';

/**
 * Description of notas
 *
 * @author Diego
 */
class notas extends conOOP {

    private $id;

    function __construct($id) {
        parent::__construct();
        $this->id = $id;
    }

    public function insertarNota($param) {
        
        $sql = "INSERT INTO notas (id_usu, asunto , texto , fecha, visto) VALUES(" . $this->id . ",'" . $param['asunto'] . "' ,'" . $param['texto'] . "' , adddate(now(),interval 2 hour), 0)";
        $results = $this->con->query($sql);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    public function mostrarNotas() {
        $sql = "select  notas.id_usu , notas.asunto , notas.texto , notas.visto , notas.fecha , usuarios_web.id  , usuarios_web.nombre , usuarios_web.apellidos , notas.id from notas INNER JOIN usuarios_web   ON notas.id_usu = usuarios_web.id order by notas.visto asc ";
        $result = $this->con->query($sql);
        if ($this->con->affected_rows > 0) {


            while ($res = $result->fetch_assoc()) {
                $search[] = $res;
            }

            return $search;
        } else {
            return false;
        }
    }

    public function borrarNota($param) {
       $sql =" delete from notas where id=".$param['id'] ;
        if ($this->con->query($sql)) {
                return true;
            }
            else{
                return false;
            }
    }

    public function vistoNota($param) {
        $sql = "UPDATE notas SET visto=".$param['check']." WHERE id=".$param['id']."";
         if ($this->con->query($sql)) {
                return true;
            }
            else{
                return false;
            }
    }
    public function notificaciones() {
        $sql="select visto , count(visto) as nota from notas where visto=0";
        $result = $this->con->query($sql);
       while ($res = $result->fetch_assoc()) {
                $notificacion= $res['nota'];
            }

            return $notificacion;
        
        
    }

}

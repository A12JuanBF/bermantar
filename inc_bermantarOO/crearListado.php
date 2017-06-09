<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crearListado
 * clase que comprueba si hay listados de usuario pendientes por hacer 
 * @author Diego
 */
class crearListado extends conOOP {

    public function comprobarListado($param) {
        $sql = "select * from $param";
        $this->con->query($sql);
        if ($this->con->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getTipoPubli() {
        $sql = "select DISTINCT tipo from almacen; ";
        $result = $this->con->query($sql);
        if ($this->con->affected_rows > 0) {

            while ($res = $result->fetch_assoc()) {
                $search[] = $res;
            }
            return $search;
        }
    }

}

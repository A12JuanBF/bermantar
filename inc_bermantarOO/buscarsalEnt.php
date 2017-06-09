<?php

require_once 'conOOP.php';
include '../inc_bermantar/decodificador.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buscarsalEnt
 *
 * @author Diego
 */
class buscarsalEnt extends conOOP {

    private $param;

    function __construct($param) {
        parent::__construct();
        $this->param = $param;
    }

    public function buscarSal() {
        $this->param['destinatario_org'] = decodificar($this->param['destinatario_org']);
        $this->param['destinatario_pers'] = decodificar($this->param['destinatario_pers']);
        $this->param['localidad'] = decodificar($this->param['localidad']);
        $this->param['fecha'] = decodificar($this->param['fecha']);
        $this->param['cod_correos'] = decodificar($this->param['cod_correos']);
        $sql = "select * from salida where modo_salida like '" . $this->param['modo_salida'] . "' and tipo_envio like '" . $this->param['tipo_envio'] . "' and destinatario_org like " . $this->param['destinatario_org'] . " and destinatario_pers like" . $this->param['destinatario_pers'] . "and localidad like" . $this->param['localidad'] . "and fecha like" . $this->param['fecha'] . "and cod_correos like" . $this->param['cod_correos'];
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

    public function buscarEnt() {
        //and empresa like ".$this->param['empresa']." persona like ".$this->param['persona']." and fecha like ".$this->param['fecha']
        $this->param['empresa'] = decodificar($this->param['empresa']);
        $this->param['persona'] = decodificar($this->param['persona']);
        $this->param['fecha'] = decodificar($this->param['fecha']);
        $sql = "select * from entrada where tipo_entrada like '" . $this->param['tipo_entrada'] . "' and empresa like " . $this->param['empresa'] . " and persona like " . $this->param['persona'] . "and fecha like" . $this->param['fecha'];
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

    public function buscarPubli() {
        if ($this->param['cod'] != "") {
            $sql = "select * from almacen where isbn_13='" . $this->param['cod'] . "' or isbn_10='" . $this->param['cod'] . "' or extra1='" . $this->param['cod'] . "' or extra2='" . $this->param['cod'] . "' or extra3='" . $this->param['cod'] . "' or extra4='" . $this->param['cod'] . "'";
        } if ($this->param['cod'] == "") {
            
            $sql = "select * from almacen where titulo like '%" . $this->param['titulo'] . "%' and editorial like '%" . $this->param['editorial'] . "%' and autor like '%" . $this->param['autor'] . "%' and grupo like '" . $this->param['seleccion']."' and tipo like '".$this->param['tipo']."'";
        }
        $result = $this->con->query($sql);
        if ($this->con->affected_rows > 0) {

            while ($res = $result->fetch_assoc()) {
                $search[] = $res;
            }
            $search['filas']=$this->con->affected_rows;
            return $search;
        } else {
            return false;
        }
    }

}

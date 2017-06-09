<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vista_bermantar
 *
 * @author Diego
 */
class vista_bermantar {

    public function footerBermantar() {

        require 'bloques_html/footer_bermantar.html';
    }

    public function tablonPostit() {

        require 'bloques_html/secuencia_postit.php';
    }

    public function continuarListado($tabla) {
        include 'inc_bermantarOO/crearListado.php';
        $listado = new crearListado();
        if ($listado->comprobarListado($tabla)) {
            require 'inc_bermantar/continuar_listado.html';
        }
    }

    public function paginador($param) {
        echo '<ul class="pagination">';
        for ($i=1; $i<= $param ;$i++)
        {
            echo '<li><a href="#">'.$i;'</a></li>';
        }
        echo '</ul>';
    }

}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$mysqli = new mysqli('localhost', 'root', '', 'bermantar');
if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
?>
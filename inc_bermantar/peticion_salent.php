<?php

@session_start();
include '../inc_bermantarOO/grabarSalEnt.php';
include '../inc_bermantarOO/uploadEntSal.php';
include '../inc_bermantarOO/subirImg.php';
include '../inc_bermantarOO/actualizarBD.php';
include '../inc_bermantarOO/buscarsalEnt.php';
include '../inc_bermantarOO/notasOO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($_GET['op'])) {
    $fichero = new uploadEntSal;

    switch ($_GET['op']) {
        case 1:
            if (isset($_POST)) {
                $salentOO = new grabarSalEnt($_POST);
                if ($salentOO->grabSal()) {
                    echo 'ok_grab';
                }
            }

            break;

        case 2:

            echo $fichero->cargarPdf($_FILES);

            break;

        case 3:

            echo $fichero->cargarCsv($_FILES);

            break;

        case 4:
            $salentOO = new grabarSalEnt($_POST);
            if ($salentOO->grabEnt()) {
                echo 'ok_grab';
            }

            break;

        case 5:
            $img = new subirImg;
            echo $img->cargarImg($_FILES);
            break;

        case 6:
            $borrar = new actualizarBD("almacen");

            echo $borrar->borrarRegistro($_POST['id']);

            break;
        case 7:
            $buscar_publicacion = new buscarsalEnt($_POST);
            $resultado_arr = $buscar_publicacion->buscarPubli();
            $arr = array('publicacion' => $resultado_arr);

            echo json_encode($arr);
            break;
        case 8:
            $img = new subirImg;

            echo $img->modImg($_POST['id'], $_FILES);
            break;
        case 9:
            $notas = new notas($_SESSION['id']);
            echo $notas->insertarNota($_POST);
            break;
        case 10:
            $notas = new notas($_SESSION['id']);
            echo $notas->vistoNota($_POST);
            break;
        case 11:
            $notas = new notas($_SESSION['id']);
            echo $notas->borrarNota($_POST);
            break;
        case 12:
            $modificar = new actualizarBD("salida");
            echo $modificar->setSalida($_POST);
            break;
        case 13:
            $modificar = new actualizarBD("salida");
            echo $modificar->cargarPdf($_POST['id'], $_FILES);
            break;
        case 14:
            $modificar = new actualizarBD("salida");
            echo $modificar->cargarCsv($_POST['id'], $_FILES);
            break;
        case 15:
            $modificar = new actualizarBD("salida");
            echo $modificar->borrarSalidaEntrada($_POST);
    }
}
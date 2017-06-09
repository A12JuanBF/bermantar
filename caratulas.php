<?php

include 'inc_bermantar/conexion.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!empty($_GET['op'])) {
    session_start();
    switch ($_GET['op']) {
        case 1:
            $sql = "select * from almacen where titulo like '" . $_POST['titulo'] . "' and grupo like 'IZ'";
            $result = $mysqli->query($sql);

            if ($mysqli->affected_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['id'];
                }
            } else {
                echo 'error';
            }
            break;

        case 2:
            $id=(int)$_POST['id'];
            $sql="UPDATE almacen SET nombre_caratula= '".$_POST['nombre_caratula']."' where id=".$id;
            if($mysqli->query($sql))
                {
                echo 'ok';
                }
            break;
    }
}
<?php

@session_start();
include 'conexion.php';
include 'decodificador.php';

if (!empty($_GET['op'])) {


    switch ($_GET['op']) {

        case 1:
            $password = crypt($_POST['password'], 'xunta');
            $sql = sprintf("select * from usuarios_web where nick='%s' and password='%s'", @$_POST['usuario'], $password);
            $result = $mysqli->query($sql);



            if ($mysqli->affected_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    if ($row['nick'] == $_POST['usuario'] && $row['password'] == $password) {
                        $_SESSION['tabla'] = $row['tabla'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['nick'] = $row['nick'];
                        $_SESSION['apellidos'] = $row['apellidos'];
                        $_SESSION['tipo_usuario'] = $row['tipo'];
                    } else {
                        $_SESSION['tabla'] = 'anonimo_temporal';
                    }
                }



                echo 'ok';
            } else {
                $_SESSION['tabla'] = 'anonimo_temporal';
                echo 'error';
            }

            break;

        case 2:
            if (!empty($_POST['titulo']) || !empty($_POST['editorial']) || !empty($_POST['cod']) || !empty($_POST['autor'])) {

                if ($_POST['titulo'] != "" && $_POST['editorial'] != "" && $_POST['autor'] != "" && $_POST['cod'] == "") {

                    $titulo = $_POST['titulo'];
                    $titulo = decodificar($titulo);
                    $editorial = $_POST['editorial'];
                    $editorial = decodificar($editorial);
                    $autor = $_POST['autor'];
                    $autor = decodificar($autor);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and titulo like" . $titulo .
                            "and editorial like" . $editorial . "and autor like" . $autor;
                }


                if ($_POST['titulo'] != "" && $_POST['editorial'] != "" && $_POST['autor'] == "" && $_POST['cod'] == "") {
                    $titulo = $_POST['titulo'];
                    $titulo = decodificar($titulo);
                    $editorial = $_POST['editorial'];
                    $editorial = decodificar($editorial);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and titulo like" . $titulo .
                            "and editorial like" . $editorial;
                }


                if ($_POST['titulo'] != "" && $_POST['autor'] != "" && $_POST['editorial'] == "" && $_POST['cod'] == "") {
                    $titulo = $_POST['titulo'];
                    $titulo = decodificar($titulo);
                    $autor = $_POST['autor'];
                    $autor = decodificar($autor);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and titulo like" . $titulo .
                            "and autor like" . $autor;
                }

                // consulta busqueda de codigo
                if ($_POST['cod'] != "" && $_POST['titulo'] == "" && $_POST['autor'] == "" && $_POST['editorial'] == "") {
                    $cod = $_POST['cod'];
                    $cod = "'" . $cod . "'";
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . " and (isbn_10 like" . $cod . "or isbn_13 like" . $cod . "or extra1 like" . $cod .
                            "or extra2 like" . $cod . "or extra3 like" . $cod . "or extra4 like" . $cod . ")";
                }

                if ($_POST['autor'] != "" && $_POST['editorial'] != "" && $_POST['titulo'] == "" && $_POST['cod'] == "") {
                    $autor = $_POST['autor'];
                    $autor = decodificar($autor);
                    $editorial = $_POST['editorial'];
                    $editorial = decodificar($editorial);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and editorial like" . $editorial .
                            "and autor like" . $autor;
                }

                if ($_POST['autor'] != "" && $_POST['editorial'] == "" && $_POST['titulo'] == "" && $_POST['cod'] == "") {
                    $autor = $_POST['autor'];
                    $autor = decodificar($autor);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and autor like" . $autor;
                }


                if ($_POST['editorial'] != "" && $_POST['titulo'] == "" && $_POST['autor'] == "" && $_POST['cod'] == "") {
                    $editorial = $_POST['editorial'];
                    $editorial = decodificar($editorial);
                    $sql = "select * from almacen where grupo like" . $_POST['grupo'] . "and editorial like" . $editorial;
                }

                /* titulo */

                if ($_POST['titulo'] != "" && $_POST['editorial'] == "" && $_POST['autor'] == "" && $_POST['cod'] == "") {
                    $titulo = $_POST['titulo'];
                    $titulo = decodificar($titulo);
                    $sql = "select * from almacen where titulo like" . $titulo . "and grupo like" . $_POST['grupo'];
                }

                $result = $mysqli->query($sql);

                if ($mysqli->affected_rows > 0) {

                    /* obtener array asociativo */


                    echo"<tr><th>Título</th><th>Unidades</th><th id='ubic_cc'>Ubicación (caja rua X)</th><th>ISBN 10</th><th>ISBN 13</th><th>Fecha</th><th>Autor</th><th>Editorial</th>
                        <th>Tipo</th><th>Num. pag.</th><th>Idioma</th><th>Pais</th><th>Dimensiones</th><th>Comentario</th><th>Extra1</th><th>Extra2</th><th>Extra3</th><th>Extra4</th>
                        <th>Pale</th><th>Grupo</th><th>Imgen de la portada</th><th>Modifica</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr id='" . $row['id'] . "'><td><input  disabled type='text' value='" . $row["titulo"] . "'/></td><td><input disabled type='number' value='" . $row["unid"] . "'/></td><td><input disabled type='text' value='" . $row["Ubic_c"] . "'/></td><td><input disabled type='text' value='" . $row["isbn_10"] . "'/></td>
                        <td><input disabled type='text' value='" . $row["isbn_13"] . "'/></td><td><input disabled type='datetime' value='" . $row["fecha"] . "'/></td><td><input disabled type='text' value='" . $row["autor"] . "'/></td><td><input disabled type='text' value='" . $row["editorial"] . "'/></td>
                         <td><input disabled type='text' value='" . $row["tipo"] . "'/></td><td><input disabled type='text' value='" . $row["pag"] . "'/></td><td><input disabled type='text' value='" . $row["idioma"] . "'/></td><td><input disabled type='text' value='" . $row["pais"] . "'/></td><td><input disabled type='text' value='" . $row["dimen"] . "'/></td><td><input disabled type='text' maxlength='1000' value='" . $row["comentario"] . "'/></td><td><input disabled type='text' value='" . $row["extra1"] . "'/></td>
                                    <td><input disabled type='text' value='" . $row["extra2"] . "'/></td><td><input disabled type='text' value='" . $row["extra3"] . "'/></td><td><input disabled type='text' value='" . $row["extra4"] . "'/></td><td><input disabled type='text' value='" . $row["pale"] . "'/></td><td><input disabled type='text' value='" . $row["grupo"] . "'/></td><td class='scrolls'><form  enctype='multipart/form-data'><input  name='file' disabled type='file' /></form><input style='display:none;' disabled type='text' value='" . $row["nombre_caratula"] . "'/></td><td><a href='#'   name='list_edit'><i class='glyphicon glyphicon-pencil'></i>Habilitar</a><br><h3><a href='#'class='text-danger' name='remove'><i class='glyphicon glyphicon-remove-circle'></i> </a> <a href='#' class='text-primary' name='ok.'><i class='glyphicon glyphicon-ok-sign'></i></a></h3></td></tr>";
                    }
                } else
                    echo '<p style="width:20%; margin:0 auto;">No encontrado</p>';
            }

            break;

        case 3:
            // insertar en tabla temporal para crear csv
            $sql = "INSERT INTO " . $_POST['tabla'] . " (titulo,unid,Ubic_c,isbn_10,isbn_13,fecha,autor,editorial,tipo,pag,idioma,pais,dimen,comentario,extra1,extra2,extra3,extra4) values('" . $_POST['titulo'] . "'," . $_POST['unid'] . ",'" . $_POST['ubic'] . "','" . $_POST['isbn_10'] . "','" . $_POST['isbn_13'] . "','" . $_POST['fecha'] . "','" . $_POST['autor'] . "','" . $_POST['editorial'] . "','" . $_POST['tipo'] . "','" . $_POST['num_pag'] . "','" . $_POST['lang'] . "','" . $_POST['pais'] . "','" . $_POST['dimen'] . "','" . $_POST['comen'] . "','" . $_POST['extra1'] . "','" . $_POST['extra2'] . "','" . $_POST['extra3'] . "','" . $_POST['extra4'] . "')";
            $mysqli->query($sql);


            $sql = "select * from " . $_POST['tabla'] . "";
            $result = $mysqli->query($sql);
            echo'<tr><th>Titulo</th><th>Unid.</th><th>Ubicacion (caja rua X)</th><th>ISBN 10</th><th>ISBN 13</th><th>Fecha</th><th>Autor</th><th>Editorial</th>
                        <th>Tipo</th><th>Num. pag.</th><th>Idioma</th><th>Pais</th><th>Dimensiones</th><th>Comentario</th><th>Extra1</th><th>Extra2</th><th>Extra3</th><th>Extra4</th>
                        </tr>';
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['unid'] . "</td><td>" . $row['Ubic_c'] . "</td><td>" . $row['isbn_10'] . "</td><td>" . $row['isbn_13'] . "</td><td>" . $row['fecha'] . "</td><td>" . $row['autor'] . "</td>
                        <td>" . $row['editorial'] . "</td><td>" . $row['tipo'] . "</td><td>" . $row['pag'] . "</td><td>" . $row['idioma'] . "</td><td>" . $row['pais'] . "</td><td>" . $row['dimen'] . "</td><td>" . $row['comentario'] . "</td>
                            <td>" . $row['extra1'] . "</td><td>" . $row['extra2'] . "</td><td>" . $row['extra3'] . "</td><td>" . $row['extra4'] . "</td></tr>";
            }


            break;

        case 4:

            @$salida_cvs .="Titulo \t Unid. \t Ubicacion (caja rua X) \t ISBN 10 \t ISBN 13 \t Fecha \t Autor \t Editorial \t Tipo \t Num. pag. \t Idioma \t Pais \t Dimensiones \t Comentario \t Extra1 \t Extra2 \t Extra3 \t Extra4 \t Pale \t Grupo";
            @$salida_cvs .= "\n";
            $nombre_fichero = $_SESSION['nombrefichero'];


            $values = $mysqli->query("SELECT * FROM " . $_SESSION['tabla'] . "");
            while ($rowr = mysqli_fetch_assoc($values)) {

                @$salida_cvs .= utf8_decode($rowr['titulo']) . "\t" . $unid = strval($rowr['unid']) . "\t" . utf8_decode($rowr['Ubic_c']) . "\t" . utf8_decode($rowr['isbn_10']) . "\t" . utf8_decode($rowr['isbn_13']) . "\t" . utf8_decode($rowr['fecha']) . "\t"
                        . utf8_decode($rowr['autor']) . "\t" . utf8_decode($rowr['editorial']) . "\t" . utf8_decode($rowr['tipo']) . "\t" . utf8_decode($rowr['pag']) . "\t" . utf8_decode($rowr['idioma']) . "\t" . utf8_decode($rowr['pais']) . "\t"
                        . utf8_decode($rowr['dimen']) . "\t" . utf8_decode($rowr['comentario']) . "\t" . utf8_decode($rowr['extra1']) . "\t" . utf8_decode($rowr['extra2']) . "\t" . utf8_decode($rowr['extra3']) . "\t" . utf8_decode($rowr['extra4']) . "\t" . utf8_decode($rowr['pale']) . "\t" . utf8_decode($rowr['grupo']) . "";

                @$salida_cvs .= "\n";
            }
            $mysqli->query("TRUNCATE TABLE " . $_SESSION['tabla'] . "");

            header("Content-type: application/vnd.ms-excel");
            header("Content-disposition: csv" . date("Y-m-d") . ".csv");
            header("Content-disposition: filename=" . $nombre_fichero . ".csv");
            print $salida_cvs;

            exit();



            break;

        case 5:

            // nombre del archivo csv al crearlo

            if ($_POST['nombre_fich'] != "") {
                $_SESSION['nombrefichero'] = $_POST['nombre_fich'];
                echo 'ok';
            } else {
                echo 'error';
            }
            break;

        case 6:
            if ($mysqli->query("TRUNCATE TABLE " . $_SESSION['tabla'] . "")) {
                echo 'ok';
            } else {
                echo 'error';
            }


            break;

        case 7:
            $result = $mysqli->query("SELECT MAX(id) AS id FROM " . $_POST['tabla']);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = floor($row['id']);
            }


            $sql = "delete from " . $_POST['tabla'] . " where id=" . $id;
            $mysqli->query($sql);
            if ($mysqli->affected_rows > 0) {
                echo 'ok';
            } else {
                echo 'error';
            }



            break;

        case 8:
            //,unid,Ubic_c,isbn_10,isbn_13,fecha,autor,editorial,tipo,pag,idioma,pais,dimen,comentario,extra1,extra2,extra3,extra4,pale,grupo
            //,".$_POST['unid'].",'".$_POST['ubic']."','".$_POST['isbn_10']."','".$_POST['isbn_13']."','".$_POST['fecha']."','".$_POST['autor']."','".$_POST['editorial']."','".$_POST['tipo']."','".$_POST['num_pag']."','".$_POST['lang']."','".$_POST['pais']."','".$_POST['dimen']."','".$_POST['comen']."','".$_POST['extra1']."','".$_POST['extra2']."','".$_POST['extra3']."','".$_POST['extra4']."','".$_POST['pale']."','".$_POST['grupo']."'
            $sql = "INSERT INTO almacen (titulo,unid,Ubic_c,isbn_10,isbn_13,fecha,autor,editorial,tipo,pag,idioma,pais,dimen,comentario,extra1,extra2,extra3,extra4,pale,grupo,nombre_caratula) values('" . $_POST['titulo'] . "'," . $_POST['unid'] . ",'" . $_POST['ubic'] . "','" . $_POST['isbn_10'] . "','" . $_POST['isbn_13'] . "','" . $_POST['fecha'] . "','" . $_POST['autor'] . "','" . $_POST['editorial'] . "','" . $_POST['tipo'] . "','" . $_POST['num_pag'] . "','" . $_POST['lang'] . "','" . $_POST['pais'] . "','" . $_POST['dimen'] . "','" . $_POST['comen'] . "','" . $_POST['extra1'] . "','" . $_POST['extra2'] . "','" . $_POST['extra3'] . "','" . $_POST['extra4'] . "','" . $_POST['pale'] . "','" . $_POST['grupo'] . "','" . $_POST['caratula'] . "')";

            if ($mysqli->query($sql)) {
                echo 'ok';
            }


            break;



        case 10:

            $i = 0;

            //$nombre_fichero=$_SESSION['nombrefichero'];
            //$tabla=$_SESSION['tabla'];
            $cadena = str_replace("_", "&nbsp;", $_GET['fichero']);
            //$cadena = urldecode($_GET['fichero']);
            $sql = "select distinct editorial from " . $_GET['tabla'];
            $result = $mysqli->query($sql);
            $size = $mysqli->affected_rows;
            $editorial = array();
            $y = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $editorial[$y] = $row['editorial'];
                $y++;
            }
            $size = count($editorial);
            echo '<style>
                    #logo {
                          height:10em;
                          width:80%;
                        
                        }
                    div img{
                         width:260px;
                         height:4.2em;
                        }
                    #info{
                        font-size:0.8em;
                        position:absolute;
                        left:420px;
                        top:0px;
                        width:450px;
                        }
                        li{
                        list-style:none;
                        }
                    #info li:last-child{
                    color:#0080FF;
                    text-decoration: underline; 
                    }
                    span{
                    font-weight:bold;

                    }
                    p{
                     font-size:1em;
                     margin-top:1.5em;
                     margin-bottom: 2.1em;
                    }
                    table{
                     margin-top:1em;
                     margin-bottom: 1.2em;
                     width:100%;
                    }
                    th,td{
                    padding:5px;
                    text-align: center;
                    }
                    th{
                     text-decoration: underline;
                    background-color:white;
                    }
                   table tr:nth-child(even){
                   background-color:#F2F2F2
                   }
                   table tr:nth-child(odd) {
                   background: #FFF
                   }
                    </style>';
            echo"<div id='logo'><img src='img1/xunta.png' /></div><div id='info'>
                  <ul>
                  <li>Polígono Industrial do Tambre</li>
		  <li>Vía Pasteur  61 B</li>
                  <li>Santiago de Compostela (A Coruña)</li>
                  <li>C.P: 15890</li>  
                  <li>Tlf: 647577549</li>
                  <li>almacencculturaeulen@gmail.com</li>

                  </ul>
                  </div>
                  
                  <p>Este almacén fai entrega dos seguintes libros a <span>" . $cadena . "</span></p>";


            for ($i = 0; $i < $size; $i++) {

                $sql = sprintf("select * from " . $_GET['tabla'] . " where editorial='%s' ", $editorial[$i]);
                echo '<h3>Editorial: ' . $editorial[$i] . '</h3>';
                $result = $mysqli->query($sql);
                echo '<table>';
                echo '<thead><th>Título</th><th>Autor</th><th>Isbn 13</th><th>Isbn 10</th><th>Exemplares</th></thead>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr><td>' . $row['titulo'] . '</td><td>' . $row['autor'] . '</td><td>' . $row['isbn_13'] . '</td><td>' . $row['isbn_10'] . '</td><td>' . $row['unid'] . '</td></tr>';
                }
                echo '</table>';
            }



            break;

        case 11:
            $id = (int) $_POST['id'];
            $sql = "UPDATE almacen SET titulo='" . $_POST['titulo'] . "', unid=" . $_POST['unid'] . ",Ubic_c='" . $_POST['ubic'] . "', isbn_10='" . $_POST['isbn_10'] . "', isbn_13='" . $_POST['isbn_13'] . "', fecha='" . $_POST['fecha'] . "', autor='" . $_POST['autor'] . "' ,editorial='" . $_POST['editorial'] . "', tipo='" . $_POST['tipo'] . "', pag='" . $_POST['num_pag'] . "', idioma='" . $_POST['lang'] . "', pais='" . $_POST['pais'] . "', dimen='" . $_POST['dimen'] . "', comentario='" . $_POST['comen'] . "', extra1='" . $_POST['extra1'] . "', extra2='" . $_POST['extra2'] . "', extra3='" . $_POST['extra3'] . "',extra4='" . $_POST['extra4'] . "', pale='" . $_POST['pale'] . "', grupo='" . $_POST['grupo'] . "' , nombre_caratula='" . $_POST['nombre_caratula'] . "' WHERE id=" . $id;
            if ($mysqli->query($sql)) {
                echo 'ok';
            }

            break;

        case 12:
            $isbn_10 = $_POST['isbn_10'];
            $isbn_13 = $_POST['isbn_13'];
            $extra1 = $_POST['extra1'];
            $extra2 = $_POST['extra2'];
            $extra3 = $_POST['extra3'];
            $extra4 = $_POST['extra4'];
            if ($isbn_10 == "") {
                $isbn_10 = "@@@@?+*Ç";
            }
            if ($isbn_13 == "") {
                $isbn_13 = "@@@@?+*Ç";
            }
            if ($extra1 == "") {
                $extra1 = "@@@@?+*Ç";
            }
            if ($extra2 == "") {
                $extra2 = "@@@@?+*Ç";
            }
            if ($extra3 == "") {
                $extra3 = "@@@@?+*Ç";
            }
            if ($extra4 == "") {
                $extra4 = "@@@@?+*Ç";
            }
            $sql = "select * from almacen where  grupo='" . $_POST['seccion'] . "' and  (extra4='" . $extra4 . "' or extra1='" . $extra1 . "' or extra2='" . $extra2 . "' or extra3='" . $extra3 . "' or isbn_10='" . $isbn_10 . "' or isbn_13='" . $isbn_13 . "')  ";
            @$result = $mysqli->query($sql);
            while (@$row = mysqli_fetch_assoc($result)) {
                echo '<button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Cancelar</button><button class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>Restar</button><p><span class="badge">' . $_POST['unid'] . '</span></p>';
                echo '<table class="table">'
                . '<thead class="bg-info"><th>Título</th><th>Autor</th><th>Editorial</th><th>Isbn 13</th><th>Isbn 10</th><th>Ubicación</th><th>Unidades</th></thead>';
                echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['autor'] . "</td><td>" . $row['editorial'] . "</td><td>" . $row['isbn_13'] . "</td><td>" . $row['isbn_10'] . "</td><td>" . $row['Ubic_c'] . "</td><td>" . $row['unid'] . "</td></tr>";
                echo "</table><span id='idpubli' style='display:none;'>" . $row['id'] . "</span>";
            }
            break;

        case 13:
            $unid = (int) $_POST['unid'];
            $id = (int) $_POST['id'];

            $sql = "UPDATE almacen SET unid= unid -" . $unid . " where id =" . $id;
            if (@$result = $mysqli->query($sql)) {
                echo 'ok';
            }

            break;
        case 14:
            $sql = "select * from " . $_GET['tabla'] . "";
            $result = $mysqli->query($sql);
            echo'<tr><th>Titulo</th><th>Unid.</th><th>Ubicacion (caja rua X)</th><th>ISBN 10</th><th>ISBN 13</th><th>Fecha</th><th>Autor</th><th>Editorial</th>
                        <th>Tipo</th><th>Num. pag.</th><th>Idioma</th><th>Pais</th><th>Dimensiones</th><th>Comentario</th><th>Extra1</th><th>Extra2</th><th>Extra3</th><th>Extra4</th>
                        </tr>';
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['unid'] . "</td><td>" . $row['Ubic_c'] . "</td><td>" . $row['isbn_10'] . "</td><td>" . $row['isbn_13'] . "</td><td>" . $row['fecha'] . "</td><td>" . $row['autor'] . "</td>
                        <td>" . $row['editorial'] . "</td><td>" . $row['tipo'] . "</td><td>" . $row['pag'] . "</td><td>" . $row['idioma'] . "</td><td>" . $row['pais'] . "</td><td>" . $row['dimen'] . "</td><td>" . $row['comentario'] . "</td>
                            <td>" . $row['extra1'] . "</td><td>" . $row['extra2'] . "</td><td>" . $row['extra3'] . "</td><td>" . $row['extra4'] . "</td></tr>";
            }

            break;

        case 15:
            $sql = "select * from " . $_POST['tabla'] . "";
            $result = $mysqli->query($sql);
            echo'<tr><th>Titulo</th><th>Unid.</th><th>Ubicacion (caja rua X)</th><th>ISBN 10</th><th>ISBN 13</th><th>Fecha</th><th>Autor</th><th>Editorial</th>
                        <th>Tipo</th><th>Num. pag.</th><th>Idioma</th><th>Pais</th><th>Dimensiones</th><th>Comentario</th><th>Extra1</th><th>Extra2</th><th>Extra3</th><th>Extra4</th>
                        </tr>';
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['unid'] . "</td><td>" . $row['Ubic_c'] . "</td><td>" . $row['isbn_10'] . "</td><td>" . $row['isbn_13'] . "</td><td>" . $row['fecha'] . "</td><td>" . $row['autor'] . "</td>
                        <td>" . $row['editorial'] . "</td><td>" . $row['tipo'] . "</td><td>" . $row['pag'] . "</td><td>" . $row['idioma'] . "</td><td>" . $row['pais'] . "</td><td>" . $row['dimen'] . "</td><td>" . $row['comentario'] . "</td>
                            <td>" . $row['extra1'] . "</td><td>" . $row['extra2'] . "</td><td>" . $row['extra3'] . "</td><td>" . $row['extra4'] . "</td></tr>";
            }
            break;
    }// fin del switch
}
?>

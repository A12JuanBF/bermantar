<?php

require_once 'conOOP.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of salidas
 *
 * @author Diego
 */
class grabarSalEnt extends conOOP {

    //put your code here
    private $param;

    function __construct($param) {
        parent::__construct();
        $this->param = $param;
    }

    public function grabSal() {
        $this->param['cod_correos'] = eregi_replace("[\n|\r|\n\r]", ' ', $this->param['cod_correos']);
        $sql = "INSERT INTO salida (destinatario_org, destinatario_pers,direccion,localidad,provincia,cp,fecha,modo_salida,tipo_envio,cod_correos,csv,pdf,comentario)
VALUES ('" . $this->param['destinatario_org'] . "', '" . $this->param['destinatario_pers'] . "', '" . $this->param['direccion'] . "','" . $this->param['localidad'] . "','" . $this->param['provincia'] . "'," . $this->param['cp'] . ",DATE_FORMAT('" . $this->param['fecha'] . "', '%e-%c-%Y'),'" . $this->param['modo_salida'] . "','" . $this->param['tipo_envio'] . "','" . $this->param['cod_correos'] . "','" . $this->param['csv'] . "','" . $this->param['pdf'] . "','" . $this->param['comentario'] . "')";
        $results = $this->con->query($sql);
        if ($this->param['tipo_envio']=="Librería institucional") {
            $sql = "SELECT MAX(id) AS id FROM salida";
            $result = $this->con->query($sql);
            if ($this->con->affected_rows > 0) {


                while ($res = $result->fetch_assoc()) {
                    $id = $res['id'];
                }
                $sql = "SELECT * FROM salida where id=" . $id;
                $result = $this->con->query($sql);
                if ($this->con->affected_rows > 0) {


                    while ($res = $result->fetch_assoc()) {
                        $org = $res['destinatario_org'];
                        $pers = $res['destinatario_pers'];
                        $pdf = $res['pdf'];

                        $cod = $res['cod_correos'];
                    }
                    $nombre = $org . " " . $pers;
                    static::notificarSalida($nombre, $pdf, $cod);
                }
            }
        }
        return $results;
    }

    public function grabEnt() {

        $sql = "INSERT INTO entrada (empresa,persona,fecha,tipo_entrada,albaran,comentario) VALUES('" . $this->param['empresa'] . "','" . $this->param['persona'] . "',DATE_FORMAT('" . $this->param['fecha'] . "', '%e-%c-%Y'),'" . $this->param['tipo_entrada'] . "','" . $this->param['albaran'] . "','" . $this->param['comentario'] . "')";
        $results = $this->con->query($sql);
        $sql = "SELECT MAX(id) AS id FROM entrada";
            $result = $this->con->query($sql);
            if ($this->con->affected_rows > 0) {


                while ($res = $result->fetch_assoc()) {
                    $id = $res['id'];
                }
                $sql = "SELECT * FROM entrada where id=" . $id;
                $result = $this->con->query($sql);
                if ($this->con->affected_rows > 0) {


                    while ($res = $result->fetch_assoc()) {
                        $org = $res['empresa'];
                        $pers = $res['persona'];
                        $pdf = $res['albaran'];
                        $comentario=$res['comentario'];
                        $tipo = $res['tipo_entrada'];
                    }
                    $nombre = $org . " " . $pers;
                    static::notificarEntrada($nombre, $pdf, $tipo,$comentario);
                }
            }
        return $results;
    }

    private static function notificarSalida($nombre, $pdf, $cod) {
        /*ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", "465");
        ini_set("sendmail_from", "almacencculturaeulen@gmail.com");
        ini_set("username", "almacencculturaeulen@gmail.com");
        ini_set("password", "pardillo_82marhuenda");*/
        $asunto = "Salida del pedido " . $nombre;
        $cuerpo = ' 
<html> 
<head> 
   <title>Bermantar</title> 
</head> 
<body> 
<h3>Aplicación web Bermantar</h3> 
<p> 
    El código de envío de correos que corresponde al pedido de <b>' . $nombre . '</b>:  
</p> 
<p><b>' . $cod . '</b></p>
    
<p>Factura en documento pdf del pedido:</p>   
<p><a href="http://almacendotambre.hol.es/pdf/' . $pdf . '">Ver factura en pdf</a></p>
<br> 
<p>Este mail ha sido generado automáticamente por la aplicación web Bermantar</p>
<p>Responder al mail almacencculturaeulen@gmail.com</p>
<p><small>La aplicación web Bermantar ha sido diseñada y desarrollada por Simón Antar Nieto y Juan Diego Bermejo Fdez.</small></p>
</body> 
</html> 
';

//para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

//dirección del remitente 
        //$headers .= "From: Simon y Juan Diego <almacencculturaeulen@gmail.com>\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente 
        //$headers .= "Reply-To: " . $usu->email . "\r\n";
//ruta del mensaje desde origen a destino 
        //$headers .= "Return-path: holahola@desarrolloweb.com\r\n";
//direcciones que recibián copia 
        //$headers .= "Cc: maria@desarrolloweb.com\r\n";
//direcciones que recibirán copia oculta 
        //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

        mail('aplicacion.rafdiejav@gmail.com', $asunto, $cuerpo, $headers);
    }

    private static function notificarEntrada($nombre, $pdf, $tipo,$comentario) {
       /* ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", "465");
        ini_set("sendmail_from", "almacencculturaeulen@gmail.com");
        ini_set("username", "almacencculturaeulen@gmail.com");
        ini_set("password", "pardillo_82marhuenda");*/
        $asunto = "Entrada " . $nombre;
        $cuerpo = ' 
<html> 
<head> 
   <title>Bermantar</title> 
</head> 
<body> 
<h3>Aplicación web Bermantar</h3> 
<p> 
    El almacén ha registrado una entrada que proviene de <b>' . $nombre . '</b>:  
</p> 
<p>El tipo de entrada corresponde a <b>' . $tipo. '</b></p>
    
<p>Albarán correspondiente a la entrada:</p>   
<p><a href="http://almacendotambre.hol.es/pdf/' . $pdf . '">http://almacendotambre.hol.es/pdf/' . $pdf . '</a></p>
<br> 
<p>Asunto:</p>
<p>'.$comentario.'</p>
    <br>
<p>Este mail ha sido generado automáticamente por la aplicación web Bermantar</p>
<p>Responder al mail almacencculturaeulen@gmail.com</p>
<p><small>La aplicación web Bermantar ha sido diseñada y desarrollada por Simón Antar Nieto y Juan Diego Bermejo Fdez.</small></p>
</body> 
</html> 
';

//para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

//dirección del remitente 
        //$headers .= "From: Simon y Juan Diego <almacencculturaeulen@gmail.com>\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To: almacencculturaeulen@gmail.com\r\n";
//ruta del mensaje desde origen a destino 
        //$headers .= "Return-path: holahola@desarrolloweb.com\r\n";
//direcciones que recibián copia 
        //$headers .= "Cc: maria@desarrolloweb.com\r\n";
//direcciones que recibirán copia oculta 
        //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

        mail('aplicacion.rafdiejav@gmail.com', $asunto, $cuerpo, $headers);
    }

}

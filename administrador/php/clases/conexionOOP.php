<?php



/**
 * Description of conexionOOP
 * clase que crea un objeto para conectar a la base de datos
 *
 * @author JDBF
 */
class conexionOOP {
    //put your code here
    public $con;
    public function __construct() {
            $mysqli = new mysqli('localhost', 'root', '', 'bermantar');
            if ($mysqli->connect_error) {
            die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
            }
            $this->con=$mysqli;
        }
}
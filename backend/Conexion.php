<?php
/**
* CONEXION
* Version 0.0.1
*/
class Conexion extends mysqli
{
    /**
     * @var string
     */
    private static $servidor = 'localhost';
    /**
     * @var string
     */
    private static $usuario  = 'root';
    /**
     * @var string
     */
    private static $password = '';
    /**
     * @var string
     */
    private $baseDatos       = '';
    /**
     * @var null
     */
    private $con             = NULL;

    /**
     * Conexion constructor.
     */
    public function __construct() {
        if( is_null( $this->con ) ) {
            parent::__construct( self::$servidor, self::$usuario, self::$password, $this->baseDatos );
            // VALIDAR CONEXION
            if( mysqli_connect_error() ) {
                die( 'Error de Conexión ( ' . mysqli_connect_errno() . ' ) ' . mysqli_connect_error() );
            }
    
            $this->set_charset( 'utf8' );
        }
    }
}

$conexion = new Conexion();

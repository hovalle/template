<?php 
/**
* SESSION
*/

class Session {

    private $con  = null;
    private $sess = null;
    
    // INICIALIZAR CONSTRUCTOR	
    function __construct()
    {
        global $conexion, $session;

        // SI NO ESTA ASIGNADA LA VARIABLE DE SESSION
        if( !isset( $_SESSION ) )
            $this->iniciarSesion();

        $this->con  = $conexion;
        $this->sess = $session;
    }

    // INICIALIZAR LA SESSION
    function iniciarSesion()
    {
        session_start();
    }

    // DESTRUIR LA FUNCIÓN
    function destruirSesion()
    {
        $this->iniciarSesion();
        session_destroy();
    }

    // SETEAR TIEMPO SESION
    public function setTimeSession()
    {
        if ( isset( $_SESSION['last_act'] ) ) {

            $last   = $_SESSION['last_act'];

            $d_data = explode("/", $last);
            
            $seg  = $d_data[ 0 ];
            $min  = $d_data[ 1 ];
            $hora = $d_data[ 2 ];
            $dia  = $d_data[ 3 ];
            $mes  = $d_data[ 4 ];
            $anio = $d_data[ 5 ];
            
            $last_a = mktime( $hora, $min, $seg, $mes, $dia, $anio );
            $now    = time();
            $dif    = $now - $last_a;
            
            if ( !( $dif > 1800 ) )		// 30 MINUTOS
                $_SESSION['last_act'] = date("s/i/H/d/m/Y");

            else
                $this->destruirSesion();
        }
    }

    // SETEAR SESION
    public function setSession()
    {
        $_SESSION['last_act'] = date("s/i/H/d/m/Y");
        $_SESSION['login']    = true;
    }

    // SESION VÁLIDA
    public function sessionValid()
    {
        $respuesta = false;

        if ( isset( $_SESSION['login'] ) && $_SESSION['login'] )
            $respuesta = true;

        return (int)$respuesta;
    }

    // OBTENER EL VALOR DE LA SESSION
    private function getVarSesion( $variable )
    {
        return isset( $_SESSION[ $variable ] ) ? $_SESSION[ $variable ] : FALSE;
    }

    // ASIGNAR VALOR A VARIABLE DE SESSION
    function setVarSesion( $variable, $valor )
    {
        $_SESSION[ $variable ] = $valor;
    }

    // OBTENER NOMBRE BÁSICO
    function getName()
    {
        return mb_strtoupper( $this->getVarSesion( 'fullname' ) );
    }

    // OBTENER AGENCIA ASIGNADA
    function getIdAgencia()
    {
        return $this->getVarSesion( 'agenc' );
    }

    // OBTENER PERFIL DE SESION
    function getIdGrupo()
    {
        return $this->getVarSesion( 'idGrupo' );
    }

    // OBTENER USUARIO
    function getUsername()
    {
        return strtolower( $this->getVarSesion( 'username' ) );
    }


}

$session = new Session();

?>
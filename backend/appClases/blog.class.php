<?php

/**
 * Class Blog
 */
class Blog
{
    /**
     * @var \Conexion|null
     */
    private $con  = NULL;
    /**
     * @var \Session|null
     */
    private $sess = NULL;
    
    
    /**
     * Blog constructor.
     */
    public function __construct()
    {
        global $conexion, $session;
        
        if( is_null( $this->con ) ) {
            $this->con = $conexion;
        }
        if( is_null( $this->sess ) ) {
            $this->sess = $session;
        }
    }
    
    // VALIDAR SIGUIENTE RESULTADO
    
    /**
     * @return array
     */
    public function catProceso()
    {
        $catProceso = [];
        // CONSULTA SQL
        $sql = "SELECT * FROM catProceso;";
        
        if( $rs = $this->con->query( $sql ) ) {
            while( $row = $rs->fetch_assoc() ) {
                $catProceso[] = $row;
            }
        }
        
        return $catProceso;
    }
    
    // CATALOGO DE PROCESOS ( TIPOS DE PRESTAMOS )
    
    /**
     *
     */
    private function validarSiguienteResultado()
    {
        if( $this->con->more_results() ) {
            $this->con->next_result();
        }
    }
}

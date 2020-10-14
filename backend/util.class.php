<?php 
/*
    v.0.1.0
    CLASE PARA CONSULTAS DE BASE DE DATOS, ENTRE OTROS
*/
class Util {
    private $con = NULL;

    function __construct()
    {
        global $conexion;
        $this->con = $conexion;
    }

    // CONSULTA NORMAL
    public function querySql( $query )
    {
        return $this->con->query( $query );
    }

    // RETORNA UN RESULTADO O UNA LISTA DE RESULTADOS
    public function queryResult( $query, $list = true, $forceObject = true, $cast = array() )
    {
        $result = NULL;

        if ( $list )
            $result = array();

        $rs = $this->con->query( $query );

        // LIMPIAR SIGUIENTE RESULTADO
        if( $this->con->more_results() )
            $this->con->next_result();

        // NUMERO DE RESULTADOS ES MAYOR A CERO
        if ( $rs->num_rows )
        {
            while ( $row = $rs->fetch_assoc() ):

                if ( count( $cast ) )
                {
                    // SI HAY QUE CASTEAR EL RESULTADO
                    foreach ($cast as $curr)
                    {
                        // SI ES ARREGLO SE CONVIERTE A OBJETO
                        if ( is_array( $curr ) )
                            $curr = (object)$curr;

                        if ( isset( $row[ $curr->var ] ) )
                            $row[ $curr->var ] = $this->cast( $row[ $curr->var ], $curr->cast );
                    }
                }

                // SI SE FUERZA A QUE SEA OBJETO
                if ( $forceObject )
                    $row = (object)$row;

                // SI ES LISTA
                if ( $list )
                    $result[] = $row;

                else
                    $result = $row;

            endwhile;
        }

        return $result;
    }

    // CONSULTA DE PROCEDIMIENTO (GUARDAR, ACTUALIZAR, ELIMINAR)
    public function queryCall( $query, $return1 = 'id', $transaccion = false )
    {
        $respuesta = NULL;

        # APLICAR TRANSACCION
        if ( $transaccion )
            $this->con->query( "START TRANSACTION" );

        if ( $rs = $this->con->query( $query ) )
        {
            // LIMPIAR SIGUIENTE RESULTADO
            if( $this->con->more_results() )
                $this->con->next_result();

            if ( $rs->num_rows AND $row = $rs->fetch_object() )
                $respuesta = (object)array(
                    'respuesta' => $row->respuesta,
                    'mensaje'   => $row->mensaje,
                    'info'      => ( isset( $row->$return1 ) ? $row->$return1 : NULL )
                );

            else
                $respuesta = (object)array(
                    'respuesta' => 'danger',
                    'mensaje'   => 'Sin resultados',
                    'info'      => NULL
                );
        }
        else{
            $respuesta = (object)array(
                'respuesta' => 'danger',
                'mensaje'   => 'Error al ejecutar la consulta',
                'errno'   	=> $this->con->errno,
                'error'   	=> $this->con->error,
                'info'      => NULL
            );
        }

        # SI APLICA TRANSACCION
        if ( $transaccion AND $respuesta->respuesta == 'success' )
            $this->con->query( "COMMIT" );

        else if ( $transaccion AND $respuesta->respuesta == 'danger' )
            $this->con->query( "ROLLBACK" );

        return $respuesta;
    }

    // ALIAS: real_escape_string
    public function realText( $text )
    {
        return $this->con->real_escape_string( $text );
    }

    // CAST: UTILIZADO PARA queryResult, se puede extender
    private function cast( $value, $cast )
    {
        switch ( $cast ) {
            case 'bool':
            case 'boolean':
            case 'int':
                $value = (int)$value;
                break;

            case 'double':
                $value = (double)$value;
                break;
        }

        return $value;
    }

    // IMPRIME UN OBJETO EN TEXTO JSON
    static public function toJson( $object )
    {
        echo json_encode( $object );
    }
}

?>
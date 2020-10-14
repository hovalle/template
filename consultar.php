<?php
    session_start();

    $datos = json_decode( file_get_contents( "php://input" ), FALSE );

    GLOBAL $conexion;

    include 'backend/Conexion.php';
    include 'backend/session.class.php';
    include 'backend/funciones.fn.php';
    include 'backend/util.class.php';

    include 'backend/appClases/blog.class.php';

    $data = array();

    switch( $datos->tipo ) {
        // CATALOGO PROCESOS ( TIPOS DE PRESTAMOS )
        case 'catProceso':
            $ejemplo = new Blog();
            Util::toJson( $ejemplo->catProceso() );
            break;

        default:
            $noAccion = "Accion no valida.";
            Util::toJson( $noAccion );
            break;

    }

    $conexion->close();
    unset( $conexion );

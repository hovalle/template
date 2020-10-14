<?php

// DESCOMPONER ARREGLO
function descomponerTxt( $texto )
{
    
    $parent     = explode( "#", $texto );
    $lstEntorno = array();
    
    foreach( $parent as $ix => $item ) {
        $obj      = explode( "=", $item );
        $acciones = explode( ",", $obj[ 1 ] );
        $lst      = array();
        
        foreach( $acciones as $key => $item ) {
            $lst[] = json_decode( $item );
        }
        
        $lstEntorno[ $obj[ 0 ] ] = $lst;
    }
    
    return (object)$lstEntorno;
}


// CASTEAR VARIABLE
function castVariable( $cast, $valor )
{
    if( $cast == 'int' or $cast == 'boolean' )
        $valor = castInt( $valor );
    
    elseif( $cast == 'text' or $cast == 'email' or $cast == 'name' )
        $valor = castText( $valor );
    
    elseif( $cast == 'double' )
        $valor = castDouble( $valor );
    
    elseif( $cast == 'date' )
        $valor = castDate( $valor );
    
    return $valor;
}


// CASTEAR A ENTERO
function castDate( $valor )
{
    $valor = strtotime( $valor );
    $valor = date( "Y-m-d", $valor );
    
    return $valor;
}


// CASTEAR A ENTERO
function castInt( $valor )
{
    $valor = (int)$valor;
    
    return $valor;
}


// CASTEAR A TEXTO
function castText( $valor )
{
    $valor = (string)$valor;
    
    return $valor;
}


// CASTEAR A DOUBLE
function castDouble( $valor )
{
    $valor = (double)$valor;
    
    return $valor;
}


// FORMATEAR NOMBRE
function formatearNombre( $cadena )
{
    $cadena = str_replace( array( 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ' ), array( 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N' ), $cadena );
    $cadena = preg_replace( "/[^A-Za-z0-9_\.\s]+/", "", $cadena );
    
    return utf8_encode( $cadena );
}


// VÁLIDA NOMBRES ANGENCIA SIN REPETIR PALABRA AGENCIA
function valAgencia( $agencia )
{
    $agencia = "Agencia " . $agencia;
    $agencia = str_replace( "Agencia Agencia", "Agencia", $agencia );
    
    return $agencia;
}


// VALIDAR DATO NULO
function validarEsNulo( $variable )
{
    return is_null( $variable ) ? FALSE : TRUE;
}


// QUITAR ESPACIOS EN TEXTO
function valEspacios( $texto )
{
    $texto = trim( $texto );
    
    while( strpos( $texto, "  " ) > 0 )
        $texto = str_replace( "  ", " ", $texto );
    
    return $texto;
}


function formatoFecha( $fecha )
{
    $fecha = explode( '-', $fecha );
    $fecha = $fecha[ 2 ] . "/" . $fecha[ 1 ] . "/" . $fecha[ 0 ];
    
    return $fecha;
}


// CREA FORMATO DE FECHA RECIBIDA (Y-m-d)
function filtrarFecha( $fecha )
{
    $fecha = new DateTime( $fecha );
    $fecha = DATE_FORMAT( $fecha, 'Y-m-d' );
    
    return $fecha;
}


// VALIDAR NOMBRE // TEXTO NO VÁLIDO
function limpiaTexto( $texto )
{
    $texto = textoNoValido( $texto );
    $texto = valEspacios( $texto );
    
    return $texto;
}


// VALIDAR NÚMERO
function limpiaNumero( $numero )
{
    $numero = textoNoValido( $numero );
    $numero = preg_replace( "/[^0-9]+/", "", $numero );
    $numero = valEspacios( $numero );
    
    return $numero;
}


// FN TEXTO NO VÁLIDO
function textoNoValido( $texto )
{
    $txtNoValido = array( ' (UN) ', ' (UA) ', ' ( UA ) ', ' (U/A) ', ' UA ', ' NA ', ' UN ', ' TO8 ', ' IDEM ', ' NO TIENE ' );
    $texto       = str_replace( $txtNoValido, " ", " " . $texto . " " );
    
    return $texto;
}

//RETORNA FECHA HORA
function fechaHora( $fecha )
{
    $fecha = new DateTime( $fecha );
    $fecha = DATE_FORMAT( $fecha, 'd-m-Y H:i:s' );
    
    return $fecha;
}

?>

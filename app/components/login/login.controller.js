( function() {
    'use strict';
    angular.module( 'app' ).controller( 'LoginController', [ '$scope', '$http', '$timeout', '$request', '$message', function( $scope, $http, $timeout, $request, $message ) {

        $request.setDefault( 'consultar.php' );
        
        //Inicialización de variables
        $scope.usr = {
            usuario : '',
            pass : ''
        };
        
        $scope.init = function() {
            console.log( 'Login cargado correctamente.' );
        };

        $scope.loginUsuario = function() {
            console.log('usuario: ', $scope.usr.usuario );
            console.log('Contraseña: ', $scope.usr.pass );
        }

        $timeout( function() {
            $scope.init();
        } );
    } ] );
} )();

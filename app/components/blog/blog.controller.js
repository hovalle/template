( function() {
    'use strict';
    angular.module( 'app' ).controller( 'BlogController', [ '$scope', '$http', '$timeout', '$request', '$message', function( $scope, $http, $timeout, $request, $message ) {

        $request.setDefault( 'consultar.php' );

        $scope.init = function() {
            console.log( 'Blog cargado correctamente.' );
            //$scope.catProceso();
            $scope.consultaBd();
        };

        $scope.catProceso = function() {
            $request.query( {
                params  : {
                    'tipo' : 'catProceso'
                },
                call    : function( data ) {
                    $scope.catProceso = data;
                    $message.Msj( {
                        title : 'Mostrando resultados',
                        type  : 'success',
                        time  : 4
                    } );
                },
                console : true,

            } );
        };

        $scope.datosHttp  = [];
        $scope.consultaBd = function() {
            //var url = "https://jsonplaceholder.typicode.com/users";
            var url = "https://jsonplaceholder.typicode.com/posts";
            $http.get( url ).then(
                function( response ) {
                    // success callback
                    console.log( 'DATA', response.data );
                    $scope.datosHttp = response.data;
                    $message.Msj( {
                        title : 'Consulta exitosa',
                        type  : 'warning',
                        time  : 4
                    } );
                },
                function( response ) {
                    // failure callback
                    console.log( 'Response ERROR', response );
                }
            );
        };

        $timeout( function() {
            $scope.init();
        } );
    } ] );

} )();

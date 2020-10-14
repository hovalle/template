( function() {
    'use strict';
    angular.module( 'app' ).controller( 'LoginController', [ '$scope', '$http', '$timeout', function( $scope, $http, $timeout ) {
        $scope.init = function() {
            console.log( 'Login cargado correctamente.' );
        };

        $timeout( function() {
            $scope.init();
        } );
    } ] );
} )();

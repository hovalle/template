( function() {
    'use strict';
    angular.module( 'app' ).controller( 'HeaderController', [ '$scope', '$http', '$timeout', function( $scope, $http, $timeout ) {
        $scope.init = function() {
            console.log( 'Header cargado correctamente.' );
        };

        $timeout( function() {
            $scope.init();
        } );

    } ] );
} )();

( function() {
    'use strict';
    angular.module( 'app' ).controller( 'HomeController', [ '$scope', '$http', '$timeout', function( $scope, $http, $timeout ) {
        $scope.init = function() {
            console.log( 'Home cargado correctamente.' );
        };

        $timeout( function() {
            $scope.init();
        } );
    } ] );
} )();

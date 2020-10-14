( function() {
    'use strict';
    angular.module( 'app' ).config( [ '$routeProvider', function( $routeProvider ) {
        $routeProvider.when( '/', {
            templateUrl  : 'app/components/login/login.view.php',
            controller   : 'LoginController',
            controllerAs : 'login'
        } ).when( '/home', {
            templateUrl  : 'app/components/home/home.view.php',
            controller   : 'HomeController',
            controllerAs : 'home'
        } ).when( '/blog', {
            templateUrl  : 'app/components/blog/blog.view.php',
            controller   : 'BlogController',
            controllerAs : 'blog'
        } ).otherwise( {
            redirectTo : '/'
        } );
    } ] );
} )();

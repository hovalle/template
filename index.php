<!doctype html>
<html lang="es-GT" data-ng-app="app">
    <head>
        <title>COSAMI R.L.</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="icon" type="image/png" href="assets/img/faviconCosami.png" />
        <!--En esta parte se incluiran las librerias que estaran disponibles en la intranet-->
        <!-- Bootstrap -->
        <link href="assets/libs/bootstrap.min.css" rel="stylesheet">
        <link href="assets/libs/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/style.min.css" rel="stylesheet">
    </head>
    <body>
        <!--[if lt IE 10]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--header-->
        <div ng-include="'app/partials/header/header.view.php'"></div>

        <!-- DIV PARA NOTIFICACIONES -->
        <div class="notificationcontent" id="notificationcontent"></div>

        <div class="container">
            <div ng-view></div>
        </div>
        <!--En esta parte se incluiran las librerias que estaran disponibles en la intranet-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/libs/jquery-3.5.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/libs/popper.min.js"></script>
        <script src="assets/libs/bootstrap.min.js"></script>
        <!-- angularjs -->
        <script src="assets/libs/angular.min.js"></script>
        <script src="assets/libs/angular-route.min.js"></script>
        <!--aplicacion-->
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/request.js"></script>
        <script src="assets/js/message.js"></script>
    </body>
</html>

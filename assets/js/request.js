/*######################################################################
    Request v1.1.0
    Descripción: Servicio para realizar peticiones al servidor, incluye animación al realizar petición, validaciones
    ***Dependencia para mostrar alertas: '$message'
  ######################################################################*/

angular.module('app').service('$request', function( $http, $message, $rootScope ) {
    this.defaultRequest = null;
    this.idElementWait  = 'consultando-content';
    this.statusWait     = false;
    this.time           = 5;

    // DEFINIR ANIMACION ESPERA
    this.setWait = function ( estado, msj ) {
        if ( estado === this.statusWait ) return;

        if ( estado )
        {
            $( "#" + this.idElementWait ).show();
            $( "#" + this.idElementWait + ">.content>.texto>span" ).html( ( msj || 'Consultando...' ) );
        }
        else
            $( "#" + this.idElementWait ).hide();

        this.statusWait = estado;
    };

    // SI ESTA ESPERANDO
    this.isWait = function () {
        return this.statusWait;
    };

    // RUTA DE PETICION POR DEFECTO
    this.setDefault = function ( _default ) {
        this.defaultRequest = _default;

        // SI EXISTE EL ELEMENTO
        if ( !document.getElementById( this.idElementWait ) )
            this.setElementWait();
    };

    // SI NO EXISTE CONTENEDOR LO CREA
    this.setElementWait = function () {
        var style = "<style>.consultando {" +
            "position: fixed;top: 0px;left: 0px;background-color: rgba(0, 0, 0, 0.1);width: 100%;height: 100%;z-index: 6000;text-align: center;cursor: wait;}" +
            ".consultando>.content{" +
            "position: absolute; width: 100%; margin: auto 0px auto 0px; height: 94px; background-color: #1a4586; top: 0px; bottom: 0px; box-shadow: 0px 3px 15px 1px rgba(99, 99, 99, 0.48); border: solid 2px #2a65bd; border-bottom: solid 4px #2a64bd; padding-top: 15px;}" +
            ".consultando>.content>.animacion{" +
            "background-repeat: no-repeat; width: 65px; height: 65px; text-align: center; padding-top: 7px; display: inline-block;}" +
            ".consultando>.content>.texto{" +
            "color: #AFCCEA; font-size: 45px; -webkit-animation: animate-text 1.8s infinite ease-in-out both; animation: animate-text 1.8s infinite ease-in-out both; display: inline-block; height: 60px; top: -22px; width: auto; position: relative;}" +
            ".loading3 {" +
            " animation: clockwise 1.5s linear infinite; display: block; height: 2.8em; position: relative; width: 2.8em;}" +
            ".loading3,.loading3:before,.loading3:after {" +
            "border: .3em solid transparent;border-radius: 50%;border-top-color: rgb(255, 255, 255);margin: auto;}" +
            ".loading3:before,.loading3:after {" +
            " content: ''; position: absolute;}" +
            ".loading3:before {" +
            " animation: anticlockwise .9s linear infinite;top: -.6em;right: -.6em;bottom: -.6em;left: -.6em;}" +
            ".loading3:after {" +
            " animation: anticlockwise .66s linear infinite;top: .3em;right: .3em;bottom: .3em;left: .3em;}" +
            "@keyframes clockwise {" +
            " 0%  { transform: rotate(0deg) } 100%{ transform: rotate(360deg) } }" +
            "@keyframes anticlockwise {" +
            "0%  { transform: rotate(360deg) } 100%{ transform: rotate(0deg) } }</style>";

        var content = 
            '<div class="consultando" id="consultando-content" style="display:none">' +
                '<div class="content">' +
                    '<div class="animacion">' +
                        '<div class="loading3"></div>' +
                    '</div>' +
                    '<div class="texto">' +
                        '<span>ND</span>' +
                    '</div>' +
                '</div>' +
            '</div>';

        $("body").prepend( style );
        $("body").prepend( content );
    };

    /*
    ::::::::::::::::: FUNCION PARA REALIZAR PETICION :::::::::::::::::
    */
    this.query = function ( _params ) {
        if ( this.statusWait && !( _params.force ) ) return false;

        var error    = "",
            showWait = ( _params.wait == undefined ? true : _params.wait );

        // VALIDACION DE PARAMETRO
        if ( _params.params === undefined )
            error = "Parametros no definido";

        else if ( typeof _params.params !== 'object' )
            error = "Error, parametro debe ser un objeto";

        else if ( !Object.keys( _params.params ).length )
            error = "No existe ningún parametro definido";


        // SI NO ESTA DEFINIDO PARAMETRO 'call'
        else if ( _params.call === undefined )
            error = "Prametro \"call\" es necesario";


        // PETICION POR DEFECTO NO FUNCIONA
        else if ( this.defaultRequest === null )
            error = "Por favor definir la variable: \"defaultRequest\"";

        // SI EXISTE ALGUN ERROR EN PARAMETROS PARA REALIZAR PETICION
        if ( error.length )
            $message.Msj({ title: error, type: 'danger', time: this.time });

        else
        {
            var that = this;

            // SI SE MOSTRAR MENSAJE
            if ( showWait )
                this.setWait( true, _params.msgWait );

            $http.post((_params.to || this.defaultRequest), _params.params).then(function (response) {
                // SI MUESTRA ANIMACION DE CARGANDO
                if (showWait)
                    that.setWait(false);

                if (_params.console)
                    console.log(response.data);

                // SI ES UNA FUNCION
                if (typeof _params.call === 'function')
                    _params.call(response.data);
            }, function (_data, _code) {
                // SI MUESTRA ANIMACION DE CARGANDO
                if (showWait)
                    that.setWait(false);

                $message.Msj({ title: 'Ocurrio un error con el Servidor.<br><u>Code</u>: ' + _code + '.<br><u>Response</u>: ' + _data, type: 'danger', time: this.time });
            });
        }
    };
});
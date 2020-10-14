// MESSAGE NOTIFICATION
angular.module('app').provider('$message', function () {
    this.$get = function () {
        // LISTA ITEMS ALERTAS
        var lsnoti = [];
        // msjsound  = new Audio("sound/message1.mp3"); // buffers automatically when created

        // AGREGA UN NUEVO ITEM
        function newMsj( data ) {
            var icon = 'info-sign';

            if( data.type == 'success' ) icon = "ok-sign";

            else if( data.type == 'warning' ) icon = "exclamation-sign";

            else if( data.type == 'danger' ) icon = "remove-sign";

            lsnoti.push( data );

            var remite = '';

            if( data.remitente.length > 0 ) {
                remite = '<div class="remitente"><span>De: <b>' + data.remitente + '</b></span></div>';
            }
            return '<div class="notification-item ' + data.type + ' fade-enter" id="nt' + data.id + '">' +
                '<div class="icon">' +
                '<span class="glyphicon glyphicon-' + icon + '"></span>' +
                '</div>' +
                '<div class="contenido">' +
                remite +
                '<span class="title">' + data.title + '</span>' +
                '<span class="content">' + data.content + '</span>' +
                '</div>' +
                '</div>';
        }

        // INTERVALO INSPECCIONA SI EXISTE NOTIFICACIONES
        setInterval(function () {
            if (lsnoti.length > 0) {
                var eliminar = [];
                // RESTA 0.5 SEGUNDOS DEL TIEMPO DE MENSAJE
                for (var i = 0; i < lsnoti.length; i++) {
                    lsnoti[i].time -= 0.5;

                    // ACUMULA ELEMENTOS CON TIEMPO VENCIDO
                    if (lsnoti[i].time <= 0)
                        eliminar.push(lsnoti[i].id);
                };

                // ELIMINA ELEMENTOS CON TIEMPO VENCIDO
                if (eliminar.length > 0) {
                    for (var i = 0; i < eliminar.length; i++)
                        removeItem(eliminar[i]);
                    eliminar = [];
                };
            }
        }, 500);

        // EVENTO --> SI SE HACE CLIC EN UN ITEM SE ELIMINARA
        $(function () {
            $(".notificationcontent").on('click', '.notification-item', function (ev) {
                var id = $(this).attr("id").substring(2);
                removeItem(id);
                //refresca la pagina solo si se clickea sobre el mensaje
            });
        });

        // FUNCION PARA ELIMINAR ITEM DE VISTA
        function removeItem(id) {
            for (var i = 0; i < lsnoti.length; i++) {
                if (lsnoti[i].id == id) {
                    lsnoti.splice(i, 1);
                    $(".notificationcontent>#nt" + id).addClass("fade-leave");
                    setTimeout(function () {
                        $(".notificationcontent>#nt" + id).remove();
                    }, 400);
                }
            };
        }

        // AGREGA UN NUEVO MENSAJE
        function pushMsj(data) {
            if (data.title || data.content) {
                var
                    title = data.title || '',
                    content = data.content || '',
                    type = data.type || 'info',
                    time = data.time || 4,
                    remitente = data.from || '',
                    sound = data.sound === true ? true : false,
                    d = new Date();

                var idtime = d.getTime();
                idtime = idtime + parseInt(Math.random(1000) * 1000);

                var datos = { title: title, content: content, type: type, time: time, id: idtime, remitente: remitente };

                if (sound)
                    msjsound.play();

                $(".notificationcontent").append(newMsj(datos));
            }
        };

        return {
            Msj: function (data) {
                pushMsj(data);
            }
        }

    };
});

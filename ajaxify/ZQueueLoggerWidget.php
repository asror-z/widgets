<?php

namespace zetsoft\widgets\ajaxify;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;


class ZQueueLoggerWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'port' => 5555
    ];


    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [

        'js' => <<<JS
            var conn = new WebSocket('ws://' + window.location.hostname + ':{port}'); //connect to websocket
            var mouseEntered = false;
            $(window).load(function() {
                if($('.jsPanel-content').text() === "")
                        conn.send(JSON.stringify({
                        type: 'all',
                        cookie: '{cookie}'
                    }))
                    
                           var n = 0;
                    $( ".jsPanel-content" )
                      .mouseenter(function() {
                      mouseEntered = true
                      })
                      .mouseleave(function() {
                        mouseEntered = false
                      });
                      $(".fa-stop-circle").on('click',function() {
                          conn.send(JSON.stringify({
                            type: "stop",
                            cookie: '{cookie}'
                          }))
                      })
                    })
            var cookie = '{cookie}'
            conn.onopen = () => console.log("connection established")
            conn.onmessage = function (data) {
                if (data.data !== "empty"){
                    $('.jsPanel-content').append('<p> '+ data.data + '</p>')
                    if (!mouseEntered)
                    $(".jsPanel-content").animate({ scrollTop: $(".jsPanel-content")[0].scrollHeight},0);
                }else{
                    // $('.jsPanel-content').append('<p>Finished</p>')
                }
                // console.log("---" + data.data)
            }
            
            let timerId = setInterval(function () {
                if (isOpen(conn)) {
                    
                    conn.send(JSON.stringify({
                        type: 'one',
                        cookie: '{cookie}'
                    }))
                }
            }, 500);
                 
            function isOpen(ws) {
                return ws.readyState === ws.OPEN
            }
JS,


    ];


    public function asset()
    {
//        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js');

    }


    public function codes()
    {
        $this->js = strtr($this->_layout['js'], [
            '{cookie}' => Az::$app->cores->session->getCookieSession(),
            '{port}' => $this->_config['port'],

            ]);
    }


}


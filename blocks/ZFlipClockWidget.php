<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Created By :ElnurController Suyunov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\blocks;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;

class ZFlipClockWidget extends ZWidget
{
    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.min.js');
        
    }

    public $config = [];
    public $_config = [
    'clockFace'=> 'DailyCounter',
    'autostart'=>'false',

    ];


    public $event = [];
    public $_event = [
    ];


    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
   <div class="well">
            <div id="clock"></div>
        </div>
<div class="message"></div>

HTML,
        'css'=><<<CSS
  
CSS,


        'js' => <<<JS
         setInterval(function () {
        flipTest()
    }, 1000);

    function flipTest() {
        $("#test").removeClass("play");
        var n = $("#test .fc-number.active");

        if (n.html() == undefined) {
            n = $("#test .fc-number").eq(0);
            n.addClass("before")
                .removeClass("active")
                .next(".fc-number")
                .addClass("active")
                .closest("#test")
                .addClass("play");
        } else if (n.is(":last-child")) {
            $("#test .fc-number").removeClass("before");
            n.addClass("before").removeClass("active");
            n = $("#test .fc-number").eq(0);
            n.addClass("active")
                .closest("#test")
                .addClass("play");
        } else {
            $("#test .fc-number").removeClass("before");
            n.addClass("before")
                .removeClass("active")
                .next(".fc-number")
                .addClass("active")
                .closest("#test")
                .addClass("play");
        }
    }

    var clock;

    $(document).ready(function () {
        var clock;

        clock = $('#clock').FlipClock({
            clockFace: 'DailyCounter',
            autoStart: false,
            callbacks: {
                stop: function () {
                    $('.message').html('The clock has stopped!')
                }
            }
        });

        clock.setTime(12);
        clock.setCountdown(true);
        clock.start();

    });
		
JS,
    ];

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
        ]);
        $this->css = strtr($this->_layout['main'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
        ]);

    }

}

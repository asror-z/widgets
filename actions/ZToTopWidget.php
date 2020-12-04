<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: AzimjonToirov
 * Refactored: AzimjonToirov
 */
class ZToTopWidget extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public $event = [];
    public $_event = [

    ];



    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
        <fixeds id="arrowUp" onclick="slowScroll('#home')">
</fixeds>

HTML,


        'js' => <<<JS
            function slowScroll(id) {
        $('html, body').animate({
            scrollTop: $(id).offset().top
        }, 500)
    }

    $(document).on("scroll", function () {
        if($(window).scrollTop() === 0)
            $("fixeds").removeClass("fixed");
        else
                $("fixeds").attr("class", "fixed");
    });
JS,

        'css' => <<<CSS
.fixed-btn-up {
    width: 40px;
    height: 50px;
    z-index: 1000;
    background: #00adff;
    color: #ffffff;
    position: fixed;
    right: 20px;
    bottom: 20px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
    border-radius: 10px;
    box-shadow: 0 5px 6px rgba(0, 0, 0, .5);
}

.fixed-btn-up:hover {
    box-shadow: 0 2px 3px rgba(0, 0, 0, .2);
}
CSS,


    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);
        $this->js = strtr($this->_layout['js'], [

        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
    }
}

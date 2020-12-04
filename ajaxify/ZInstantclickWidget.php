<?php

namespace zetsoft\widgets\ajaxify;


use zetsoft\system\kernels\ZWidget;


class ZInstantclickWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [


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
    InstantClick.init('mousedown')
JS,


    ];


    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/dieulot/instantclick/v3.1.0/instantclick.js');
    }


    public function codes()
    {
             
        $this->js = strtr($this->_layout['js'], []);

    }

}


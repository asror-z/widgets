<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * official site:
 * https://unpoly.com/
 * github:
 * https://github.com/unpoly/unpoly
 * clean:
 * http://eyuf.zettest.uz/render/ajaxify/SPA/ZUnpolyWidget/front.php
 */

namespace zetsoft\widgets\ajaxify;

use zetsoft\system\kernels\ZWidget;


class ZUnpolyWidget extends ZWidget
{

    /**
     *
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => '/eyuf/cores/main/index_product.php',
        'type' => self::type['modal'],
        'selector' => '#contento', //css selector
    ];

    /*
     * Plugin Events
     **/
    public $event = [];
    public $_event = [
    ];

    /*
     * Constantas
     * */
     public const type = [
        'modal' => 'modal',
        'target' => 'target',
        'drawer' => 'drawer',
        'popup' => 'popup',
        'dash' => 'dash',
     ];

    /*
     * Plugin Layouts
     * */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
     <a href="{url}"
        up-{type}="{selector}"
     >start</a>
HTML,

    ];


    public function asset()
    {
        $this->fileCss('https://unpkg.com/unpoly@0.61.0/dist/unpoly.min.css');
        $this->fileJs('https://unpkg.com/unpoly@0.61.0/dist/unpoly.min.js');
    }


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{url}' => $this->_config['url'],
            '{type}' => $this->_config['type'],
            '{selector}' => $this->_config['selector'],
        ]);

    }

}


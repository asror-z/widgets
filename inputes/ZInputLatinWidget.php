<?php

/**
 *
 *
 * Author: Obidov Yasin
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;


class ZInputLatinWidget extends ZWidget
{
    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
        'type' => ZInputLatinWidget::type['lotin'],
        'hasPlace' => true,

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/inputes/ZInputLatinWidget/image/icon.png',
        'name' => Azl . 'InputLatin',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZInputLatinWidget/image/icon.png"/>',

    ];

    public const type = [
        'kiril' => 'kiril',
        'lotin' => 'lotin',
        'all' => 'all',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="md-form" id="{id}">
             <input type="text" placeholder="{placeholder}"  class="{type} {class}">
        </div>
HTML,

        'js' => <<<JS
         $(".kiril").keypress(function (event) {
        var verified_email = String.fromCharCode(e.which).match(/[^а-яё]/ig,'');
        if (verified_email) {
            e.preventDefault();
        }
        });
        $(".lotin").keypress(function (event) {
        var verified_email = String.fromCharCode(e.which).match(/[^a-z]/ig,'');
        if (verified_email) {
            e.preventDefault();
        }
        });
        $(".all").keypress(function (event) {
        var verified_email = String.fromCharCode(e.which).match(/[^a-z | 0-9 | !@#$%^&*()~?></":'№;:{}[]]/ig,'');
        if (verified_email) {
            e.preventDefault();
         }
        });
JS,

    ];

    public function asset()
    {

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{type}' => $this->_config['type'],
            '{class}' => $this->_config['class'],
            '{id}' => $this->id,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            
        ]);

        $this->js = strtr($this->_layout['js'], [
        ]);
    }
}




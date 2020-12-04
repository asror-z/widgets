<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\inputes;

use kcfinder\image;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZCheckboxGroupWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => self::imageUrl['default'],
        'checkMarkPosition' => self::checkMarkPosition['top-left'],
        'checkMarkSize' => '32px',
        'class' => "",
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>asd</b>',

    ];

    public const imageUrl = [
        'default' => '/render/inputes/ZRadioGroupWidget/asset/image/tick-2.png',
        'none' => '',
    ];

    /*
     * Constants
     * */
    public const checkMarkPosition =  [
        'top-left' => 'top-left',
        'top' => 'top',
        'top-right' => 'top-right',
        'left' => 'left',
        'center' => 'center',
        'right' => 'right',
        'bottom-left' => 'bottom-left',
        'bottom' => 'bottom',
        'bottom-right' => 'bottom-right',
    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'url',
            'checkMarkPosition',
            'checkMarkSize',
            'class',
        ],
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [
        'onload' => "function() { console.log('ZRadioGroup | loaded') }",
        'onclick' =>"function (event) { console.log('ZRadioGroup | clicked') }",
    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'checkboxGroup' => <<<HTML
 
 
        <input type="checkbox" id="{id}" class="id-check" name="{name}[]" value="{value}" {checked}/>
        <label for="{id}" class="imgCheckbox {class}">
             {src}   
        </label>
HTML,

        'js' => <<<JS
        $(".imgCheckbox").imgCheckbox({
            checkMarkImage: '{url}', //url
            graySelected: true, //Boolean
            scaleSelected: true, //Boolean
            fixedImageSize: false, //Boolean / String
            scaleCheckMark: true, //Boolean
            fadeCheckMark: false,  //Boolean
            checkMarkSize: "{checkMarkSize}", //Boolean or string
            checkMarkPosition: "{checkMarkPosition}", //String
            addToForm: false, //Boolean / jQuery
            preselect: [{preselect}],  //[Integer] / Boolean
            radio: false, //Boolean
            canDeselect: false, //	Boolean
            onload: {onload},
            onclick: {onclick},
        });
        
         var className = document.querySelectorAll('.id-check')
         className.forEach(function (event) {
            if (el.hasAttribute('checked')) 
                el.nextElementSibling.classList.add('imgChked') 
         });
JS,

         'css' => <<<CSS
       
CSS

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
    }

    public function codes()
    {
        foreach ($this->data as $key => $value) {
            $checked = '';
            if ($this->value === $key)
                $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $keyThis => $val)
                    if ($val == $key)
                        $checked = 'checked';

            $this->htm .= strtr($this->_layout['checkboxGroup'], [
                '{src}' => $value,
                '{id}' => uniqid('2', true),
                '{name}' => $this->name,
                '{value}' => $key,
                '{checked}' => $checked,
                '{class}' => $this->_config['class']
            ]);

            $this->css = strtr($this->_layout['css'], [


            ]);

            $checkedImg = '';
            if ($this->value !== null)
                foreach ($this->value as $keyThis => $valueThis) {
                    $checkedImg .= $valueThis . ',';
                }

            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $this->id,
                '{preselect}' => is_string($checkedImg) ? '' : $checkedImg,
                '{url}' => $this->_config['url'],
                '{checkMarkSize}' => $this->_config['checkMarkSize'],
                '{checkMarkPosition}' => $this->_config['checkMarkPosition'],
                '{onload}' => $this->eventCode('onload'),
                '{onclick}' => $this->eventCode('onclick'),
            ]);
        }

/*
        hidden checkboxi ko'rish uchun
        $this->css = <<<CSS
        [type=checkbox]:checked, [type=checkbox]:not(:checked) {
            opacity: 1;
            pointer-events: auto;
        }
CSS;*/

    }
}

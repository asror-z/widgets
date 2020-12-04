<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
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
class ZMImageRadioCompanyWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => self::imageUrl['checkbox'],
        'checkMarkPosition' => self::checkMarkPosition['top-left'],
        'checkMarkSize' => '32px',
        'title' => '',
        'display' => self::display['block'],
    ];

    public const display = [
        'inline-block' => 'inline-block',
        'block' => 'block',

    ];

    public static $grapes = [
        'enable' => false,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>asd</b>',

    ];

    public const imageUrl = [

        'checkbox' => '/render/inputes/ZRadioGroupWidget/asset/image/tick-2.png',
        'radio' => 'https://www.easyicon.net/api/resizeApi.php?id=1182156&size=128',
        'none' => '',

    ];

    /*
     * Constants
     * */
    public const checkMarkPosition = [
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
    /*
     * Events
     * */
    public $event = [];
    public $_event = [
        'onload' => "function() { console.log('ZRadioGroup | loaded') }",
        'onclick' => "function (event) { 
            $(this).addClass('imgChked');
            if (el.hasClass('imgChked')){
                el.prev().attr('checked', 'checked')
            }
         }",
    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="{id}-container" style="width: 100% !important;">
        <p class="ml-2 fp-18 text-dark my-1">{title}</p>
        {content}
        </div>
HTML,

        'input' => <<<HTML
        
        <input type="radio" id="{id}" class="id-check" name="{name}" value="{value}" {checked}/>
        <label for="{id}" class="imgCheckbox" style="width: 100% !important;">
             {src}   
        </label>

HTML,

        'css' => <<<CSS
         .imgCheckbox {
             "display": '{display}'
         }
CSS,


        'js' => <<<JS
        var checkBox = $('.{id}-container').find('.imgCheckbox');

        $(checkBox).imgCheckbox({
            checkMarkImage: '{url}', //url
            graySelected: true, //Boolean
            scaleSelected: true, //Boolean
            fixedImageSize: false, //Boolean / String
            scaleCheckMark: true, //Boolean
            fadeCheckMark: false,  //Boolean
            checkMarkSize: "{checkMarkSize}", //Boolean or string
            checkMarkPosition: "{checkMarkPosition}", //String
            addToForm: false, //Boolean / jQuery
            radio: true, //Boolean
            canDeselect: false, //	Boolean
            onload: {onload},
            onclick: {onclick},
        });
        
         //var className = document.querySelectorAll('.id-check')
         
         var className = $('.{id}-container').find('.id-check');
         
         className.each(function(el,m) {
         var main = $(el).siblings('span');
            if ($(el).attr('checked')){
                $(el).siblings('span').addClass('imgChked');
            }
            
         });
         
JS,
    ];

    public function asset()
    {
        $this->fileJs('/render/asrorz/js/imageCheck.js');

    }

    public function codes()
    {
        $input = '';
        foreach ($this->data as $key => $value) {
            /*$checked = '';
            if ($this->value == $key)
                $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $keyThis => $val)
                    if ($val == $key)
                        $checked = 'checked';*/

            $input .= strtr($this->_layout['input'], [
                '{src}' => $value,
                '{id}' => uniqid('2', true),
                '{cid}' => $this->id,
                '{name}' => $this->name,
                '{value}' => $key,
                //'{checked}' => $checked ? : '',
            ]);

        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $input,
            '{id}' => $this->id,
            '{title}' => $this->_config['title']
        ]);

        $this->css .= strtr($this->_layout['css'], [
             '{display}' => $this->_config['display']
        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['url'],
            '{checkMarkSize}' => $this->_config['checkMarkSize'],
            '{checkMarkPosition}' => $this->_config['checkMarkPosition'],
            '{onload}' => $this->eventCode('onload'),
            '{onclick}' => $this->eventCode('onclick'),
        ]);

    }
}

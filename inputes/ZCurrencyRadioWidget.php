<?php

/**
 *
 *
 * Author: AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use kcfinder\image;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 * @author AzimjonToirov
 *
 */
class ZCurrencyRadioWidget extends ZWidget
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
        'hint' => Azl . 'Выберите язык',
        'imageSize' => '', //only pixel


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
        <div class="{id}-container mt-1">
            <p class="ml-2 fp-18 text-dark my-1">{title}</p>
            {content}
        </div>
HTML,

        'input' => <<<HTML
        <input type="radio" id="{id}" class="id-check" name="{name}" value="{value}" {checked}/>
        <label for="{id}" class="imgCheckbox hint--bottom" aria-label="{hint}">
             {src}   
        </label>
HTML,

        'css' => <<<CSS
        label.imgCheckbox {
            margin-bottom: 0 !important;
            width: 100% !important;
        }
CSS,


        'js' => <<<JS

        var checkBox = $('.{id}-container').find('.imgCheckbox');

        $(checkBox).imgCheckbox({
            checkMarkImage: '{url}', //url
            graySelected: true, //Boolean
            scaleSelected: true, //Boolean
            fixedImageSize: '{imageSize}px', //Boolean / String
            scaleCheckMark: true, //Boolean
            fadeCheckMark: false,  //Boolean
            checkMarkSize: "{checkMarkSize}", //Boolean or string
            checkMarkPosition: "{checkMarkPosition}", //String
            addToForm: false, //Boolean / jQuery
            radio: true, //Boolean
            canDeselect: false, //	Boolean
            onload: {onload},
            onclick: {onclick},
            preselect:'{preselect}'
        });
        
         var className = $('.{id}-container').find('.id-check');
         
         className.each(function(el, input) {
            if ($(input).prop('checked')){
                $(input).next('span').addClass('imgChked');
            }
         });
         
JS,
    ];

    public function asset()
    {
        $this->fileJs('/render/asrorz/js/imageCheckCurrency.js');
    }

    public function codes()
    {

        $input = '';
        foreach ($this->data as $key => $value) {
            $checked = '';
            if ($this->value == $key)
                $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $keyThis => $val)
                    if ($val == $key)
                        $checked = 'checked';


            $input .= strtr($this->_layout['input'], [
                '{src}' => $value,
                '{id}' => uniqid('2', true),
                '{cid}' => $this->id,
                '{name}' => $this->name,
                '{value}' => $key,
                '{checked}' => $checked ?: '',
                '{hint}' => $value
            ]);

        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $input,
            '{id}' => $this->id,
            '{title}' => $this->_config['title'],
        ]);

        $this->css .= strtr($this->_layout['css'], [

        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{url}' => $this->_config['url'],
            '{checkMarkSize}' => $this->_config['checkMarkSize'],
            '{checkMarkPosition}' => $this->_config['checkMarkPosition'],
            '{onload}' => $this->eventCode('onload'),
            '{onclick}' => $this->eventCode('onclick'),
            '{preselect}' => $this->value,
            '{imageSize}' => $this->_config['imageSize']
        ]);

    }
}

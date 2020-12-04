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
use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZImageCheckboxWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZMImageRadioItemGroupWidget extends ZWidget
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
        'display' => self::display['inline-block'],
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
    public const display = [
        'block' => 'block',
        'inline-block' => 'inlene-block'
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
        <div class="{id}-container mt-1 asd">
        
        {content}
        </div>
HTML,

        'input' => <<<HTML
        <input type="radio" id="{id}" class="id-check" name="{name}" value="{value}" {checked}>
        <label for="{id}" class="imgCheckbox">
             {branch}
             <p class="ml-2 fp-18 text-dark my-1">{title}</p>
             {items} 
               
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
            preselect:'{preselect}',
        });
        
         //var className = document.querySelectorAll('.id-check')
         
         var className = $('.{id}-container').find('.id-check');
       
         
         className.each(function(m,el) {
         var main = $(el).next('span');
                   
            if ($(el).attr('checked')){
                main.addClass('imgChked');
            }
             
         });
         
        
         $('.id-check').on('change', {change});
         
         
JS,
    ];

    public function asset()
    {
        $this->fileJs('/render/asrorz/js/imageCheck.js');
    }

    public function codes()
    {
        $content = '';
        /** @var PropertyItem $value */
        foreach ($this->data as $key => $value) {
            $checked = '';
            if (is_array($this->value))
                foreach ($this->value as $val) {
                    if ($val == $key)
                        $checked = 'checked="checked"';
                }

            $content .= strtr($this->_layout['input'], [
                '{items}' => $value->items,
                '{branch}' => $value->branch,
                '{name}' => $value->name,
                '{id}' => $key . '-checkBox',
                '{title}' => $value->name,
                '{value}' => $key,
                '{checked}' => $checked,
            ]);

        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $content,
            '{id}' => $this->id,

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
            '{imageSize}' => $this->_config['imageSize'],
            '{display}' => $this->_config['display'],
            '{change}' => $this->eventCode('change'),
        ]);
    }
}

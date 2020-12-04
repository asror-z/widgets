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
class ZImgCheckboxWidgetAz extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => self::type['checkboxGroup'],
        'checkMarkImage' => '',
        'graySelected' => true,
        'scaleSelected' => true,
        'fixedImageSize' => false,
        'scaleCheckMark' => true,
        'fadeCheckMark' => false,
        'radio' => true,
        'checkbox' => 'checkbox',
        'src' => '/render/inputes/ZImageCheckboxWidget/demo/demo_files/image1.jpg',
        'canDeselect' => false,
        'class' => '',
    ];

    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio',
        'checkboxGroup' => 'checkboxGroup',
        'radioGroup' => 'radioGroup',
    ];

    public static $grapes = [
        'enable' => false,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>asd</b>',

    ];

    public $layout = [];
    public $_layout = [
        'radio' => <<<HTML
        <div class="d-flex">
            <input type="hidden" value="0" class="hiddenInput" name="{name}">
            <input type="checkbox" id="{id}" name="{name}" value="{value}" />
            <label for="{id}" class="{id}-imgCheckbox">
                     {src}   
            </label>
        </div>
HTML,
        'checkbox' => <<<HTML
        <div class="d-flex">
            <input type="hidden" value="0" class="hiddenInput">
            <input type="checkbox" id="{id}" name="{name}" value="{value}" />
            <label for="{id}" class="{id}-imgCheckbox">
                     {src}   
            </label>
        </div>
HTML,
        'radioGroup' => <<<HTML
        <div class="d-flex">
            <input type="hidden" value="0" class="hiddenInput">
            <input type="checkbox" id="{id}" name="{name}[]" value="{value}" />
            <label for="{id}" class="{id}-imgCheckbox">
                     {src}   
            </label>
        </div>
HTML,
        'checkboxGroup' => <<<HTML
        <div class="d-flex">
<!--            <input type="hidden" class="hiddenInput" name="{name}[]"/>-->
            <input type="checkbox" id="{id}" name="{name}[]" value="0"/>
            <label for="{id}" class="{id}-imgCheckbox">
                     {src}   
            </label>
        </div>
HTML,

        'js' => <<<JS
        $(".{id}-imgCheckbox").imgCheckbox({
            //checkMarkImage: {url}, //url
            graySelected: true, //Boolean
            scaleSelected: true, //Boolean
            fixedImageSize: false, //Boolean / String
            scaleCheckMark: true, //Boolean
            fadeCheckMark: false,  //Boolean
            checkMarkSize: "20px", //Boolean or string
            checkMarkPosition: "top-left", //String
            addToForm: false, //Boolean / jQuery
            preselect: '{preselect}',  //[Integer] / Boolean
            //radio: '{radio}', //Boolean
            canDeselect: false, //	Boolean
            onload: function(){
            // Do something fantastic!
            },
            onclick: function (event){
            var id = $('#{id}');        
            if (el.hasClass("imgChked")){
                id.attr('value', '1');
                id.attr('checked', 'checked');
                
            }else{
                id.attr('value', '0');
                id.removeAttr('checked');
            } 
            }
        });
        
        
JS,
    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/imgcheckbox@0.5.3/jquery.imgcheckbox.min.js');
    }

    public function codes()
    {

        //vdd($this->value);

        foreach ($this->data as $key => $value) {
            switch ($this->_config['type']) {
                case self::type['checkbox'] :
                    $this->htm = strtr($this->_layout['checkbox'], [
                        '{src}' => ZArrayHelper::getValue($this->data, 1),
                        '{id}' => $this->id,
                        '{name}' => $this->name,
                        '{value}' => $this->value,
                        '{id}-imgCheckbox' => $this->id,
                    ]);

                    $this->js .= strtr($this->_layout['js'], [
                        '{id}' => $this->id,
                        '{radio}' => false,
                        '{id}-imgCheckbox' => $this->id
                    ]);
                    break;
                case self::type['checkboxGroup'] :

                    $this->htm .= strtr($this->_layout['checkboxGroup'], [
                        '{src}' => $value,
                        '{id}' => $this->id,
                        '{name}' => $this->name,
                        '{preselect}' => $this->value,
                        '{id}-imgCheckbox' => $this->id,
                    ]);

                    $this->js .= strtr($this->_layout['js'], [
                        '{id}' => $this->id,
                        '{radio}' => false,
                        '{id}-imgCheckbox' => $this->id
                    ]);
                    break;
                case self::type['radio'] :
                    $this->htm = strtr($this->_layout['radio'], [
                        '{src}' => ZArrayHelper::getValue($this->data, 1),
                        '{id}' => $this->id,
                        '{name}' => $this->name,
                        '{value}' => $this->value,
                        '{id}-imgCheckbox' => $this->id,
                    ]);

                    $this->js = strtr($this->_layout['js'], [
                        '{id}' => $this->id,
                        '{radio}' => true,
                        '{id}-imgCheckbox' => $this->id
                    ]);
                    break;
                case self::type['radioGroup'] :
                    $this->htm .= strtr($this->_layout['radioGroup'], [
                        '{src}' => $value,
                        '{id}' => $this->id,
                        '{name}' => $this->name,
                        '{value}' => $this->value,
                        '{id}-imgCheckbox' => $this->id,
                    ]);

                    $this->js .= strtr($this->_layout['js'], [
                        '{id}' => $this->id,
                        '{radio}' => true,
                        '{id}-imgCheckbox' => $this->id
                    ]);
                    break;

                default:
            }
        }

        $this->css = <<<CSS
        [type=checkbox]:checked, [type=checkbox]:not(:checked) {
            opacity: 1;
            pointer-events: auto;
        }
CSS;

    }
}

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
class Zch extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
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

        'checkboxGroup' => <<<HTML
        <input type="checkbox" id="{id}" class="id-check" name="{name}[]" value="{value}" {checked}/>
        <label for="{id}" class="imgCheckbox">
             {src}   
        </label>
HTML,

        'js' => <<<JS
        $(".imgCheckbox").imgCheckbox({
            //checkMarkImage: {url}, //url
            graySelected: true, //Boolean
            scaleSelected: true, //Boolean
            fixedImageSize: false, //Boolean / String
            scaleCheckMark: true, //Boolean
            fadeCheckMark: false,  //Boolean
            checkMarkSize: "20px", //Boolean or string
            checkMarkPosition: "top-left", //String
            addToForm: false, //Boolean / jQuery
            preselect: [{preselect}],  //[Integer] / Boolean
            radio: false, //Boolean
            canDeselect: false, //	Boolean
            onload: function (event){
               console.log('loaded') 
            },
            onclick: function (event){
                console.log(el)
            }
        });
        
         var className = document.querySelectorAll('.id-check')
         className.forEach(function (event) {
            if (el.hasAttribute('checked')) 
                el.nextElementSibling.classList.add('imgChked') 
         });
JS,
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
            ]);


            $checkedImg = '';
            if ($this->value !== null)
                foreach ($this->value as $keyThis => $valueThis) {
                    $checkedImg .= $valueThis . ',';
                }

            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $this->id,
                '{preselect}' => is_string($checkedImg) ? '' : $checkedImg,
            ]);
        }

        $this->css = <<<CSS
            [type=checkbox]:checked, [type=checkbox]:not(:checked) {
                opacity: 1;
                pointer-events: auto;
            }
CSS;

    }
}

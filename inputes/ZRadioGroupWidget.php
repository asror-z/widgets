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
class ZRadioGroupWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'url' => '/render/inputes/ZRadioGroupWidget/asset/image/tick-2.png',
        'checkMarkPosition' => self::checkMarkPosition['top-left'],
        'checkMarkSize' => '32px',
        'class' => 'material-checkbox',
    ];

    public static $grapes = [
        'enable' => false,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZImageCheckboxWidget/image/icon.png',
        'name' => Azl . 'ZImageCheckbox',
        'title' => Azl . '<b>asd</b>',

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

        'main' => <<<HTML
        <div class="{class}">
        <input type="radio" id="{id}" class="id-check" name="{name}" value="{value}" {checked}/>
        <label for="{id}" class="imgCheckbox">
             {src}   
        </label>
</div>
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
            radio: true, //Boolean
            canDeselect: false, //	Boolean
            onload: {onload},
            onclick: {onclick},
        });
        
         var checkBox = $('#{id}');
    var values = {json};
    var checkBoxes = $('.{class}').find('.id-check');
    
    if (!values)
        values = [];
    
    checkBoxes.each(function(key, v) {
    
        let val = $(v).attr('value');
        if (values.includes(val))
            $(v).attr('imgChked', 'imgChked');
        console.log(values);
             
    });
    
    checkBox.on('change', function() {
      if (typeof this.checked) {
          $(this).attr('value', true);
      }
      else
          $(this).attr('value', false);
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
            if ($this->value == $key)
                $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $keyThis => $val)
                    if ($val == $key)
                        $checked = 'checked';

            $this->htm .= strtr($this->_layout['main'], [
                '{src}' => $value,
                '{id}' => uniqid('2', true),
                '{name}' => $this->name,
                '{value}' => $key,
                '{checked}' => $checked,
                '{class}' => $this->_config['class'],
            ]);
            $json = json_encode($this->value);
            $this->js .= strtr($this->_layout['js'], [
                '{id}' => $this->id,
                '{url}' => $this->_config['url'],
                '{checkMarkSize}' => $this->_config['checkMarkSize'],
                '{checkMarkPosition}' => $this->_config['checkMarkPosition'],
                '{onload}' => $this->eventCode('onload'),
                '{onclick}' => $this->eventCode('onclick'),
                '{json}' => $json,
                '{class}' => $this->_config['class'],
            ]);
        }



        //hidden readioni ko'rish uchun
        $this->css = <<<CSS
        [type=radio]:checked, [type=radio]:not(:checked) {
            opacity: 1;
            pointer-events: auto;
        }
CSS;
    }
}

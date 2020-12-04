<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZStarDobtcoWidgetOld extends ZWidget
{
    public $data = [
        '0.5' => 'Half Star',
        '1' => 'One Star',
        '1.5' => 'One & Half Star',
        '2' => 'Two Stars',
        '2.5' => 'Two & Half Stars',
        '3' => 'Three Stars',
        '3.5' => 'Three & Half Stars',
        '4' => 'Four Stars',
        '4.5' => 'Four & Half Stars',
        '5' => 'Five Stars'
    ];
    public $config = [];
    public $_config = [
        'quantity' => 5,
        'disabled' => false,
        'language' => false,
        'readonly' => false,
        'iStars' => 5,
        'fMin' => 0,
        'fMax' => 4,
        'fStep' => 0.5,
        'isDisplayOnly' => false,
        'clearButtonClass' => 'fas fa-minus-sign',
        'placeholder' => '',
        'icon' => 'fas fa-star',
        'class' => ''
    ];

    public const type = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class='starrr' id='star1'></div>
        <div>&nbsp;
            <span class='your-choice-was' id="{id}" name="{name}">
           <input type="hidden" class="hid_inp" name="{name}" id="{id}-hidden-input" value="{value}">
          </span>
        </div>
HTML,

        'type1' => <<<CSS
            input {
            width: 30px;
            margin: 10px 0;
        }
        .starrr {
            display: inline-block; }
        .starrr a {
            font-size: 16px;
            padding: 0 1px;
            cursor: pointer;
            color: #FFD119;
            text-decoration: none; }
        
CSS,

        'jscode' => <<<JS
         jQuery(document).ready(function () {
         $('#star1').starrr({
         max: {quantity},
        change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('.hid_inp').val(value);
            } else {
                $('.your-choice-was').hide();
            }
        }
    });
         
});
JS,





    ];

    public function asset()
    {
        $this->fileJs("/render/market/ZStarDobtco/assets/js/main.js");
    }

    public function codes()
    {

       foreach ($this->data as $key => $value){
           $this->htm .= strtr($this->_layout['main'], [
               '{id}' => $this->id,
               '{name}' => $this->modelCheck() ? $this->name : '',
               '{value}' => $this->modelCheck() ? $this->value : '',
               '{placeholder}' => $this->modelCheck() ? $this->_config['placeholder'] : '',
           ]);
       }

        $this->css = $this->_layout['type1'];

        $this->js = strtr($this->_layout['jscode'], [
              '{quantity}'=> $this->_config['quantity']
        ]);
        
    }
}

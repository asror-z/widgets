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

class ZStarDobtcoWidgetS extends ZWidget
{
    public $config = [];
    public $_config = [
        'quantity' => 5,
        'placeholder' => '',
        'rating' => 0,
        'icon' => 'far fa-star',    //ishlamadi
        'class' => '',
        'disabled' => false,
    ];

    public const type = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class='starrr' id="{id}"></div>
        
            <span class='your-choice-was' id="{id}" name="{name}">
           <input type="hidden" class="hid_inp" name="{name}" id="{id}-hidden-input" value="{value}">
          </span>
      
HTML,

        'type1' => <<<CSS
            .hid_inp {
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
            text-decoration: none; 
            }  
        @media (min-width: 320px) and (max-width: 480px) {
            .starrr a {
            font-size: 12px;
            padding: 0 1px;
            cursor: pointer;
            color: #FFD119;
            text-decoration: none; 
            } 
        }
CSS,

        'jscode' => <<<JS
         jQuery(document).ready(function () {
         $('#{id}').starrr({
         rating: {value},
         readOnly: '{readonly}', 
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
        $this->fileJs("/render/market/ZStarDobtcoWidget/assets/js/main.js");
    }

    public function codes()
    {

    $this->htm = strtr($this->_layout['main'],[
        '{class}'=>$this->_config['class'],
        '{id}' => $this->id,
        '{name}' => $this->modelCheck() ? $this->name : '',
        '{value}' => $this->modelCheck() ? $this->value : $this->_config['rating'],
        '{placeholder}' => $this->modelCheck() ? $this->_config['placeholder'] : '',

    ]);

        $this->css = $this->_layout['type1'];

        $this->js = strtr($this->_layout['jscode'], [
              '{quantity}'=> $this->_config['quantity'],
              '{value}' => $this->modelCheck() ? $this->value : $this->_config['rating'],
              '{id}' => $this->id,
              '{readonly}' => $this->_config['disabled']
        ]);
        
    }
}

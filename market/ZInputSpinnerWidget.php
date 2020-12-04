<?php

namespace zetsoft\widgets\market;

use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZPriceFormatWidget1;

/**
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 *
 * Clean Css By: Jasur Shukurov
 *
 *
 */

class ZInputSpinnerWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => '',
        'attr' => '',
        'InputStep' => '1', //Насколько будет умножатся значение
        'Inputmax' => '10000000',
        'Inputmin' => '1.0',
        'buttonsClass' => ZColor::btnStyle['btn-success'],
        'decimals' => '', //Дробное значение в нулях
    ];


    /**
     * Plugin Events
     */
    public $event = [];
    public $_event = [
        'change' => <<<JS
            function() {
                    console.log("changed");
            }
JS

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@1.13.5/src/bootstrap-input-spinner.min.js');
    }


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

     <div class="ctrl-counter position-relative text-center overflow-hidden border border-success rounded">
         <input min="{Inputmin}" max="{Inputmax}" step="{InputStep}" {attr} data-max-step="value" placeholder="{placeholder}"
           class="ctrl-counter-input text-center border border-0  m-1 form-control form-control-sm {class} ZInputSnipper" id="qty_input-{id}" required
            type="text" value="{value}" name="{name}" data-decimals="{decimals}"/>
     </div>       
        
HTML,

        'css' => <<<CSS

    .input-group-append button  {
        border: none;
        outline:none;
        margin: 0;
    }
    .input-group-prepend button {
        border: none;
        outline:none;
        margin: 0;
    }  

CSS,

        'js' => <<<JS
  $(".ZInputSnipper").InputSpinner({

            // button text/icons
            decrementButton: "<strong>-</strong>",
            incrementButton: "<strong>+</strong>",

            // class of input group
            groupClass: "input-group-spinner",

            // button class
            buttonsClass: "btn {buttonsClass}",
            
            // text alignment
            textAlign: "center",

            // delay in milliseconds
            autoDelay: 500,

            // interval in milliseconds
            autoInterval: 100,

            // boost after these steps
            boostThreshold: 15,

            // boost multiplier
            boostMultiplier: "auto",

            // detects the local from `navigator.language`, if null
            locale: null

        })
        .on('change', {change})
JS,
        



    ];


    public function codes()
    {                          
        $this->htm = strtr($this->_layout['main'],[
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{attr}' => $this->_config['attr'],
            '{placeholder}' => $this->_config['placeholder'],
            '{id}' => $this->myId(),
            '{class}' => $this->_config['class'],
            '{InputStep}' => $this->_config['InputStep'],
            '{Inputmax}' => $this->_config['Inputmax'],
            '{Inputmin}' => $this->_config['Inputmin'],
            '{decimals}' => $this->_config['decimals'],
        ]);

        $this->js = strtr($this->_layout['js'],[
            '{buttonsClass}' => $this->_config['buttonsClass'],
            '{change}' => $this->eventCode('change'),
        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);


    }

}

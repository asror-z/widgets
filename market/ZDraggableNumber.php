<?php

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

/**
 * CreatedBy: Zoirjon Sobirov
 */

class ZDraggableNumber extends ZWidget
{

    public $config = [];

    public $_config = [
        'label'=>'Basic Demo',
        'max'=>'100',
        'min'=>'1',
        'value' => 'value'

    ];


    public $event = [];
    public $_event = [

    ];

    public function asset()
    {
        $this->fileJs('/render/market/ZDraggableNumber/assets/draggable-number.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
         <div class="container">
            <p>{label}</p>
            <input class="numeric-input-1" value="42" />
        </div>
         
HTML,

        'js' => <<<JS
   var el = document.getElementsByClassName('numeric-input-1')[0];
    new DraggableNumber(el, {
        min: {min},
        max: {max},
        changeCallback: function(val) {console.log("on change: " + val);},
        endCallback: function(val) {console.log("on end: " + val);}
    });
JS,  ];

    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], [
            '{label}'=>$this->_config['label'],
        ]);
        $this->js .= strtr($this->_layout['js'], [
        '{min}'=>$this->_config['min'],
        '{max}'=>$this->_config['max'],

        ]);
    }

}

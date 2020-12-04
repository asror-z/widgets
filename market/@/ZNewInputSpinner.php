<?php

namespace zetsoft\widgets\market;

use zetsoft\system\kernels\ZWidget;


/**
 *
 * Class ZNewInputSpinner
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZNewInputSpinner extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        "decrementButton" => "<strong>-</strong>", // button text
        "incrementButton" => "<strong>+</strong>", // ..
        "groupClass" => "", // css class of the resulting input-group
        "buttonsClass" => "btn-outline-secondary",
        "buttonsWidth" => "2.5rem",
        "textAlign" => "center",
        "autoDelay" => "500", // ms holding before auto value change
        "autoInterval" => "100", // speed of auto value change
        "boostThreshold" => "10", // boost after these steps
        "boostMultiplier" => "auto" // you can also set a constant number as multiplier
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
            'value' => 'value', // starting value on element creation
            'min' => 'min', // minimum value when stepping
            'max' => 'min',// maximum value when stepping
            'step' => 'step',// step size
            'inputmode' => 'inputmode', // the "inputmode" of the input, defaults to "decimal" (shows decimal keyboard on touch devices)
            'data-step-max' => 'data-step-max',// max boost when stepping
            'data-decimals' => 'data-step-max', // shown decimal places
            'data-digit-grouping' => 'data-digit-grouping', // "false" to disable grouping (thousands separator), default is "true"
            'data-prefix' => 'data-prefix',// show a prefix text in the input element
            'data-suffix' => 'data-suffix' // show a suffix text in the input element
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
                 <div class="container">
					<div class="form-group">
					       {item}
					</div>
                 </div>
HTML,

'item' => <<<HTML
       	<label class="control-label">Colorful:</label>
		<input id="colorful" class="form-control" type="number" value="1" min="1" max="10" />
HTML,



        'js' => <<<JS

JS,

'css' => <<<CSS

    
CSS,
    ];

    /**
     *
     * Constants
     */


    public function asset()
    {

    }





    public function codes()
    {
      

        $this->htm = strtr($this->_layout['main'], []);

        $this->htm = strtr($this->_layout['item'], []);
        
        $this->js = strtr($this->_layout['js'], [
           '{id}'=>$this->id,
        ]);

        $this->css = strtr($this->_layout['css'], []);


    }

}

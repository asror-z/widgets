<?php


namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZPlaceAnOrderWidget extends Zwidget
{
    public $config = [];
    public $_config = [

        'grapes' => true,

    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
        'onload' => 'console.log("self | $eventOnLoad")',
        'onclick' => 'console.log("self | $eventOnClick")',
    ];
    /*   */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <section>
    <div class="container">
        <div class="row">
                    <div class="col-md-5">
                <div class="row">

                    <div class="col-md-12">
                        <div class="bg-light">
                            <h5 class="text-center pt-5 pb-5">Payment Method</h5>
                            <div >
                               
                                    <div class="form-check pt-2">
                                        <input class="form-check-input" type="radio" id="pay1" name="payment" value="pay1" checked="">
                                        <label class="form-check-label" for="pay1">Cash On Delivery</label>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque sint placeat illo animi quis minus accusantium ad doloribus, odit explicabo asperiores quidem.</p>
                                    </div>
                                    <div class="form-check pt-3">
                                        <input class="form-check-input" type="radio" id="pay2" name="payment" value="pay2">
                                        <label class="form-check-label" for="pay2">Direct Bank Transfer</label>
                                    </div>
                                    <li class="form-check pt-2">
                                        <input class="form-check-input" type="radio" id="pay3" name="payment" value="pay3">
                                        <label class="form-check-label" for="pay3">Cheque Payment</label>
                                    </li>
                                    <div class="form-check pt-2">
                                        <input class="form-check-input" type="radio" id="pay4" name="payment" value="pay4">
                                        <label class="form-check-label" for="pay4">Paypal</label>
                                    </div>
                                    <div class="form-check pb-5 pt-2">
                                        <input class="form-check-input" type="radio" id="pay5" name="payment" value="pay5">
                                        <label class="form-check-label" for="pay5">Payoneer</label>
                                    </div>
                                
                            </div>
                        </div>
                        <button type="button" name="button" class="btn btn-danger btn-rounded btn-lg btn-block">Place Order</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
          
          
HTML,
        'js' => <<<JS
         
                
JS,
        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick}); 

JS,
        'css' => <<<CSS
    
CSS,



    ];

    public function asset()
    {

    }

    public function codes()
    {
        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);


        $this->htm .= strtr($this->_layout['main'], [
            '{name}' => $this->name,
            '{value}' => $this->value,
            //'{\'{readonly}\' => $this->_config[\'readonly\'] ? \'readonly\' : \'\',type}' => $this->_config['type'],
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }
}

